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
        $this->page_config['title'] = 'Return Purchase'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,delete,edit_detail';
        $this->page_config['searchFields'] = 'return_purchase_ref,return_purchase_type,return_purchase_medicine,return_purchase_date,return_purchase_supplier,return_purchase_Batch'; //search box,
        $this->page_config['list_columns'] = 'return_purchase_entry_number,return_purchase_type,return_purchase_date,return_purchase_supplier,return_purchase_sum_total,return_purchase_HSN,return_purchase_Batch';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['use_dropdown_columns'] = 'medicine_name,return_purchase_supplier,return_purchase_type';
        $this->page_config['use_dropdown_columns_options']['return_purchase_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk
        $this->page_config['use_dropdown_columns_options']['return_purchase_type'] = array("expiry"=>"Expiry","extra"=>"Extra","damage"=>"Damage");

        /*         * end page_config* */
    }

    public function add_detail() {
    	
        if ($this->input->post()) {

            $supplier = ($this->input->post());
           
            $supplier_ID = $supplier['suplier_id'];
            //pr($supplier_ID,1);
            $return_purchase = null;
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_purchase_mrp')); $i++) {
                $return_purchase[$i]['return_purchase_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_purchase[$i]['return_purchase_supplier'] = $supplier_ID;
                $return_purchase[$i]['return_purchase_type'] = $this->input->post('return_purchase_type');

                $return_purchase[$i]['return_purchase_entry_number'] = $this->input->post('return_purchase_entry_number');
                $return_purchase[$i]['return_purchase_strip'] = $this->input->post('return_purchase_strip')[$i];
 				$medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                     } else {
                    $medicine_id = $data[0]['medicine_id'];
                }
                $return_purchase[$i]['return_purchase_medicine_id'] = $medicine_id;

				$return_purchase[$i]['return_purchase_medicine'] = trim($this->input->post('medicine_name')[$i]);
                $return_purchase[$i]['return_purchase_expire_month'] = $this->input->post('return_purchase_expire_month')[$i];
                $return_purchase[$i]['return_purchase_expire_year'] = $this->input->post('return_purchase_expire_year')[$i];
                $return_purchase[$i]['return_purchase_mrp'] = $this->input->post('return_purchase_mrp')[$i];
                $return_purchase[$i]['return_purchase_total'] = $this->input->post('return_purchase_total')[$i];
                $return_purchase[$i]['return_purchase_ref'] = $this->input->post('return_purchase_ref');
                $return_purchase[$i]['return_purchase_HSN'] = $this->input->post('medicine_hsn')[$i];
                $return_purchase[$i]['return_purchase_Batch'] = $this->input->post('return_purchase_Batch')[$i];
                //  pr($return_purchase,1);
				}
            // print_r($return_purchase);
            // die();
            // pr($return_purchase, 1);
            $data = $this->return_purchase_model->insert_data($return_purchase, true);
            increase_expiry_number();
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('return_purchase_type'=>$this->page_config['use_dropdown_columns_options']['return_purchase_type'],'supplier' => $supplier_data, 'status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('return_purchase_type'=>$this->page_config['use_dropdown_columns_options']['return_purchase_type'],'supplier' => $supplier_data), 'add_detail');
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
        $sql = "SELECT return_purchases.*,SUM(return_purchase_total) as return_purchase_sum_total,"
                . "suppliers.*"
                . " from return_purchases "
                . " left JOIN suppliers ON suppliers.supplier_id=return_purchases.return_purchase_supplier "
                . " $likeConditionsSql "
                . " group BY return_purchase_entry_number "
                . " $orderBy "
                . " limit $offset,$limit";
      // pr($sql);
        $countsql = "select count(*) as totalrw from ( SELECT return_purchases.return_purchase_entry_number from return_purchases"
                . " $likeConditionsSql "
                . " group BY return_purchase_entry_number) as countData ";
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
    /**
     * index show list
     */
    public function index_old() {

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
            $return_purchase = null;
            $stock = 0;
            $unit = 0;


            for ($i = 0; $i < count($this->input->post('return_purchase_mrp')); $i++) {
                $return_purchase[$i]['return_purchase_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
 				$medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                     } else {
                    $medicine_id = $data[0]['medicine_id'];
                }
                $return_purchase[$i]['return_purchase_medicine_id'] = $medicine_id;

                $return_purchase[$i]['return_purchase_supplier'] = $supplier_ID;
                $return_purchase[$i]['return_purchase_type'] = $this->input->post('return_purchase_type');

                $return_purchase[$i]['return_purchase_entry_number'] = $this->input->post('return_purchase_entry_number');
                $return_purchase[$i]['return_purchase_strip'] = $this->input->post('return_purchase_strip')[$i];
                $return_purchase[$i]['return_purchase_medicine'] = trim($this->input->post('medicine_name')[$i]);
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
            $this->render(array('return_purchase_type'=>$this->page_config['use_dropdown_columns_options']['return_purchase_type'],'supplier' => $supplier_data, 'data' => $dataFull), 'edit_detail_tpl');
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
            $this->{$this->targetModel}->delete(array('return_purchase_entry_number' => $postedData['selectedItem']), TRUE);
        }
        if (isset($postedData['entry'])) {
            $this->{$this->targetModel}->delete(array('return_purchase_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function purchases_report() {
        $data = $this->input->post();
        $supplier_id = $this->input->post('supplier_id');
        $supplier_name = $this->input->post('supplier_name');
        $return_purchase_type = $this->input->post('return_purchase_type');
        $return_purchase_medicine = $this->input->post('return_purchase_medicine');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $return_purchase_Batch = $this->input->post('return_purchase_Batch');
        $return_purchase_ref = $this->input->post('return_purchase_ref');

        $sql = "SELECT * FROM `return_purchases`" . " join `suppliers` on return_purchases.return_purchase_supplier=suppliers.supplier_id where 1=1";
        if (!empty($supplier_name)) {
            $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
        }
        if (!empty($return_purchase_type)) {
            $sql .= " AND return_purchase_type like '%" . $return_purchase_type . "%'";
        }
        if ((!empty($start)) || (!empty($end))) {
            $sql .= " AND return_purchase_date between '" . $data['start'] . "' and '" . $data['end'] . "'";
        }
        if (!empty($return_purchase_medicine)) {
            $sql .= " AND return_purchase_medicine like '%" . $return_purchase_medicine . "%'";
        }
        if (!empty($return_purchase_Batch)) {
            $sql .= " AND return_purchase_Batch like '%" . $return_purchase_Batch . "%'";
        }
        if (!empty($return_purchase_ref)) {
            $sql .= " AND return_purchase_ref like '%" . $return_purchase_ref . "%'";
        }
        $sql .=" order by return_purchase_date DESC";

        $collections = $this->db->query($sql)->result_array();
        //print_r($collections);
        $return_purchase_data = null;
        foreach ($collections as $key => $var) {
            $return_purchase_data[$key]['supplier_id'] = $var['supplier_id'];
            $return_purchase_data[$key]['supplier_name'] = $var['supplier_name'];
            $return_purchase_data[$key]['return_purchase_strip'] = $var['return_purchase_strip'];
            $return_purchase_data[$key]['return_purchase_type'] = $var['return_purchase_type'];
            $return_purchase_data[$key]['return_purchase_medicine'] = $var['return_purchase_medicine'];
            $return_purchase_data[$key]['return_purchase_Batch'] = $var['return_purchase_Batch'];
            $return_purchase_data[$key]['return_purchase_date'] = $var['return_purchase_date'];
            $return_purchase_data[$key]['return_purchase_ref'] = $var['return_purchase_ref'];
            $return_purchase_data[$key]['return_purchase_mrp'] = $var['return_purchase_mrp'];
            $return_purchase_data[$key]['return_purchase_expire_month'] = $var['return_purchase_expire_month'];
            $return_purchase_data[$key]['return_purchase_expire_year'] = $var['return_purchase_expire_year'];
            $return_purchase_data[$key]['return_purchase_total'] = $var['return_purchase_total'];
        }
        $supplier = $this->suppliers_model->get_list();
        if ($this->input->post()) {

            $this->load->view('console/return_purchase/purchase_ajax_report_tpl', array('return_purchase_data' => $return_purchase_data, 'start' => $start, 'end' => $end, 'supplier' => $supplier));
        } else {
            //$this->load->view('console/return_purchase/purchase_report_tpl', array('return_purchase_data' => $return_purchase_data, 'start' => $start, 'end' => $end, 'supplier' => $supplier));
             $this->render(array('return_purchase_data' => $return_purchase_data, 'start' => $start, 'end' => $end, 'supplier' => $supplier), 'purchase_report_tpl');
        }
    }
    public function fetch_medicine_return() {
        $data = $this->input->post();
        $datas['medicine_name'] =trim($data['medicine']);
       // $datas['return_purchase_Batch'] =trim($data['purchase_Batch']);
        $data_r = $this->medicines_model->get_list($datas);
        $response['medicine_count'] = count($data_r);
        header('Content-Type: application/json');
        echo json_encode($response); 
    }
  public function fetch_invoice_details()
    {
        
        $postedData = $this->input->get();
        $invoice = $postedData['term'];

         $data = $this->purchases_model->get_list(array('purchase_batch' => $invoice));
//print_r(   $data );die();
        foreach ($data as $key => $value) {
            $responce[] = array('id' => $value['purchase_invoice'], 'label' => $value['purchase_invoice'], 'value' => $value['purchase_invoice'], 'complete' => $value, 'data' => $data);
        }
        echo json_encode($responce);
    }
}

?>
