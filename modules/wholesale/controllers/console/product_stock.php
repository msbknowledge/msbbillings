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
class product_stock extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'product_stocks_model';
        $this->moduleMeta = array('medical' => 'product_stock');
        $this->page_config['tablePrimaryKey'] = $this->product_stocks_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'product Stock'; //search title bar
        $this->page_config['searchFields'] = 'product_stock_loose,product_stock_batch,product_mrp,product_expire_month,product_expire_year,product_strip_stock,product_loose_stock,product_name'; //search box,
        $this->page_config['list_columns'] = $this->page_config['searchFields'];
        $this->page_config['autocomplete']['product_name'] = array('products' => 'product_name');
        //$this->page_config['use_dropdown_columns'] = 'product_stock_product';
        //$this->page_config['use_dropdown_columns_options']['product_stock_product'] = $this->products_model->get_list_for_dropdown('product_name'); //pk
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }

    public function fast_update() {
        $data = $this->input->post();

        if (!empty($data)) {
            $product_id = $data['product_id'];
            $product['product_name'] = strtoupper($data['product_name']);
            $product['product_manufacturer'] = strtoupper($data['product_manufacturer']);
            $product['product_category'] = strtoupper($data['product_category']);
            $product['product_hsn'] = $data['product_hsn'];
            $product['product_unit'] = $data['product_unit'];
            $product['product_storage'] = strtoupper($data['product_storage']);

             if (empty($product_id)) {
                 $product_id = $this->products_model->insert_data($product);
             } else {
                 $this->products_model->update_data($product, array('product_id' => $product_id));
             }
            
            $formatedData = null;
            foreach ($data['product_stock_batch'] as $key => $value) {
				if(empty($data['product_strip_stock'][$key])&& empty($data['product_loose_stock'][$key]) && empty($data['product_stock_date'][$key])){
					continue;
				}
        // date('Y-m-d', strtotime($this->input->post('expiry_date')))
        $formatedData[$key]['product_stock_batch'] = $data['product_stock_batch'][$key];
        $formatedData[$key]['product_strip_stock'] = $data['product_strip_stock'][$key];
        $formatedData[$key]['product_loose_stock'] = $data['product_loose_stock'][$key];
        $formatedData[$key]['product_stock_date'] = $data['product_stock_date'][$key];
        $formatedData[$key]['product_expire_month'] = $data['product_expire_month'][$key];
        $formatedData[$key]['product_expire_year'] = $data['product_expire_year'][$key];
        $formatedData[$key]['product_mrp'] = $data['product_mrp'][$key];
        $formatedData[$key]['product_stock_product'] = $product_id;
        }
        //$this->db->query('delete from product_stocks where product_stock_product = ' . $product_id);
        if(!empty($formatedData[0]['product_stock_batch'])) {
        $this->{$this->targetModel}->insert_data($formatedData, true);
        $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        }

      }else{
        $product_id = $this->uri->segment(4);
    	$data = $this->products_model->get_list(array("product_id"=>$product_id));
        $this->render($data[0], 'fast_update_tpl');
        }
    }
    public function product_history() {
        $data = $this->input->post();

        if (!empty($data)) {
            $product_id = $data['product_id'];
            $product['product_name'] = strtoupper($data['product_name']);
            $product['product_manufacturer'] = strtoupper($data['product_manufacturer']);
            $product['product_category'] = strtoupper($data['product_category']);
            $product['product_hsn'] = $data['product_hsn'];
            $product['product_unit'] = $data['product_unit'];
            $product['product_storage'] = $data['product_storage'];
            // if (empty($product_id)) {
            //     $product_id = $this->products_model->insert_data($product);
            // } else {
            //     $this->products_model->update_data($product, array('product_id' => $product_id));
            // }
            $formatedData = null;
            foreach ($data['product_stock_batch'] as $key => $value) {
                $formatedData[$key]['product_stock_batch'] = $data['product_stock_batch'][$key];
                $formatedData[$key]['product_strip_stock'] = $data['product_strip_stock'][$key];
                $formatedData[$key]['product_loose_stock'] = $data['product_loose_stock'][$key];
                $formatedData[$key]['product_stock_date'] = $data['product_stock_date'][$key];
                $formatedData[$key]['product_expire_month'] = $data['product_expire_month'][$key];
                $formatedData[$key]['product_expire_year'] = $data['product_expire_year'][$key];
                $formatedData[$key]['product_mrp'] = $data['product_mrp'][$key];
                $formatedData[$key]['product_stock_product'] = $product_id;
            }
            $this->db->query('delete from product_stocks where product_stock_product = ' . $product_id);
            $this->{$this->targetModel}->insert_data($formatedData, true);
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        } else {
            $this->render('', 'product_history_tpl');
        }
    }

    public function shortage_view(){
        $this->load->view('console/product_stock/shortage_tpl');
    }
    public function shortage() {
    	$product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
        $per_page = 100;
        if (isset($_GET["page"])) {
        $page = $_GET["page"];
        } else {
        $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //$start = ($start_from + 1);
        $sql = "select * from products where 1=1";
        if (!empty($product_name)) {
            $sql .= " AND product_name like '%" . $product_name . "%'";
            }
            $sql .=" limit ".$start_from.",".$per_page."";
            $data = $this->db->query($sql)->result_array();
        
        foreach($data as $k=> $v){
		$stock = $this->{$this->targetModel}->stock_of_product($v['product_id']);
		 $data[$k]['left_strip']=$stock['left_strip']; 
		 $data[$k]['left_loose']=$stock['left_loose'];
        }
        if(count($data)>0){
                echo json_encode(array("status"=>"found","result"=>$data));
            }else{
                echo json_encode(array("status"=>"not found"));
            }
        //$this->render(array('result' => $data, 'total_records' => $total_records, 'total_records_per_page' => $total_records_per_page), 'shortage_tpl');
    }

    public function stock_view(){
         $this->load->view('console/product_stock/stock_tpl');
        }

	public function stock() {
        $product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
        $per_page = 50;
        if (isset($_GET["page"])) {
        $page = $_GET["page"];
        } else {
        $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
            $sql="select * from products where 1=1";
            if (!empty($product_name)) {
            $sql .= " AND product_name like '%" . $product_name . "%'";
            }
            $sql .=" limit ".$start_from.",".$per_page."";
            $data = $this->db->query($sql)->result_array();
           
            foreach($data as $k=> $v){
		      $stock = $this->{$this->targetModel}->stock_of_product($v['product_id']);
              $data[$k]['left_strip']=$stock['left_strip']; 
              $data[$k]['left_loose']=$stock['left_loose'];
            }
            if(count($data)>0){
                echo json_encode(array("status"=>"found","result"=>$data));
            }else{
                echo json_encode(array("status"=>"not found"));
            }
    }

    public function current_stock(){
        $data = $this->db->query("select product_id from products")->result_array();
        foreach($data as $k=> $v){
            $stock = $this->{$this->targetModel}->stock_of_product($v['product_id']);
            $data[$k]['left_strip']=$stock['left_strip']; 
            $data[$k]['left_loose']=$stock['left_loose'];
            $left_strip=$data[$k]['left_strip'];

             $result = $this->db->query("SELECT sum(purchase_mrp *  $left_strip) as totalamount FROM purchases WHERE purchase_date = (SELECT MAX(purchase_date) FROM purchases latest WHERE purchase_product_id = purchases.purchase_product_id) and purchase_product_id='".$v['product_id']."'")->result_array();
            $total_amount +=$result[0]['totalamount'];
            }
            echo json_encode(array("status"=>"found","result"=>$total_amount));
            // $this->load->view('console/product_stock/current_stock amount_tpl', array('total_amount' => $total_amount));
    }

    public function stock_amount() {
        $data = $this->input->post();
        $product_name = $this->input->post('product_name');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        if ($this->input->post()) {
        $sql = "SELECT product_id,product_name,purchase_date,purchase_mrp,purchase_batch FROM `products`" . " join `purchases` on products.product_id=purchases.purchase_product_id where 1=1";
        if (!empty($product_name)) {
            $sql .= " AND product_name like '%" . $product_name . "%'";
        }
        if ((!empty($start)) || (!empty($end))) {
            $sql .= " AND purchase_date between '" . $data['start'] . "' and '" . $data['end'] . "'";
        }
        $sql .=" order by purchase_date DESC";

        $data = $this->db->query($sql)->result_array();
        foreach($data as $k=> $v){
              $stock = $this->{$this->targetModel}->stock_of_product($v['product_id']);
              $data[$k]['left_strip']=$stock['left_strip']; 
              $data[$k]['left_loose']=$stock['left_loose'];
              $data[$k]['purchase_total']= ($stock['left_strip'] * $v['purchase_mrp']);
            }
        //$supplier = $this->suppliers_model->get_list();

            $this->load->view('console/product_stock/stock_ajax_amount_tpl', array('data' => $data, 'start' => $start, 'end' => $end));
        } else {
            $this->load->view('console/product_stock/stock_amount_tpl', array('data' => $data, 'start' => $start, 'end' => $end));
        }
    }    

    public function stock_by_batch() {
		$product_id=$this->input->get("product_id");
		$product_batch=$this->input->get("term");
		$isdebug = !empty($this->input->get("debug"));
	
        $purchased_batch =  $this->db->query("select distinct purchase_batch as batch,purchase_expire_month as expire_month,purchase_expire_year as expire_year,purchase_cgst_percent as cgst_percent,purchase_mrp as mrp,purchase_rate as rate from purchases where purchase_product_id=".$product_id)->result_array();

        $purcased_return =  $this->db->query("select distinct return_purchase_batch as batch,return_purchase_expire_month as expire_month,return_purchase_expire_year as expire_year,return_purchase_mrp as mrp from  return_purchases where return_purchase_product_id=".$product_id)->result_array();

        $sold_return =  $this->db->query("select distinct return_sale_batch as batch,return_sale_expire_month as expire_month,return_sale_expire_year as expire_year,return_sale_mrp as mrp from  returns_sales where return_sale_product_id=".$product_id)->result_array();

        $stock =  $this->db->query("select distinct product_stock_batch as batch,product_expire_month as expire_month,product_expire_year as expire_year,product_mrp as mrp from  product_stocks where product_stock_product=".$product_id)->result_array();

        $sale_batch =  $this->db->query("select distinct sale_batch as batch,sale_expire_month as expire_month,sale_expire_year as expire_year,sale_cgst_percent as cgst_percent,sale_mrp as mrp from sales where sale_product_id=".$product_id)->result_array();

	//pr($sale_batch);
	//pr($purchased_batch);
        $merged = array_merge($sale_batch,$purcased_return,$sold_return,$stock,$purchased_batch);
        $unique =null;
        foreach($merged as $mr){
        $unique[$mr['batch']] = $mr;
        }
        $batches = null;


        $responce = null;
        foreach($unique as $k=> $v){
			if(!(empty($product_batch)) && $v['batch']!=$product_batch){
			continue;
			}
		 $stock = $this->{$this->targetModel}->stock_of_product($product_id,$v['batch']);
		 $data[$v['batch']]['product_id']=$product_id; 
		 $data[$v['batch']]['stock']=$stock['stock']; 
		 $data[$v['batch']]['return_stock']=$stock['return_stock']; 
		 $data[$v['batch']]['sold_stock']=$stock['sold_stock']; 
		 $data[$v['batch']]['sold_return_stock']=$stock['sold_return_stock']; 
		 $data[$v['batch']]['left_strip']=$stock['left_strip']; 
		 $data[$v['batch']]['left_loose']=$stock['left_loose'];
		 $data[$v['batch']]['balance_stock']=$stock['balance_stock'];

		 $data[$v['batch']]['product_mrp']=$v['mrp']; 
		 $data[$v['batch']]['product_mrp']=$v['mrp']; 
		 $data[$v['batch']]['sale_mrp']=$v['mrp']; 
         $data[$v['batch']]['sale_rate']=$v['rate']; 
		 $data[$v['batch']]['sale_expire_month']=$v['expire_month']; 
		 $data[$v['batch']]['sale_expire_year']=$v['expire_year']; 
		 $data[$v['batch']]['sale_cgst_percent']=$v['cgst_percent']; 
		
		if($stock['left_strip']==0 && $stock['left_loose']==0 ){					
		    if(!$isdebug)
		    continue;
		}
            $responce[] = array('id' => '', 'label' => $v['batch'].' [S:'.$stock['left_strip'].'|L:'.$stock['left_loose'].']('.$v['expire_month'].'/'.$v['expire_year'].') |'.$v['mrp'], 'value' => $v['batch'], 'complete' => $data[ $v['batch']]);
			
		}
		header('Content-Type: application/json');
		echo json_encode($responce);
    }
   
 public function stock_by_batch_old() {
		$product_id=$this->input->get("product_id");
		$product_batch=$this->input->get("term");
		$isdebug = !empty($this->input->get("debug"));
	
        $purchased_batch =  $this->db->query("select distinct purchase_batch,purchase_expire_month,purchase_expire_year,purchase_cgst_percent,purchase_mrp from purchases where purchase_product_id=".$product_id)->result_array();
        $responce = null;
        foreach($purchased_batch as $k=> $v){
			if(!(empty($product_batch)) && $v['purchase_batch']!=$product_batch){
			continue;
			}
		 $stock = $this->{$this->targetModel}->stock_of_product($product_id,$v['purchase_batch']);
		 $data[$v['purchase_batch']]['product_id']=$product_id; 
		 $data[$v['purchase_batch']]['purchase_stock']=$stock['purchase_stock']; 
		 $data[$v['purchase_batch']]['purchase_return_stock']=$stock['purchase_return_stock']; 
		 $data[$v['purchase_batch']]['sold_stock']=$stock['sold_stock']; 
		 $data[$v['purchase_batch']]['sold_return_stock']=$stock['sold_return_stock']; 
		 $data[$v['purchase_batch']]['left_strip']=$stock['left_strip']; 
		 $data[$v['purchase_batch']]['left_loose']=$stock['left_loose'];
		 $data[$v['purchase_batch']]['balance_stock']=$stock['balance_stock'];

		 $data[$v['purchase_batch']]['product_mrp']=$v['purchase_mrp']; 
		 $data[$v['purchase_batch']]['product_mrp']=$v['purchase_mrp']; 
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
    $product = $this->products_model->get_list(array("product_name"=>$this->input->post('product')));
    $stock =  $this->{$this->targetModel}->stock_of_product($product[0]['product_id']);
    $this->load->view('console/product_stock/get_info_tpl', array('stock' => $stock,'product' => $product[0]));
    }

    public function get_infox(){
	    $product = $this->products_model->get_list(array("product_name"=>$this->input->post('product')));
	    $purchased_batch =  $this->db->query("select distinct purchase_batch from purchases where purchase_product_id=".$product[0]['product_id'])->result_array();
        $responce = null;
        foreach($purchased_batch as $k=> $v){
			$stock =  $this->{$this->targetModel}->stock_of_product($product[0]['product_id'],$v['purchase_batch']);
			if($stock['left_strip']==0 && $stock['left_loose']==0 ){					
				
				continue;
			}
			$data[$v['purchase_batch']] =$stock; 
		}
	    
		$this->load->view('console/product_stock/get_info_tpl', array('stock' => $data,'product' => $product[0]));

	}
    public function expiring_view(){
         $this->load->view('console/product_stock/upcomming_expire_tpl');
        }
    public function expiring() {
        $product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
        $per_page = 400;
        $page = $_GET["page"];
        if($page==0){
        $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        $current_ym = date('ym');
        $current_ym_plus = date('ym', strtotime('+4 months'));
        $plus_m = date('ym', strtotime('+4 months'));
        $sql ="select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) as up_expdate, products.*, purchases.* from purchases 
        join products on purchase_product_id = product_id) as vtable where up_expdate between $current_ym and $plus_m";
        if (!empty($product_name)) {
            $sql .= " and product_name like '%" . $product_name . "%'";
            }
            $sql .=" order by purchase_expire_year, purchase_expire_month limit $start_from,$per_page";
            $product_data = $this->db->query($sql)->result_array();
        if(count($product_data)>0){
        foreach ($product_data as $k=>$product){  
            $stock = $this->{$this->targetModel}->stock_of_product($product['product_id'],$product['purchase_batch']);
            $product_data[$k]['left_strip']=$stock['left_strip']; 
            $product_data[$k]['left_loose']=$stock['left_loose'];
            if($stock['left_strip'] ==0 && $stock['left_loose'] ==0 ){                    
                unset($product_data[$k]);
            }
        }
        // $result = $this->{$this->targetModel}->expire();
        // $this->render(array('uri'=>'expiring','result' => $result), 'expire_tpl');
       
            echo json_encode(array("status"=>"found","result"=>$product_data));
        }else{
            echo json_encode(array("status"=>"not found"));
        }
    }
    public function expired_view(){
         $this->load->view('console/product_stock/expired_tpl');
        }
    public function expired() {
        $product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
        $per_page = 1500;
        $page = $_GET["page"];
        if($page==0){
        $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //$start = ($start_from + 1);

        $current_y = date('y');
        $current_m = date('m');
        $sql = "select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) 
            as expdate, products.*, purchases.* 
                from purchases join products on purchase_product_id = product_id) as vtable where expdate <= $current_y$current_m";
        if (!empty($product_name)) {
        $sql .= " and product_name like '%" . $product_name . "%'";
         }
        $sql .=" order by purchase_expire_year desc,purchase_expire_month desc limit $start_from,$per_page";
        $product_data = $this->db->query($sql)->result_array();
        if(count($product_data)>0){
            foreach ($product_data as $k=>$product){
                $stock = $this->{$this->targetModel}->stock_of_product($product['product_id'],$product['purchase_batch']);
                $product_data[$k]['left_strip']=$stock['left_strip']; 
                $product_data[$k]['left_loose']=$stock['left_loose'];
                if($stock['left_strip']==0 && $stock['left_loose']==0 ){                    
                    unset($product_data[$k]);
                }
            }
            // $result = $this->{$this->targetModel}->expire(true);
            // $this->render(array('uri'=>'expired','result' => $result), 'expire_tpl');
       
            echo json_encode(array("status"=>"found","result"=>$product_data));
        }else{
            echo json_encode(array("status"=>"not found"));
        }
    }

    public function zeronegetive() {
		pr("work in progress",1);
        $result = $this->{$this->targetModel}->zeronegetive(true);
        $this->render(array('result' => $result), 'zeronegetive_tpl');
    }

    public function reconsile() {
        $data = json_decode(file_get_contents("https://www.medicea.in/rest/med/drug/all/Digene"), true);
        foreach ($data as $k => $d) {
            $mapped[$k]['product_name'] = $d['name'];
            $mapped[$k]['product_manufacturer'] = $d['companyName'];
            $mapped[$k]['product_category'] = $d['type'];
            $mapped[$k]['product_hsn'] = $d['hsnCode'];
            $mapped[$k]['product_unit'] = @$d['packing'];
        }
        pr(($mapped));
    }

}