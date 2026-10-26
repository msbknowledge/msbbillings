<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Kallol
 */
class Medicine extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'medicines_model';
        $this->moduleMeta = array('medical' => 'Medicine');
        $this->page_config['tablePrimaryKey'] = $this->medicines_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Medicine'; //search title bar
       // $this->page_config['use_dropdown_columns'] = 'medicine_schedule';
       // $this->page_config['use_dropdown_columns_options']['medicine_schedule'] = array("H1" => "H1");
        //$this->page_config['autocomplete']['medicine_category'] = array('medicine_categories' => 'medicine_category_name');
        
        $this->page_config['autocomplete']['medicine_manufacturer'] = array('manufacturers' => 'manufacturer_name');
        $this->page_config['autocomplete']['medicine_schedule'] = array('medicines'=>'medicine_schedule'); 
        $this->page_config['autocomplete']['medicine_hsn'] = array('medicines'=>'medicine_hsn'); 
        $this->page_config['autocomplete']['medicine_pack'] = array('medicines' => 'medicine_pack');
        $this->page_config['autocomplete']['medicine_storage'] = array('medicines' => 'medicine_storage');
        $this->page_config['autocomplete']['medicine_category'] = array('medicine_categories' => 'medicine_category_name');
        $this->page_config['searchFields'] = 'medicine_name,medicine_id,medicine_discount,medicine_manufacturer,medicine_category,medicine_hsn,medicine_storage'; //search box,
        $this->page_config['list_columns'] = 'medicine_name,medicine_id,medicine_discount,medicine_manufacturer,medicine_category,medicine_hsn,medicine_storage';
        $this->allowed_action = array('add_detail', 'edit_detail', 'index', 'view_detail');

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
        //register_hook('hook_test', 'header');
    }

    /*     * *************** */

    public function duplicate() {
        $result = $this->medicines_model->duplicate();
        foreach ($result as $k => $r) {
            $IDS = $this->db->query("select medicine_ID from medicines where medicine_name = '" . addslashes($r['medicine_name']) . "'")->result_array();
            foreach ($IDS as $value) {
                $result[$k]['IDS'][] = $value['medicine_ID'];
            }
        }
        $this->render(array('result' => $result), 'duplicate_tpl');
    }

    public function no_unit() {
        if ($this->input->post('medicine_unit')) {
            $data = $this->input->post('medicine_unit');

            $sql = 'update medicines set medicine_unit = "' . $data[key($data)] . '" or medicine_unit = 0 where medicine_id = ' . key($data);
            $this->db->query($sql);
        }
        $result = $this->medicines_model->no_unit();
        $this->render(array('result' => $result), 'no_unit_tpl');
    }

    public function storage_unassigned() {
        if ($this->input->post('medicine_storage')) {
            $data = $this->input->post('medicine_storage');

            $sql = 'update medicines set medicine_storage = "' . $data[key($data)] . '"  where medicine_id = ' . key($data);
            $this->db->query($sql);
        }
        $result = $this->medicines_model->get_list(array('medicine_storage' => ''));
        $this->render(array('result' => $result), 'storage_tpl');
    }

    public function merge() {
        $medicineIds = explode('_', $this->uri->segment(4));
        $KEEP_ONE = $medicineIds[0];
        unset($medicineIds[0]);
        //purchase
        $sql['purchase'] = 'update  purchases set purchase_medicine_id = ' . $KEEP_ONE . '  where purchase_medicine_id in (' . implode(',', $medicineIds) . ' )';
        $sql['sale'] = 'update  sales set sale_medicine_id = ' . $KEEP_ONE . '  where sale_medicine_id in (' . implode(',', $medicineIds) . ' )';
        $sql['stock'] = 'update  medicine_stocks set medicine_stock_medicine = ' . $KEEP_ONE . '  where medicine_stock_medicine in (' . implode(',', $medicineIds) . ' )';
        $sql['medicine'] = 'delete from medicines where medicine_ID in (' . implode(',', $medicineIds) . ' )';
        foreach ($sql as $k => $q) {
            $this->db->query($q);
        }
        redirect('/console/medicine/duplicate');
    }

    public function dupicate_fix() {
        $data1 = $this->db->query('select *  from medicines ')->result_array();
        $dx = null;
        $dx2 = null;
        $replacement_ids = null;
        foreach ($data1 as $d) {
            $dx[trim($d['medicine_name'])][] = $d;
        }
        foreach ($dx as $k => $d) {
            if (count($dx[$k]) > 1) {
                $dx2[$k] = $d;
                foreach ($d as $mv) {
                    $replacement_ids[$dx2[$k][0]['medicine_id']][] = $mv['medicine_id'];
                }
            }
        }

        foreach ($replacement_ids as $key => $value) {
            //unset($value[0]);
            $sql = 'update  purchases set purchase_medicine_id = ' . $key . '  where purchase_medicine_id in (' . implode(',', $value) . ' )';
            $this->db->query($sql);
            $sql = 'update sales set sale_medicine_id = ' . $key . '  where sale_medicine_id in (' . implode(',', $value) . ' )';
            $this->db->query($sql);
            $sql = 'update  medicine_stocks set medicine_stock_medicine = ' . $key . '  where medicine_stock_medicine in (' . implode(',', $value) . ' )';
            $this->db->query($sql);
            #$sql = 'delete from  medicines where medicine_id in (' . implode(',', $value) . ' )';
            #$this->db->query($sql);

            $data = $this->db->query('select * from medicines where medicine_id in (' . implode(',', $value) . ' )')->result_array();
            $medicineData = array();
            foreach ($data as $d) {
                $medicineData = array_merge(array_filter($medicineData, 'strval'), array_filter($d, 'strval'));
            }
            $sql = 'update  medicines set 
			medicine_name = ' . $this->db->escape($medicineData['medicine_name']) . '  ,
			medicine_manufacturer = ' . $this->db->escape($medicineData['medicine_manufacturer']) . '  ,
			medicine_hsn = ' . $this->db->escape($medicineData['medicine_hsn']) . '  ,
			medicine_unit = ' . $this->db->escape($medicineData['medicine_unit']) . '  ,
			medicine_storage = ' . $this->db->escape($medicineData['medicine_storage']) . ' 
			where medicine_id in (' . implode(',', $value) . ' )';
            //echo $sql; 
            $this->db->query($sql);
            unset($value[0]);
            $sql = 'delete from  medicines where medicine_id in (' . implode(',', $value) . ' )';
            echo $sql;
            #$this->db->query($sql);
            //die();
        }
        //$data2 = $this->db->query()->result_array();
        //pr($replacement_ids);
        redirect(console_url('medicine/stock_fix'));
    }

    public function stock_fix() {
        $sql = 'select * from  medicine_stocks where medicine_expire_month =""';
        $data = $this->db->query($sql)->result_array();
        foreach ($data as $d) {
            $sql2 = 'select * from  purchases where purchase_batch ="' . $d['medicine_stock_batch'] . '" limit 0,3';
            $datax = $this->db->query($sql2)->result_array();
            #pr($datax);
            if (!empty($datax[0])) {
                $sql3 = 'update  medicine_stocks set 
						medicine_mrp = ' . $datax[0]['purchase_mrp'] . ' ,
						medicine_expire_month = ' . $datax[0]['purchase_expire_month'] . ' ,
						medicine_expire_year = ' . $datax[0]['purchase_expire_year'] . '  
						where 
						medicine_stock_batch  = "' . $datax[0]['purchase_batch'] . '"';
                #echo  $sql3;
                $this->db->query($sql3);
                #die();
            }
        }
        redirect(console_url('medicine/duplicate'));
    }

    public function duplicatex() {
        $sql = 'select sale_invoice from sales where sale_medicine_id in (select medicine_ID from medicines where medicine_storage like "DELETE%") order by sale_ID desc ';
        $stock_batches_correct = $this->db->query($sql)->result_array();
        pr($stock_batches_correct);
    }

    public function purchase_fix() {
        #$sql = 'select distinct purchase_medicine_id from purchases where purchase_medicine_id not in (select medicine_id from medicines)';		   
        $sql = 'select * from medicine_stocks left join medicines on medicine_stock_medicine = medicine_id ';
        $stock_batches_correct = $this->db->query($sql)->result_array();
        $batch_data_correct = null;
        foreach ($stock_batches_correct as $stock_batche) {
            $batch_data_correct[$stock_batche['medicine_stock_batch']][] = $stock_batche;
        }

        foreach ($batch_data_correct as $stock_batche) {
            if (count($stock_batche) > 1) {
                pr($stock_batche);
            }
        }
    }

    public function merge_medicine() {
        $medicineIds = explode('_', $this->uri->segment(4));

        $KEEP_ONE = $this->input->post('medicine_main');
        $medicineIds[0] = $this->input->post('medicine_replace');
        if ($KEEP_ONE != $medicineIds[0]) {
            $sql['purchase'] = 'update  purchases set purchase_medicine_id = ' . $KEEP_ONE . '  where purchase_medicine_id in (' . implode(',', $medicineIds) . ' )';
            $sql['sale'] = 'update  sales set sale_medicine_id = ' . $KEEP_ONE . '  where sale_medicine_id in (' . implode(',', $medicineIds) . ' )';
            $sql['stock'] = 'update  medicine_stocks set medicine_stock_medicine = ' . $KEEP_ONE . '  where medicine_stock_medicine in (' . implode(',', $medicineIds) . ' )';
            $sql['medicine'] = 'delete from medicines where medicine_ID in (' . implode(',', $medicineIds) . ' )';
            foreach ($sql as $k => $q) {
                $this->db->query($q);
            }
        }
        redirect('/console/medicine/duplicate');
    }

}

?>
