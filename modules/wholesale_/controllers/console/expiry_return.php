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
class Expiry_return extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'expiry_return_model';
        $this->page_config['tablePrimaryKey'] = $this->expiry_return_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = '  Expiry Return'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,delete,edit_detail';
        $this->page_config['searchFields'] = 'expiry_return_ref,expiry_return_entry_number,expiry_return_medicine,expiry_return_date,expiry_return_supplier,expiry_return_Batch'; //search box,
        $this->page_config['list_columns'] = 'expiry_return_entry_number,expiry_return_date,supplier_name,expiry_return_sum_total';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['use_dropdown_columns'] = 'expiry_return_supplier';
        $this->page_config['use_dropdown_columns_options']['expiry_return_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk

        /*         * end page_config* */
    }

    public function add_detail() {
        if ($this->input->post()) {
            //pr($this->input->post(),1);
            $supplier['supplier_name'] = ($this->input->post('supplier_name'));

            $supplier = ($this->input->post());
            //pr($supplier,1);
            $supplier_id = $supplier[suplier_id];

            $expiry_return = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('expiry_return_mrp')); $i++) {
                $expiry_return[$i]['expiry_return_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $expiry_return[$i]['expiry_return_supplier'] = $supplier_id;

                $expiry_return[$i]['expiry_return_entry_number'] = $this->input->post('expiry_return_entry_number');
                $expiry_return[$i]['expiry_return_strip'] = $this->input->post('expiry_return_strip')[$i];
                $expiry_return[$i]['expiry_return_medicine'] = trim($this->input->post('medicine_name')[$i]);
                $expiry_return[$i]['expiry_return_expire_month'] = $this->input->post('expiry_return_expire_month')[$i];
                $expiry_return[$i]['expiry_return_expire_year'] = $this->input->post('expiry_return_expire_year')[$i];
                $expiry_return[$i]['expiry_return_mrp'] = $this->input->post('expiry_return_mrp')[$i];
                $expiry_return[$i]['expiry_return_total'] = $this->input->post('expiry_return_total')[$i];
                $expiry_return[$i]['expiry_return_ref'] = $this->input->post('expiry_return_ref');
                $expiry_return[$i]['expiry_return_HSN'] = $this->input->post('expiry_return_HSN')[$i];
                $expiry_return[$i]['expiry_return_Batch'] = $this->input->post('expiry_return_Batch')[$i];

                //  pr($expiry_return,1);
            }
            //pr($expiry_return, 1);
            $data = $this->expiry_return_model->insert_data($expiry_return, true);
            increase_expiry_number();

            $this->render(array('status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('supplier' => $supplier_data), 'add_detail');
        }
    }

    /**
     * index show list
     */
    public function index() {
        if (!empty($this->orderby_input_process())) {
            $orderBy = " order by ";
            $orderBy .= $this->orderby_input_process();
        }
        $condition = null;

        $likeCondition = $this->generate_search_like_condition();
        $likeConditionsSql = " where 1 = 1 ";
        foreach ($likeCondition as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $likeConditionsSql .= " and $key like '%$value%'";
        }
        $paging = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        $limit = $this->current_site_settings['site_setting_record_per_page'];
        $offset = $paging;
        $sql = "SELECT expiry_returns.*,SUM(expiry_return_total) as expiry_return_sum_total,"
                . "suppliers.*"
                . " from expiry_returns "
                . " left JOIN suppliers ON suppliers.supplier_id=expiry_returns.expiry_return_supplier "
                . " $likeConditionsSql "
                . " group BY expiry_return_entry_number "
                . " $orderBy "
                . " limit $offset,$limit";
      // pr($sql);
        $countsql = "select count(*) as totalrw from ( SELECT expiry_returns.expiry_return_entry_number from expiry_returns"
                . " $likeConditionsSql "
                . " group BY expiry_return_entry_number) as countData ";
        $allData['current_paged_list'] = $this->db->query($sql)->result_array();
        $totalrw = $this->db->query($countsql)->result_array();
        $allData['total_rows'] = $totalrw[0]['totalrw'];
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function index_old() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();

        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'expiry_return_entry_number');
        //  $allData['current_paged_list'] = $this->db->query("SELECT *,suppliers.supplier_id,suppliers.supplier_name,suppliers.supplier_address,suppliers.supplier_contact,suppliers.supplier_gst from expiry_returns JOIN suppliers ON suppliers.supplier_id=expiry_returns.expiry_return_supplier group BY expiry_return_entry_number ORDER BY expiry_return_entry_number DESC")->result_array();
//pr($allData);
        foreach ($allData['current_paged_list'] as $key => $value) {
            $totalSum = $this->db->query('select sum(expiry_return_total) as sum_total from expiry_returns where expiry_return_entry_number= "' . $value['expiry_return_entry_number'] . '"')->result_array();

            $allData['current_paged_list'][$key]['expiry_return_sum_total'] = round($totalSum[0]['sum_total']);
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

        $data = $this->{$this->targetModel}->get_list(array('expiry_return_entry_number' => $invoice));
        if ($type == 'print')
            $this->load->view('console/expiry_return/print_detail', array('data' => $data));
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
        $dataFull = $this->{$this->targetModel}->get_list(array('expiry_return_entry_number' => $invoice));
        //pr($dataFull);
        if ($this->input->post()) {

            // pr($this->input->post(),1);
            $supplier = ($this->input->post());
            //pr($supplier,1);
            $supplier_id = $supplier[suplier_id];
            $expiry_return = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('expiry_return_mrp')); $i++) {
                $expiry_return[$i]['expiry_return_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $expiry_return[$i]['expiry_return_supplier'] = $supplier_id;
                $expiry_return[$i]['expiry_return_entry_number'] = $this->input->post('expiry_return_entry_number');
                $expiry_return[$i]['expiry_return_strip'] = $this->input->post('expiry_return_strip')[$i];
                $expiry_return[$i]['expiry_return_medicine'] = trim($this->input->post('medicine_name')[$i]);
                $expiry_return[$i]['expiry_return_expire_month'] = $this->input->post('expiry_return_expire_month')[$i];
                $expiry_return[$i]['expiry_return_expire_year'] = $this->input->post('expiry_return_expire_year')[$i];
                $expiry_return[$i]['expiry_return_mrp'] = $this->input->post('expiry_return_mrp')[$i];
                $expiry_return[$i]['expiry_return_total'] = $this->input->post('expiry_return_total')[$i];
                $expiry_return[$i]['expiry_return_ref'] = $this->input->post('expiry_return_ref');
                $expiry_return[$i]['expiry_return_HSN'] = $this->input->post('expiry_return_HSN')[$i];
                $expiry_return[$i]['expiry_return_Batch'] = $this->input->post('expiry_return_Batch')[$i];
                //  pr($expiry_return,1);
            }
            // pr($expiry_return, 1);
            $this->db->query('DELETE FROM `expiry_returns` WHERE expiry_return_entry_number=' . $expiry_return[0]['expiry_return_entry_number']);

            $data = $this->expiry_return_model->insert_data($expiry_return, true);
            //increase_expiry_number();

            redirect(console_url('expiry_return'));
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

            $this->{$this->targetModel}->delete(array('expiry_return_entry_number' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            // $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('expiry_return_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function expiry_report() {
        $data = $this->input->post();
        $supplier_id = $this->input->post('supplier_id');
        $supplier_name = $this->input->post('supplier_name');
        $expiry_return_medicine = $this->input->post('expiry_return_medicine');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $expiry_return_ref = $this->input->post('expiry_return_ref');
        $expiry_return_Batch = $this->input->post('expiry_return_Batch');
        if (!empty($data)) {
            $sql = "SELECT * FROM `expiry_returns` "
                    . "join `suppliers` on expiry_returns.expiry_return_supplier=suppliers.supplier_id where 1=1 ";

            if (!empty($supplier_name)) {
                $sql .= "AND supplier_name like '%" . $supplier_name . "%'";
            }
            if ((!empty($start)) || (!empty($end))) {
                $sql .= "AND expiry_return_date between '" . $data['start'] . "' and '" . $data['end'] . "'";
            }
            if (!empty($expiry_return_medicine)) {
                $sql .= "AND expiry_return_medicine like '%" . $expiry_return_medicine . "%'";
            }
            if (!empty($expiry_return_Batch)) {
                $sql .= "AND expiry_return_Batch like '%" . $expiry_return_Batch . "%'";
            }
            if (!empty($expiry_return_ref)) {
                $sql .= "AND expiry_return_ref like '%" . $expiry_return_ref . "%'";
            }
            $sql .=" order by expiry_return_date DESC";
            $collections = $this->db->query($sql)->result_array();

            $expiry_return_data = null;
            foreach ($collections as $key => $var) {
                $expiry_return_data[$key]['supplier_id'] = $var['supplier_id'];
                $expiry_return_data[$key]['supplier_name'] = $var['supplier_name'];
                $expiry_return_data[$key]['expiry_return_medicine'] = $var['expiry_return_medicine'];
                $expiry_return_data[$key]['expiry_return_Batch'] = $var['expiry_return_Batch'];
                $expiry_return_data[$key]['expiry_return_date'] = $var['expiry_return_date'];
                $expiry_return_data[$key]['expiry_return_ref'] = $var['expiry_return_ref'];
                $expiry_return_data[$key]['expiry_return_total'] = $var['expiry_return_total'];
            }
        }
        $supplier = $this->suppliers_model->get_list();
        if ($this->input->post()) {
            //         pr($this->input->post(),1);
            $this->load->view('console/expiry_return/expiry_ajax_report_tpl', array('expiry_return_data' => $expiry_return_data, 'start' => $start, 'end' => $end));
        } else {
            $this->load->view('console/expiry_return/expiry_report_tpl', array('expiry_return_data' => $expiry_return_data, 'start' => $start, 'end' => $end, 'supplier' => $supplier));
        }
    }

}

?>