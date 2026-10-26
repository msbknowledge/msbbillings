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
class Payments extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'payments_model';
        $this->moduleMeta = array('product' => 'Payments');
        $this->page_config['tablePrimaryKey'] = $this->payments_model->get_primary_key(); //pk
        /*         * page_config* */

        $this->page_config['title'] = 'Payments'; //search title bar
        $this->page_config['searchFields'] = 'payment_suppliers,payment_date,payment_ID'; //search box,
        $this->page_config['list_columns'] = 'payment_ID,payment_suppliers,payment_date,payment_paid_amount,payment_note';
        $this->page_config['use_dropdown_columns'] = 'payment_suppliers,';
        $this->page_config['use_dropdown_columns_options']['payment_suppliers'] = $this->suppliers_model->get_list_for_dropdown('supplier_name');
        /*         * end page_config* */
    }

    public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config);
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function add_payment_supplier() {
        $this->load->model('purchases_model');
        $postedData = $this->input->post('supplier_id');
        $pre_payment_invoice = $this->input->post('pre_payment_invoice');
        //pr($this->input->post());
        if (!empty($postedData)) {
            $alldata = $this->db->query("select payment_invoice from payments where payment_suppliers=$postedData")->result_array();
            // pr($alldata);
            $pre_payment_invoice = "";
            foreach ($alldata as $k => $v) {
                if (!empty($pre_payment_invoice) && (!empty($v['payment_invoice']))) {

                    $pre_payment_invoice .= ',' . $v['payment_invoice'];
                } else {

                    $pre_payment_invoice .= $v['payment_invoice'];
                }
            }

            $sql = "
                select sum(purchases.purchase_total) as total,purchases.purchase_entry_number,
                purchases.purchase_date,purchases.purchase_invoice,suppliers.supplier_name,suppliers.supplier_id 
                from purchases  join suppliers on 
                purchases.purchase_supplier=suppliers.supplier_id 
                WHERE supplier_id=$postedData ";
            if (!empty($pre_payment_invoice)) {
                $sql .= "AND  purchases.purchase_invoice NOT IN($pre_payment_invoice)";
            }
            $sql .= " group by purchase_invoice";
            $sql .= " ORDER BY purchase_date DESC ";
//pr($sql);
            $data = $this->db->query($sql)->result_array();

            $this->load->view('console/payment/dropdown_list_tpl', array('data' => $data));
        }
    }

    // public function add_detail() {
    //     $postedData = $this->input->post();
    //     $config = $this->auto_fieldtype_detect(NULL);
    //     $this->page_config = array_merge($config, $this->page_config);
    //     if (isset($postedData['load_add_entry'])) {
    //         $entryData = $this->{$this->targetModel}->get_field_list();
    //         echo $this->generate_form_view($entryData[0], $this->page_config, 'payment/add_detail');
    //     } else {
    //         if ($postedData) {
    //             /** status* */
    //             $config = $this->auto_fieldtype_detect(NULL);
    //             if (isset($config['use_status_columns'])) {
    //                 foreach ($config['use_status_columns'] as $statusColumn) {
    //                     $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
    //                 }
    //             }
    //             /*                 * multi chooser */
    //             if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
    //                 foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
    //                     if (isset($postedData[$multiChooser]))
    //                         $postedData[$multiChooser] = is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
    //                     else
    //                         $postedData[$multiChooser] = '["0"]';
    //                 }
    //             }
    //             $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);

    //             echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
    //         }
    //     }
    // }

    // public function edit_detail() {
    //     $postedData = $this->input->post();
    //     $config = $this->auto_fieldtype_detect(NULL);
    //     $this->page_config = array_merge($config, $this->page_config);
    //     if (isset($postedData['load_edit_entry'])) {
    //         $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
    //         $entryData1 = $this->{$this->targetModel}->get_field_list();
    //         $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
    //         echo $this->generate_form_view($entryData, $this->page_config, 'payment/add_detail');
    //     } else {
    //         if ($postedData) {
    //             /** status* */
    //             if (isset($config['use_status_columns'])) {
    //                 foreach ($config['use_status_columns'] as $statusColumn) {
    //                     $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
    //                 }
    //             }
    //             /*                 * multi chooser */
    //             if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
    //                 foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
    //                     $postedData[$multiChooser] = @is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
    //                 }
    //             }

    //             $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
    //             echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
    //         }
    //     }
    // }

    /**
     * view detail
     */
    // public function view_detail() {
    //     $config = $this->auto_fieldtype_detect(NULL);
    //     $this->page_config = array_merge($config, $this->page_config);
    //     $entryID = trim($this->input->post('entry'));
    //     $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
    //     $entryData1 = $this->{$this->targetModel}->get_field_list();
    //     $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
    //     echo $this->generate_detail_view($entryData, $this->page_config);
    // }

    public function due_report() {

        $post_data = $this->input->post();
        //pr($post_data);
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $alldata = null;
        $supplier = $this->db->query("SELECT * FROM suppliers")->result_array();
        // pr($supplier_names,1);

        $sql = "select  suppliers.supplier_name,suppliers.supplier_id,sum(purchase_total) as purchase_total from purchases join suppliers on suppliers.supplier_id = purchases.purchase_supplier where 1 = 1";

        if (!empty($start)) {
            $sql .= " AND purchase_date >='" . $start . "'";
        }
        if (!empty($end)) {
            $sql .= " AND purchase_date<='" . $end . "'";
        }

        $sql .= " GROUP BY suppliers.supplier_name";

        $purchase = $this->db->query($sql)->result_array();
        // pr($purchase,1);

        foreach ($purchase as $key => $var) {
            $alldata[$var['supplier_id']] = $var;
        }

        $sql = "SELECT  suppliers.supplier_name,suppliers.supplier_id,sum(payment_paid_amount) as payment_paid_amount from payments join suppliers on suppliers.supplier_id = payments.payment_suppliers where 1 = 1 ";

        if (!empty($start)) {
            $sql .= " AND payment_date >='" . $start . "'";
        }
        if (!empty($end)) {
            $sql .= " AND payment_date<='" . $end . "'";
        }

        $sql .= "GROUP BY suppliers.supplier_name";
        // pr($sql);
        $payment = $this->db->query($sql)->result_array();
        // pr($payment);
        foreach ($payment as $key => $val) {
            $alldata[$val['supplier_id']] = array_merge(  $alldata[$val['supplier_id']],$val);
        }
       // pr($alldata, 1);

       
        if ($this->input->post()) {
            // pr($alldata, 1);   
            $this->load->view('console/payment/due_ajax_report_tpl', array('alldata' => $alldata,  'start' => $start, 'end' => $end, ));
        } else {
            $this->load->view('console/payment/due_report_tpl', array('alldata' => $alldata, 'start' => $start, 'end' => $end, ));
        }
    }

}

?>