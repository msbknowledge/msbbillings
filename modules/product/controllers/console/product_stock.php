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
        $this->page_config['title'] = 'Product Stock'; //search title bar
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
        //
        $data = $this->input->post();

        if (!empty($data)) {
            $product_id = $data['product_id'];
            $product['product_name'] = strtoupper($data['product_name']);
            $product['product_manufacturer'] = strtoupper($data['product_manufacturer']);
            $product['product_category'] = strtoupper($data['product_category']);
            $product['product_hsn'] = $data['product_hsn'];
            $product['product_unit'] = $data['product_unit'];
            $product['product_storage'] = $data['product_storage'];
            if (empty($product_id)) {
                $product_id = $this->products_model->insert_data($product);
            } else {
                $this->products_model->update_data($product, array('product_id' => $product_id));
            }
            $formatedData = null;
            foreach ($data['product_stock_batch'] as $key => $value) {
                $formatedData[$key]['product_stock_batch'] = $data['product_stock_batch'][$key];
                $formatedData[$key]['product_strip_stock'] = $data['product_strip_stock'][$key];
                $formatedData[$key]['product_loose_stock'] = $data['product_loose_stock'][$key];
                $formatedData[$key]['product_expire_month'] = $data['product_expire_month'][$key];
                $formatedData[$key]['product_expire_year'] = $data['product_expire_year'][$key];
                $formatedData[$key]['product_mrp'] = $data['product_mrp'][$key];
                $formatedData[$key]['product_stock_product'] = $product_id;
                $formatedData[$key]['product_stock_date'] = date("Y-m-d H:i:s");
            }
            $this->db->query('delete from product_stocks where product_stock_product = ' . $product_id);
            $this->{$this->targetModel}->insert_data($formatedData, true);
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        } else {
            $this->render('', 'fast_update_tpl');
        }
    }
    public function purchase_sale_history() {
        //
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
                $formatedData[$key]['product_expire_month'] = $data['product_expire_month'][$key];
                $formatedData[$key]['product_expire_year'] = $data['product_expire_year'][$key];
                $formatedData[$key]['product_mrp'] = $data['product_mrp'][$key];
                $formatedData[$key]['product_stock_product'] = $product_id;
            }
            $this->db->query('delete from product_stocks where product_stock_product = ' . $product_id);
            $this->{$this->targetModel}->insert_data($formatedData, true);
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        } else {
            $this->render('', 'purchase_sale_history_tpl');
        }
    }

 
    public function shortage() {
        $result = $this->{$this->targetModel}->shortage();
        $this->render(array('result' => $result), 'shortage_tpl');
    }
 public function stock() {
        $result = $this->{$this->targetModel}->stock();
       // pr($result);
        $this->render(array('result' => $result), 'stock_tpl');
    }
    public function expiring() {
        $result = $this->{$this->targetModel}->expire();
        $this->render(array('result' => $result), 'expire_tpl');
    }

    public function expired() {
        $result = $this->{$this->targetModel}->expire(true);
        $this->render(array('result' => $result), 'expire_tpl');
    }

    public function zeronegetive() {
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
