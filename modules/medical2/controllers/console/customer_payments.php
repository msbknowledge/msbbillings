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
class Customer_payments extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'customer_payment_model';
        $this->moduleMeta = array('medical' => 'Customer_payment');
        $this->page_config['tablePrimaryKey'] = $this->customer_payment_model->get_primary_key(); //pk
        /*         * page_config* */

        $this->page_config['title'] = 'Customer_payment'; //search title bar
        $this->page_config['searchFields'] = 'customer_name,customer_payment_date'; //search box,
        $this->page_config['list_columns'] = 'customer_name,customer_payment_date,customer_payment_paid_amount,customer_payment_note';
        $this->page_config['use_dropdown_columns'] = 'customer_payment_customer';
        $this->page_config['use_dropdown_columns_options']['customer_payment_customer'] = $this->customers_model->get_list_for_dropdown('customer_name');
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

    public function add_payment_customer() {
        $this->load->model('sales_model');
        $postedData = $this->input->post('customer_ID');
        $pre_payment_invoice = $this->input->post('pre_payment_invoice');
        //pr($this->input->post());
        if (!empty($postedData)) {
            $alldata = $this->db->query("select customer_payment_invoice from customer_payments where customer_payment_customer	=$postedData")->result_array();
            // pr($alldata);
            $pre_payment_invoice = "";
            foreach ($alldata as $k => $v) {
                if (!empty($pre_payment_invoice) && (!empty($v['customer_payment_invoice']))) {

                    $pre_payment_invoice .= ',' . $v['customer_payment_invoice'];
                } else {

                    $pre_payment_invoice .= $v['customer_payment_invoice'];
                }
            }

            $sql = "
                select sum(sales.sale_total) as total,
                sales.sale_date,sales.sale_invoice,customers.customer_name,customers.customer_id 
                from sales  join customers on 
                sales.salee_customer=customers.customer_ID 
                WHERE customer_ID=$postedData ";
            if (!empty($pre_payment_invoice)) {
                $sql .= "AND  sales.sale_invoice NOT IN($pre_payment_invoice)";
            }
            $sql .= " group by customer_payment_invoice";
            $sql .= " ORDER BY customer_payment_date DESC ";
//pr($sql);
            $data = $this->db->query($sql)->result_array();

            $this->load->view('console/customer_payment/dropdown_list_tpl', array('data' => $data));
        }
    }

    public function add_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config, 'customer_payment/add_detail');
        } else {
            if ($postedData) {
                /** status* */
                $config = $this->auto_fieldtype_detect(NULL);
                if (isset($config['use_status_columns'])) {
                    foreach ($config['use_status_columns'] as $statusColumn) {
                        $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
                    }
                }
                /*                 * multi chooser */
                if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
                    foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
                        if (isset($postedData[$multiChooser]))
                            $postedData[$multiChooser] = is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                        else
                            $postedData[$multiChooser] = '["0"]';
                    }
                }
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);

                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    public function edit_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config, 'customer_payment/add_detail');
        } else {
            if ($postedData) {
                /** status* */
                if (isset($config['use_status_columns'])) {
                    foreach ($config['use_status_columns'] as $statusColumn) {
                        $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
                    }
                }
                /*                 * multi chooser */
                if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
                    foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
                        $postedData[$multiChooser] = @is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                    }
                }

                $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
                echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

    /**
     * view detail
     */
    public function view_detail() {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $entryID = trim($this->input->post('entry'));
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        echo $this->generate_detail_view($entryData, $this->page_config);
    }

    public function due_report() {

        $post_data = $this->input->post();
        //pr($post_data);
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $alldata = null;
        $customer = $this->db->query("SELECT * FROM customers")->result_array();
        // pr($customer_names,1);

        $sql = "select customers.customer_name,customers.customer_ID,sum(sale_total) as sale_total from sales join customers on customers.customer_ID = sales.sale_customer where 1 = 1";

        if (!empty($start)) {
            $sql .= " AND sale_date >='" . $start . "'";
        }
        if (!empty($end)) {
            $sql .= " AND sale_date<='" . $end . "'";
        }

        $sql .= " GROUP BY customers.customer_name";

        $sale = $this->db->query($sql)->result_array();
        // pr($sale,1);

        foreach ($sale as $key => $var) {
            $alldata[$var['customer_ID']] = $var;
        }

        $sql = "SELECT  customers.customer_name,customers.customer_ID,sum(customer_payment_paid_amount) as customer_payment_paid_amount from customer_payments join customers on customers.customer_id = customer_payments.customer_payment_customer where 1 = 1 ";

        if (!empty($start)) {
            $sql .= " AND customer_payment_date >='" . $start . "'";
        }
        if (!empty($end)) {
            $sql .= " AND customer_payment_date<='" . $end . "'";
        }

        $sql .= "GROUP BY customers.customer_name";
        // pr($sql);
        $payment = $this->db->query($sql)->result_array();
        // pr($payment);
        foreach ($payment as $key => $val) {
            $alldata[$val['customer_ID']] = array_merge(  $alldata[$val['customer_ID']],$val);
        }
       // pr($alldata, 1);

       
        if ($this->input->post()) {
            // pr($alldata, 1);   
            $this->load->view('console/customer_payment/due_ajax_report_tpl', array('alldata' => $alldata,  'start' => $start, 'end' => $end, ));
        } else {
            $this->load->view('console/customer_payment/due_report_tpl', array('alldata' => $alldata, 'start' => $start, 'end' => $end, ));
        }
    }

}

?>