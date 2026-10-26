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
class Product extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'products_model';
        $this->moduleMeta = array('medical' => 'Product');
        $this->page_config['tablePrimaryKey'] = $this->products_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Product'; //search title bar
        $this->page_config['autocomplete']['product_category'] = array('product_categories' => 'product_category_name');
        $this->page_config['autocomplete']['product_manufacturer'] = array('manufacturers' => 'manufacturer_name');
        //$this->page_config['autocomplete']['product_hsn'] = array('products_model'=>'product_hsn'); 
        $this->page_config['autocomplete']['product_pack'] = array('products' => 'product_pack');
        $this->page_config['autocomplete']['product_type'] = array('products' => 'product_type');
        
        //$this->page_config['searchFields'] = 'product_name,product_discount,product_manufacturer,product_category,product_hsn,product_storage'; //search box,
        //$this->page_config['list_columns'] = 'product_name,product_discount,product_manufacturer,product_category,product_hsn,product_storage';


        $this->page_config['searchFields'] = 'product_name,product_category'; //search box,
        $this->page_config['list_columns'] = 'product_name';
        //$this->allowed_action = array('add_detail', 'edit_detail', 'index', 'view_detail');

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
        //register_hook('hook_test', 'header');
    }

    /*     * *************** */

    public function duplicate() {
        $result = $this->products_model->duplicate();
        foreach ($result as $k => $r) {
            $IDS = $this->db->query("select product_ID from products where product_name = '" . addslashes($r['product_name']) . "'")->result_array();
            foreach ($IDS as $value) {
                $result[$k]['IDS'][] = $value['product_ID'];
            }
        }
        $this->render(array('result' => $result), 'duplicate_tpl');
    }

    public function no_unit() {
        if ($this->input->post('product_unit')) {
            $data = $this->input->post('product_unit');

            $sql = 'update products set product_unit = "' . $data[key($data)] . '"  where product_id = ' . key($data);
            $this->db->query($sql);
        }
        $result = $this->products_model->no_unit();
        $this->render(array('result' => $result), 'no_unit_tpl');
    }

    public function storage_unassigned() {
        if ($this->input->post('product_storage')) {
            $data = $this->input->post('product_storage');

            $sql = 'update products set product_storage = "' . $data[key($data)] . '"  where product_id = ' . key($data);
            $this->db->query($sql);
        }
        $result = $this->products_model->get_list(array('product_storage' => ''));
        $this->render(array('result' => $result), 'storage_tpl');
    }

    public function merge() {
        $productIds = explode('_', $this->uri->segment(4));
        $KEEP_ONE = $productIds[0];
        unset($productIds[0]);
        //purchase
        $sql['purchase'] = 'update  purchases set purchase_product_id = ' . $KEEP_ONE . '  where purchase_product_id in (' . implode(',', $productIds) . ' )';
        $sql['sale'] = 'update  sales set sale_product_id = ' . $KEEP_ONE . '  where sale_product_id in (' . implode(',', $productIds) . ' )';
        $sql['stock'] = 'update  product_stocks set product_stock_product = ' . $KEEP_ONE . '  where product_stock_product in (' . implode(',', $productIds) . ' )';
        $sql['product'] = 'delete from products where product_ID in (' . implode(',', $productIds) . ' )';
        foreach ($sql as $k => $q) {
            $this->db->query($q);
        }
        redirect('/console/product/duplicate');
    }

    public function dupicate_fix() {
        $data1 = $this->db->query('select *  from products ')->result_array();
        $dx = null;
        $dx2 = null;
        $replacement_ids = null;
        foreach ($data1 as $d) {
            $dx[trim($d['product_name'])][] = $d;
        }
        foreach ($dx as $k => $d) {
            if (count($dx[$k]) > 1) {
                $dx2[$k] = $d;
                foreach ($d as $mv) {
                    $replacement_ids[$dx2[$k][0]['product_id']][] = $mv['product_id'];
                }
            }
        }

        foreach ($replacement_ids as $key => $value) {
            //unset($value[0]);
            $sql = 'update  purchases set purchase_product_id = ' . $key . '  where purchase_product_id in (' . implode(',', $value) . ' )';
            $this->db->query($sql);
            $sql = 'update sales set sale_product_id = ' . $key . '  where sale_product_id in (' . implode(',', $value) . ' )';
            $this->db->query($sql);
            $sql = 'update  product_stocks set product_stock_product = ' . $key . '  where product_stock_product in (' . implode(',', $value) . ' )';
            $this->db->query($sql);
            #$sql = 'delete from  products where product_id in (' . implode(',', $value) . ' )';
            #$this->db->query($sql);

            $data = $this->db->query('select * from products where product_id in (' . implode(',', $value) . ' )')->result_array();
            $productData = array();
            foreach ($data as $d) {
                $productData = array_merge(array_filter($productData, 'strval'), array_filter($d, 'strval'));
            }
            $sql = 'update  products set 
			product_name = ' . $this->db->escape($productData['product_name']) . '  ,
			product_manufacturer = ' . $this->db->escape($productData['product_manufacturer']) . '  ,
			product_hsn = ' . $this->db->escape($productData['product_hsn']) . '  ,
			product_unit = ' . $this->db->escape($productData['product_unit']) . '  ,
			product_storage = ' . $this->db->escape($productData['product_storage']) . ' 
			where product_id in (' . implode(',', $value) . ' )';
            //echo $sql; 
            $this->db->query($sql);
            unset($value[0]);
            $sql = 'delete from  products where product_id in (' . implode(',', $value) . ' )';
            echo $sql;
            #$this->db->query($sql);
            //die();
        }
        //$data2 = $this->db->query()->result_array();
        //pr($replacement_ids);
        redirect(console_url('product/stock_fix'));
    }

    public function stock_fix() {
        $sql = 'select * from  product_stocks where product_expire_month =""';
        $data = $this->db->query($sql)->result_array();
        foreach ($data as $d) {
            $sql2 = 'select * from  purchases where purchase_batch ="' . $d['product_stock_batch'] . '" limit 0,3';
            $datax = $this->db->query($sql2)->result_array();
            #pr($datax);
            if (!empty($datax[0])) {
                $sql3 = 'update  product_stocks set 
						product_mrp = ' . $datax[0]['purchase_mrp'] . ' ,
						product_expire_month = ' . $datax[0]['purchase_expire_month'] . ' ,
						product_expire_year = ' . $datax[0]['purchase_expire_year'] . '  
						where 
						product_stock_batch  = "' . $datax[0]['purchase_batch'] . '"';
                #echo  $sql3;
                $this->db->query($sql3);
                #die();
            }
        }
        redirect(console_url('product/duplicate'));
    }

    public function duplicatex() {
        $sql = 'select sale_invoice from sales where sale_product_id in (select product_ID from products where product_storage like "DELETE%") order by sale_ID desc ';
        $stock_batches_correct = $this->db->query($sql)->result_array();
        pr($stock_batches_correct);
    }

    public function purchase_fix() {
        #$sql = 'select distinct purchase_product_id from purchases where purchase_product_id not in (select product_id from products)';		   
        $sql = 'select * from product_stocks left join products on product_stock_product = product_id ';
        $stock_batches_correct = $this->db->query($sql)->result_array();
        $batch_data_correct = null;
        foreach ($stock_batches_correct as $stock_batche) {
            $batch_data_correct[$stock_batche['product_stock_batch']][] = $stock_batche;
        }

        foreach ($batch_data_correct as $stock_batche) {
            if (count($stock_batche) > 1) {
                pr($stock_batche);
            }
        }
    }

    public function merge_product() {
        $productIds = explode('_', $this->uri->segment(4));

        $KEEP_ONE = $this->input->post('product_main');
        $productIds[0] = $this->input->post('product_replace');
        if ($KEEP_ONE != $productIds[0]) {
            $sql['purchase'] = 'update  purchases set purchase_product_id = ' . $KEEP_ONE . '  where purchase_product_id in (' . implode(',', $productIds) . ' )';
            $sql['sale'] = 'update  sales set sale_product_id = ' . $KEEP_ONE . '  where sale_product_id in (' . implode(',', $productIds) . ' )';
            $sql['stock'] = 'update  product_stocks set product_stock_product = ' . $KEEP_ONE . '  where product_stock_product in (' . implode(',', $productIds) . ' )';
            $sql['product'] = 'delete from products where product_ID in (' . implode(',', $productIds) . ' )';
            foreach ($sql as $k => $q) {
                $this->db->query($q);
            }
        }
        redirect('/console/product/duplicate');
    }

}

?>