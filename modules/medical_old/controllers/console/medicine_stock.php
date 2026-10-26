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
class medicine_stock extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'medicine_stocks_model';
        $this->moduleMeta = array('medical' => 'medicine_stock');
        $this->page_config['tablePrimaryKey'] = $this->medicine_stocks_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Medicine Stock'; //search title bar
        $this->page_config['searchFields'] = 'medicine_stock_loose,medicine_stock_batch,medicine_mrp,medicine_expire_month,medicine_expire_year,medicine_strip_stock,medicine_loose_stock,medicine_name'; //search box,
        $this->page_config['list_columns'] = $this->page_config['searchFields'];
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        //$this->page_config['use_dropdown_columns'] = 'medicine_stock_medicine';
        //$this->page_config['use_dropdown_columns_options']['medicine_stock_medicine'] = $this->medicines_model->get_list_for_dropdown('medicine_name'); //pk
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }

    public function fast_update() {
        //
        $data = $this->input->post();

        if (!empty($data)) {
            $medicine_id = $data['medicine_id'];
            $medicine['medicine_name'] = strtoupper($data['medicine_name']);
            $medicine['medicine_manufacturer'] = strtoupper($data['medicine_manufacturer']);
            $medicine['medicine_category'] = strtoupper($data['medicine_category']);
            $medicine['medicine_hsn'] = $data['medicine_hsn'];
            $medicine['medicine_unit'] = $data['medicine_unit'];
            $medicine['medicine_storage'] = $data['medicine_storage'];
            if (empty($medicine_id)) {
                $medicine_id = $this->medicines_model->insert_data($medicine);
            } else {
                $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
            }
            $formatedData = null;
            foreach ($data['medicine_stock_batch'] as $key => $value) {
				if(empty($data['medicine_strip_stock'][$key])&& empty($data['medicine_loose_stock'][$key])){
					continue;
				}
                $formatedData[$key]['medicine_stock_batch'] = $data['medicine_stock_batch'][$key];
                $formatedData[$key]['medicine_strip_stock'] = $data['medicine_strip_stock'][$key];
                $formatedData[$key]['medicine_loose_stock'] = $data['medicine_loose_stock'][$key];
                $formatedData[$key]['medicine_expire_month'] = $data['medicine_expire_month'][$key];
                $formatedData[$key]['medicine_expire_year'] = $data['medicine_expire_year'][$key];
                $formatedData[$key]['medicine_mrp'] = $data['medicine_mrp'][$key];
                $formatedData[$key]['medicine_stock_medicine'] = $medicine_id;
            }
            //$this->db->query('delete from medicine_stocks where medicine_stock_medicine = ' . $medicine_id);
            $this->{$this->targetModel}->insert_data($formatedData, true);
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        } else {
			$medicine_id = $this->uri->segment(4);
			//pr($medicine_id);
				
			$data = $this->medicines_model->get_list(array("medicine_id"=>$medicine_id));
            $this->render($data[0], 'fast_update_tpl');
        }
    }
    public function purchase_sale_history() {
        $data = $this->input->post();

        if (!empty($data)) {
            $medicine_id = $data['medicine_id'];
            $medicine['medicine_name'] = strtoupper($data['medicine_name']);
            $medicine['medicine_manufacturer'] = strtoupper($data['medicine_manufacturer']);
            $medicine['medicine_category'] = strtoupper($data['medicine_category']);
            $medicine['medicine_hsn'] = $data['medicine_hsn'];
            $medicine['medicine_unit'] = $data['medicine_unit'];
            $medicine['medicine_storage'] = $data['medicine_storage'];
            if (empty($medicine_id)) {
                $medicine_id = $this->medicines_model->insert_data($medicine);
            } else {
                $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
            }
            $formatedData = null;
            foreach ($data['medicine_stock_batch'] as $key => $value) {
                $formatedData[$key]['medicine_stock_batch'] = $data['medicine_stock_batch'][$key];
                $formatedData[$key]['medicine_strip_stock'] = $data['medicine_strip_stock'][$key];
                $formatedData[$key]['medicine_loose_stock'] = $data['medicine_loose_stock'][$key];
                $formatedData[$key]['medicine_expire_month'] = $data['medicine_expire_month'][$key];
                $formatedData[$key]['medicine_expire_year'] = $data['medicine_expire_year'][$key];
                $formatedData[$key]['medicine_mrp'] = $data['medicine_mrp'][$key];
                $formatedData[$key]['medicine_stock_medicine'] = $medicine_id;
            }
            $this->db->query('delete from medicine_stocks where medicine_stock_medicine = ' . $medicine_id);
            $this->{$this->targetModel}->insert_data($formatedData, true);
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        } else {
            $this->render('', 'purchase_sale_history_tpl');
        }
    }

 
    public function shortage() {
        $result = $this->{$this->targetModel}->shortage();
        $this->render(array('result' => $result), 'shortage_tpl');
       // print_r($result);
    }
	public function stock() {
        $data = $this->db->query("select * from medicines limit 0,20000")->result_array();   
        foreach($data as $k=> $v){
		$stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
		 $data[$k]['left_strip']=$stock['left_strip']; 
		 $data[$k]['left_loose']=$stock['left_loose'];

		}
        $this->render(array('result' => $data), 'stock_tpl');
    }
    public function stock_by_batch() {
		$medicine_id=$this->input->get("medicine_id");
		$medicine_batch=$this->input->get("term");
		$isdebug = !empty($this->input->get("debug"));
	
        $purchased_batch =  $this->db->query("select distinct purchase_batch,purchase_expire_month,purchase_expire_year,purchase_cgst_percent,purchase_mrp from purchases where purchase_medicine_id=".$medicine_id)->result_array();
        $responce = null;
        foreach($purchased_batch as $k=> $v){
			if(!(empty($medicine_batch)) && $v['purchase_batch']!=$medicine_batch){
			continue;
			}
		 $stock = $this->{$this->targetModel}->stock_of_medicine($medicine_id,$v['purchase_batch']);
		 $data[$v['purchase_batch']]['medicine_id']=$medicine_id; 
		 $data[$v['purchase_batch']]['purchase_stock']=$stock['purchase_stock']; 
		 $data[$v['purchase_batch']]['purchase_return_stock']=$stock['purchase_return_stock']; 
		 $data[$v['purchase_batch']]['sold_stock']=$stock['sold_stock']; 
		 $data[$v['purchase_batch']]['sold_return_stock']=$stock['sold_return_stock']; 
		 $data[$v['purchase_batch']]['left_strip']=$stock['left_strip']; 
		 $data[$v['purchase_batch']]['left_loose']=$stock['left_loose'];
		 $data[$v['purchase_batch']]['balance_stock']=$stock['balance_stock'];

		 $data[$v['purchase_batch']]['medicine_mrp']=$v['purchase_mrp']; 
		 $data[$v['purchase_batch']]['medicine_mrp']=$v['purchase_mrp']; 
		 $data[$v['purchase_batch']]['sale_mrp']=$v['purchase_mrp']; 
		 $data[$v['purchase_batch']]['sale_expire_month']=$v['purchase_expire_month']; 
		 $data[$v['purchase_batch']]['sale_expire_year']=$v['purchase_expire_year']; 
		 $data[$v['purchase_batch']]['sale_cgst_percent']=$v['purchase_cgst_percent']; 
		
		if($stock['left_strip']==0 && $stock['left_loose']==0 ){					
		    if(!$isdebug)
		    continue;
		}
            $responce[] = array('id' => '', 'label' => $v['purchase_batch'].' [S:'.$stock['left_strip'].'|L:'.$stock['left_loose'].']('.$v['purchase_expire_month'].'/'.$v['purchase_expire_year'].') |'.$v['purchase_mrp'], 'value' => $v['purchase_batch'], 'complete' => $data[ $v['purchase_batch']]);
			
		}
		header('Content-Type: application/json');
		echo json_encode($responce);
    }
    public function get_info(){
		
	    $medicine = $this->medicines_model->get_list(array("medicine_name"=>$this->input->post('medicine')));
	    $purchased_batch =  $this->db->query("select distinct purchase_batch from purchases where purchase_medicine_id=".$medicine[0]['medicine_id'])->result_array();
        $responce = null;
        foreach($purchased_batch as $k=> $v){
			$stock =  $this->{$this->targetModel}->stock_of_medicine($medicine[0]['medicine_id'],$v['purchase_batch']);
			if($stock['left_strip']==0 && $stock['left_loose']==0 ){					
				
				continue;
			}
			$data[$v['purchase_batch']] =$stock; 
		}
	    
		$this->load->view('console/medicine_stock/get_info_tpl', array('stock' => $data,'medicine' => $medicine[0]));

	}
    public function expiring() {
        $result = $this->{$this->targetModel}->expire();
        $this->render(array('uri'=>'expiring','result' => $result), 'expire_tpl');
    }

    public function expired() {
        $result = $this->{$this->targetModel}->expire(true);
        $this->render(array('uri'=>'expired','result' => $result), 'expire_tpl');
    }
    public function get_unique_medicine_id(){
	
	}

    public function zeronegetive() {
		pr("work in progress",1);
        $result = $this->{$this->targetModel}->zeronegetive(true);
        $this->render(array('result' => $result), 'zeronegetive_tpl');
    }

    public function reconsile() {
        $data = json_decode(file_get_contents("https://www.medicea.in/rest/med/drug/all/Digene"), true);
        foreach ($data as $k => $d) {
            $mapped[$k]['medicine_name'] = $d['name'];
            $mapped[$k]['medicine_manufacturer'] = $d['companyName'];
            $mapped[$k]['medicine_category'] = $d['type'];
            $mapped[$k]['medicine_hsn'] = $d['hsnCode'];
            $mapped[$k]['medicine_unit'] = @$d['packing'];
        }
        pr(($mapped));
    }

}
