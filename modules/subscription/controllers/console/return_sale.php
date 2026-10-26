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
class Return_sale extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'return_sale_model';
        $this->page_config['tablePrimaryKey'] = $this->return_sale_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] ='  Sale Return'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,delete,edit_detail';
        $this->page_config['searchFields'] = 'return_sale_ref,return_sale_product,return_sale_date,return_sale_customer,return_sale_Batch'; //search box,
        $this->page_config['list_columns'] = 'return_sale_entry_number,return_sale_date,return_sale_customer,return_sale_sum_total,return_sale_HSN,return_sale_Batch';
        $this->page_config['autocomplete']['customer_name'] = array('customers' => 'customer_name');
        $this->page_config['autocomplete']['customer_gst'] = array('customers' => 'customer_gst');
        $this->page_config['use_dropdown_columns'] = 'product_name,return_sale_customer';
        $this->page_config['use_dropdown_columns_options']['return_sale_customer'] = $this->customers_model->get_list_for_dropdown('customer_name'); //pk

        /*         * end page_config* */
    }

    public function add_detail() {
        if ($this->input->post()) {

            $customer = ($this->input->post());
            //pr($customer,1);
            $customer_ID= $customer['customer_id'];
 //pr($customer_ID,1);
            $return_sale = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_sale_mrp')); $i++) {
                $return_sale[$i]['return_sale_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_sale[$i]['return_sale_customer'] = $customer_ID;

                $return_sale[$i]['return_sale_entry_number'] = $this->input->post('return_sale_entry_number');
                $return_sale[$i]['return_sale_strip'] = $this->input->post('return_sale_strip')[$i];
                $return_sale[$i]['return_sale_product'] = trim($this->input->post('product_name')[$i]);
                $return_sale[$i]['return_sale_expire_month'] = $this->input->post('return_sale_expire_month')[$i];
                $return_sale[$i]['return_sale_expire_year'] = $this->input->post('return_sale_expire_year')[$i];
                $return_sale[$i]['return_sale_mrp'] = $this->input->post('return_sale_mrp')[$i];
                $return_sale[$i]['return_sale_total'] = $this->input->post('return_sale_total')[$i];
                $return_sale[$i]['return_sale_ref'] = $this->input->post('return_sale_ref');
                $return_sale[$i]['return_sale_HSN'] = $this->input->post('return_sale_HSN')[$i];
                $return_sale[$i]['return_sale_Batch'] = $this->input->post('return_sale_Batch')[$i];
                //  pr($return_sale,1);
            }
            //pr($return_sale, 1);
            $data = $this->return_sale_model->insert_data($return_sale, true);
            increase_expiry_number();
            $customer_data = $this->customers_model->get_list();
            $this->render(array('customer' => $customer_data,'status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $customer_data = $this->customers_model->get_list();
//pr($customer_data);
            $this->render(array('customer' => $customer_data), 'add_detail');
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

        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'return_sale_entry_number');
        //pr($this->db->last_query());
        foreach ($allData['current_paged_list'] as $key => $value) {
            $totalSum = $this->db->query('select sum(return_sale_total) as sum_total from returns_sales where return_sale_entry_number= "' . $value['return_sale_entry_number'] . '"')->result_array();
            ;
            $allData['current_paged_list'][$key]['return_sale_sum_total'] = round($totalSum[0]['sum_total']);
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

        $data = $this->{$this->targetModel}->get_list(array('return_sale_entry_number' => $invoice));
        if ($type == 'print')
            $this->load->view('console/return_sale/print_detail', array('data' => $data));
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
        $dataFull = $this->{$this->targetModel}->get_list(array('return_sale_entry_number' => $invoice));
        //pr($dataFull,1);
        if ($this->input->post()) {

            // pr($this->input->post(),1);

            $customer = ($this->input->post());
            // pr($customer,1);
            $customer_ID = $customer[customer_ID];
            //pr($customer_id,1);
            $return_sale = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_sale_mrp')); $i++) {
                $return_sale[$i]['return_sale_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_sale[$i]['return_sale_customer'] = $customer_ID;
                $return_sale[$i]['return_sale_entry_number'] = $this->input->post('return_sale_entry_number');
                $return_sale[$i]['return_sale_strip'] = $this->input->post('return_sale_strip')[$i];
                $return_sale[$i]['return_sale_product'] = trim($this->input->post('product_name')[$i]);
                $return_sale[$i]['return_sale_expire_month'] = $this->input->post('return_sale_expire_month')[$i];
                $return_sale[$i]['return_sale_expire_year'] = $this->input->post('return_sale_expire_year')[$i];
                $return_sale[$i]['return_sale_mrp'] = $this->input->post('return_sale_mrp')[$i];
                $return_sale[$i]['return_sale_total'] = $this->input->post('return_sale_total')[$i];
                $return_sale[$i]['return_sale_ref'] = $this->input->post('return_sale_ref');
                $return_sale[$i]['return_sale_HSN'] = $this->input->post('return_sale_HSN')[$i];
                $return_sale[$i]['return_sale_Batch'] = $this->input->post('return_sale_Batch')[$i];
                //  pr($return_sale,1);
            }
            // pr($return_sale, 1);
            $this->db->query('DELETE FROM `returns_sales` WHERE return_sale_entry_number=' . $return_sale[0]['return_sale_entry_number']);

            $data = $this->return_sale_model->insert_data($return_sale, true);
            //increase_expiry_number();

            redirect(console_url('return_sale'));
        } else {
            $customer_data = $this->customers_model->get_list();

            $this->render(array('customer' => $customer_data, 'data' => $dataFull), 'edit_detail_tpl');
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

            $this->{$this->targetModel}->delete(array('return_perche_entry_number' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            // $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('return_sale_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function sale_report() {
        $data = $this->input->post();
        $customer_ID = $this->input->post('customer_ID');
        $customer_name = $this->input->post('customer_name');
        $return_sale_product = $this->input->post('return_sale_product');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $return_sale_Batch = $this->input->post('return_sale_Batch');
        $return_sale_ref = $this->input->post('return_sale_ref');
        if (!empty($data)) {
            $sql = "SELECT * FROM `returns_sales` "
                    . "join `customers` on returns_sales.return_sale_customer=customers.customer_ID where 1=1 ";

            if (!empty($customer_name)) {
                $sql .= "AND customer_name like '%" . $customer_name . "%'";
            }
            if ((!empty($start)) || (!empty($end))) {
                $sql .= "AND return_sale_date between '" . $data['start'] . "' and '" . $data['end'] . "'";
            }
            if (!empty($return_sale_product)) {
                $sql .= "AND return_sale_product like '%" . $return_sale_product . "%'";
            }
            if (!empty($return_sale_Batch)) {
                $sql .= "AND return_sale_Batch like '%" . $return_sale_Batch . "%'";
            }
            if (!empty($return_sale_ref)) {
                $sql .= "AND return_sale_ref like '%" . $return_sale_ref . "%'";
            }
            $collections = $this->db->query($sql)->result_array();

            $return_sale_data = null;
            foreach ($collections as $key => $var) {
                $return_sale_data[$key]['customer_ID'] = $var['customer_ID'];
                $return_sale_data[$key]['customer_name'] = $var['customer_name'];
                $return_sale_data[$key]['return_sale_product'] = $var['return_sale_product'];
                $return_sale_data[$key]['return_sale_Batch'] = $var['return_sale_Batch'];
                $return_sale_data[$key]['return_sale_date'] = $var['return_sale_date'];
                $return_sale_data[$key]['return_sale_ref'] = $var['return_sale_ref'];
                $return_sale_data[$key]['return_sale_total'] = $var['return_sale_total'];
            }
        }
        $customer = $this->customers_model->get_list();
        if ($this->input->post()) {

            $this->load->view('console/return_sale/sale_ajax_report_tpl', array('return_sale_data' => $return_sale_data, 'start' => $start, 'end' => $end));
        } else {
            $this->load->view('console/return_sale/sale_report_tpl', array('return_sale_data' => $return_sale_data, 'start' => $start, 'end' => $end, 'customer' => $customer));
        }
    }

}

?>