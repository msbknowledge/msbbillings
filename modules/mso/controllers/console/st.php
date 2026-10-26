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
class Invoice extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'invoice_status';
        $this->targetModel = 'invoices_model';
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'invoice_lco,invoice_period';

        $this->page_config['use_dropdown_columns_options']['invoice_lco'] = $this->lcos_model->get_list_for_dropdown('NAME_OF_LCO');
        $this->page_config['use_dropdown_columns_options']['invoice_period'] = $this->invoice_period_generate();


        $this->page_config['tablePrimaryKey'] = $this->invoices_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Invoice'; //search title bar
        $this->page_config['searchFields'] = 'invoice_period,invoice_date'; //search box,
        $this->page_config['default_search_value']['invoice_period'] = date('F-y');
        $this->page_config['list_columns'] = 'invoice_date,invoice_paid_amount,invoice_period,invoice_billed_amount';
        /*         * end page_config* */
    }

    private function invoice_period_generate() {
        $month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $years = array('15', '16');
        $output_array = null;
        foreach ($years as $year) {
            foreach ($month_names as $month) {
                $output_array[$month . '-' . $year] = $month . '-' . $year;
            }
        }

        return $output_array;
    }

    public function index() {


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

    /**
     * add detail
     */
    public function add_detail() {
        $postedData = $this->input->post();
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config);
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

                echo translateIt(json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    /**
     * edit detail
     */
    public function edit_detail() {
        $postedData = $this->input->post();
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
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
                        $postedData[$multiChooser] = @is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                    }
                }

                $this->{$this->targetModel}->update_data($postedData, array($this->page_config['tablePrimaryKey'] => $postedData[$this->page_config['tablePrimaryKey']]));
                echo translateIt(json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

    public function fastbill() {
        if($this->input->post()){
            pr($this->input->post(),1);
        }
        $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
        $this->load->view('console/invoice/invoice_format', array('invoice_periods'=>$invoice_periods));
    }
    public function credit_note() {
        if($this->input->post()){
            pr($this->input->post(),1);
        }
        $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
        $this->load->view('console/invoice/creditnote_format', array('invoice_periods'=>$invoice_periods));
    }

}

?>
