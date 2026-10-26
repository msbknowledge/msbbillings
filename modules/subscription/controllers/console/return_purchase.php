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
class Return_purchase extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'return_purchase_model';
        $this->page_config['tablePrimaryKey'] = $this->return_purchase_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = '  Sale Return'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,delete,edit_detail';
        $this->page_config['searchFields'] = 'return_purchase_ref,return_purchase_product,return_purchase_date,return_purchase_supplier,return_purchase_Batch'; //search box,
        $this->page_config['list_columns'] = 'return_purchase_entry_number,return_purchase_date,return_purchase_supplier,return_purchase_sum_total,return_purchase_HSN,return_purchase_Batch';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['product_name'] = array('products' => 'product_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['use_dropdown_columns'] = 'product_name,return_purchase_supplier';
        $this->page_config['use_dropdown_columns_options']['return_purchase_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk

        /*         * end page_config* */
    }

    public function add_detail() {
        if ($this->input->post()) {

            $supplier = ($this->input->post());
            //pr($supplier,1);
            $supplier_ID = $supplier['suplier_id'];
            //pr($supplier_ID,1);
            $return_purchase = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_purchase_mrp')); $i++) {
                $return_purchase[$i]['return_purchase_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_purchase[$i]['return_purchase_supplier'] = $supplier_ID;

                $return_purchase[$i]['return_purchase_entry_number'] = $this->input->post('return_purchase_entry_number');
                $return_purchase[$i]['return_purchase_strip'] = $this->input->post('return_purchase_strip')[$i];
                $return_purchase[$i]['return_purchase_product'] = trim($this->input->post('product_name')[$i]);
                $return_purchase[$i]['return_purchase_expire_month'] = $this->input->post('return_purchase_expire_month')[$i];
                $return_purchase[$i]['return_purchase_expire_year'] = $this->input->post('return_purchase_expire_year')[$i];
                $return_purchase[$i]['return_purchase_mrp'] = $this->input->post('return_purchase_mrp')[$i];
                $return_purchase[$i]['return_purchase_total'] = $this->input->post('return_purchase_total')[$i];
                $return_purchase[$i]['return_purchase_ref'] = $this->input->post('return_purchase_ref');
                $return_purchase[$i]['return_purchase_HSN'] = $this->input->post('product_hsn')[$i];
                $return_purchase[$i]['return_purchase_Batch'] = $this->input->post('return_purchase_Batch')[$i];
                //  pr($return_purchase,1);
            }
            // pr($return_purchase, 1);
            $data = $this->return_purchase_model->insert_data($return_purchase, true);
            increase_expiry_number();
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('supplier' => $supplier_data, 'status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $supplier_data = $this->suppliers_model->get_list();
//pr($supplier_data);
            $this->render(array('supplier' => $supplier_data), 'add_detail');
        }
    }

    /**
     * index show list
     */
    public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();

        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'return_purchase_entry_number');
        //pr($this->db->last_query());
        foreach ($allData['current_paged_list'] as $key => $value) {
            $totalSum = $this->db->query('select sum(return_purchase_total) as sum_total from return_purchases where return_purchase_entry_number= "' . $value['return_purchase_entry_number'] . '"')->result_array();
            ;
            $allData['current_paged_list'][$key]['return_purchase_sum_total'] = round($totalSum[0]['sum_total']);
        }

        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data, 'index_tpl');
        }
    }

    /**
     * view detail
     */
    public function view_detail() {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));

        $data = $this->{$this->targetModel}->get_list(array('return_purchase_entry_number' => $invoice));
        if ($type == 'print')
            $this->load->view('console/return_purchase/print_detail', array('data' => $data));
        else
            $this->render(array('data' => $data), 'view_detail');
    }

    /**
     * view detail
     */

    /**
     * view detail
     */
    public function edit_detail() {
        $invoice = base64_decode($this->uri->segment(4));
        $dataFull = $this->{$this->targetModel}->get_list(array('return_purchase_entry_number' => $invoice));
        //pr($dataFull,1);
        if ($this->input->post()) {

            // pr($this->input->post(),1);

            $supplier = ($this->input->post());
            // pr($supplier,1);
            $supplier_ID = $supplier['suplier_id'];
            //pr($supplier_ID,1);
            $return_purchase = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_purchase_mrp')); $i++) {
                $return_purchase[$i]['return_purchase_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_purchase[$i]['return_purchase_supplier'] = $supplier_ID;
                $return_purchase[$i]['return_purchase_entry_number'] = $this->input->post('return_purchase_entry_number');
                $return_purchase[$i]['return_purchase_strip'] = $this->input->post('return_purchase_strip')[$i];
                $return_purchase[$i]['return_purchase_product'] = trim($this->input->post('product_name')[$i]);
                $return_purchase[$i]['return_purchase_expire_month'] = $this->input->post('return_purchase_expire_month')[$i];
                $return_purchase[$i]['return_purchase_expire_year'] = $this->input->post('return_purchase_expire_year')[$i];
                $return_purchase[$i]['return_purchase_mrp'] = $this->input->post('return_purchase_mrp')[$i];
                $return_purchase[$i]['return_purchase_total'] = $this->input->post('return_purchase_total')[$i];
                $return_purchase[$i]['return_purchase_ref'] = $this->input->post('return_purchase_ref');
                $return_purchase[$i]['return_purchase_HSN'] = $this->input->post('return_purchase_HSN')[$i];
                $return_purchase[$i]['return_purchase_Batch'] = $this->input->post('return_purchase_Batch')[$i];
                //  pr($return_purchase,1);
            }
            // pr($return_purchase, 1);
            $this->db->query('DELETE FROM `return_purchases` WHERE return_purchase_entry_number=' . $return_purchase[0]['return_purchase_entry_number']);

            $data = $this->return_purchase_model->insert_data($return_purchase, true);
            increase_expiry_number();

            redirect(console_url('return_purchase'));
        } else {
            $supplier_data = $this->suppliers_model->get_list();

            $this->render(array('supplier' => $supplier_data, 'data' => $dataFull), 'edit_detail_tpl');
        }
    }

    /**
     * delete
     */
    public function delete() {
        $postedData = $this->input->post();
        if (isset($postedData['selectedItem'])) {
            foreach ($postedData['selectedItem'] as $k => $value) {
                $postedData['selectedItem'][$k] = base64_decode($value);
            }
            $this->medical_stock_rollback($postedData['selectedItem']);

            $this->{$this->targetModel}->delete(array('return_perchase_entry_number' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            // $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('return_purchase_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function purchases_report() {


        $supplier_id = $this->input->post('supplier_id');
        $supplier_name = $this->input->post('supplier_name');
        $return_purchase_product = $this->input->post('return_purchase_product');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $return_purchase_Batch = $this->input->post('return_purchase_Batch');
        $return_purchase_ref = $this->input->post('return_purchase_ref');

        $sql = "SELECT * FROM `return_purchases` join `suppliers` on return_purchases.return_purchase_supplier=suppliers.supplier_id where 1=1 ";

        if (!empty($supplier_name)) {
            $sql .= "AND supplier_name like '%" . $supplier_name . "%'";
        }
        if ((!empty($start)) || (!empty($end))) {
            $sql .= "AND return_purchase_date between '" . $data['start'] . "' and '" . $data['end'] . "'";
        }
        if (!empty($return_purchase_product)) {
            $sql .= "AND return_purchase_product like '%" . $return_purchase_product . "%'";
        }
        if (!empty($return_purchase_Batch)) {
            $sql .= "AND return_purchase_Batch like '%" . $return_purchase_Batch . "%'";
        }
        if (!empty($return_purchase_ref)) {
            $sql .= "AND return_purchase_ref like '%" . $return_purchase_ref . "%'";
        }
        $collections = $this->db->query($sql)->result_array();
//pr($collections,1);

        $return_purchase_data = null;
        foreach ($collections as $key => $var) {
            $return_purchase_data[$key]['supplier_id'] = $var['supplier_id'];
            $return_purchase_data[$key]['supplier_name'] = $var['supplier_name'];
            $return_purchase_data[$key]['return_purchase_product'] = $var['return_purchase_product'];
            $return_purchase_data[$key]['return_purchase_Batch'] = $var['return_purchase_Batch'];
            $return_purchase_data[$key]['return_purchase_date'] = $var['return_purchase_date'];
            $return_purchase_data[$key]['return_purchase_ref'] = $var['return_purchase_ref'];
            $return_purchase_data[$key]['return_purchase_total'] = $var['return_purchase_total'];
        }


//pr($return_purchase_data,1);
        $supplier = $this->suppliers_model->get_list();
        if ($this->input->post()) {

            $this->load->view('console/return_purchase/purchase_ajax_report_tpl', array('return_purchase_data' => $return_purchase_data, 'start' => $start, 'end' => $end, 'supplier' => $supplier));
        } else {
            $this->load->view('console/return_purchase/purchase_report_tpl', array('return_purchase_data' => $return_purchase_data, 'start' => $start, 'end' => $end, 'supplier' => $supplier));
        }
    }

}

?>