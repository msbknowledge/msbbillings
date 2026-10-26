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

    public $publicAccess = array('viewMailInvoice');

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->library('encrypt');
        //$this->page_config['use_status_columns'] = 'invoice_status';
        $this->targetModel = 'invoices_model';
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'invoice_lco,invoice_period';

        $this->page_config['use_dropdown_columns_options']['invoice_lco'] = $this->lcos_model->get_list_for_dropdown('NAME_OF_LCO');
        $this->page_config['use_dropdown_columns_options']['invoice_period'] = $this->invoice_period_generate();


        $this->page_config['tablePrimaryKey'] = $this->invoices_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Invoice'; //search title bar
        $this->page_config['searchFields'] = 'invoice_period,invoice_date,NAME_OF_LCO'; //search box,
        $this->page_config['default_search_value']['invoice_period'] = date('F-y');
        $this->page_config['list_columns'] = 'invoice_date,NAME_OF_LCO,invoice_period,invoice_billed_amount';
        /*         * end page_config* */
    }

    private function invoice_period_generate() {
        $month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $years = array('17', '16', '15');
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
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'invoice/table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {

            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }

        $posted_datas = ($this->input->post());
        //pr($posted_datas);
        $var = $posted_datas['invoice_date'];
        $date = str_replace('/', '-', $var);
        $db_table_data = array(
            'invoice_customer' => $this->input->post('lco_id'),
            'invoice_date' => date('Y-m-d', strtotime($date)),
            'invoice_period' => $this->input->post('inoice_period'),
            'invoice_billed_amount' => $this->input->post('amount_payable'),
            'invoice_meta' => json_encode($posted_datas)
        );
        //pr($posted_datas['invoice_ID']);
        //pr($db_table_data);
        if ($db_table_data['invoice_period' == null]) {
            echo "No Data";
        }
        $this->db->where('invoice_ID', $posted_datas['invoice_ID']);
        $this->db->update('invoices', $db_table_data);
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
            $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
            $data['details'] = $entryData;
            $data['invoice_periods'] = $invoice_periods;

            //echo $this->generate_form_view($entryData, $this->page_config, 'invoice/invoice_format_edit.php');

            $invoicePeriod = explode('-', $entryData['invoice_period']);
            if (intval($invoicePeriod[1]) < 17){
                $this->load->view('console/invoice/invoice_format_edit.php', $data);
            } else {
              
                $this->load->view('console/invoice/invoice_format_edit_new.php', $data);
            }


        } else {
            if ($postedData) {
                pr($postedData);
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
        if ($this->input->post()) {
            //pr($this->input->post('invoice_date'));
            $posted_data = ($this->input->post());
            pr($posted_data);
            //pr($posted_data['invoice_date']);
            //json_encode ($posted_data);
            $var = $posted_data['invoice_date'];
            $date = str_replace('/', '-', $var);
            $db_table_data = array(
                'invoice_customer' => $this->input->post('lco_id'),
                'invoice_date' => date('Y-m-d', strtotime($date)),
                'invoice_period' => $this->input->post('inoice_period'),
                'invoice_billed_amount' => $this->input->post('amount_payable'),
                'invoice_meta' => json_encode($posted_data)
            );
            $this->db->insert('invoices', $db_table_data);
            //pr($db_table_data);
        }
        $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
        $this->load->view('console/invoice/invoice_format', array('invoice_periods' => $invoice_periods));
    }

    public function fastbill_bbbc() {
        if ($this->input->post()) {
            //pr($this->input->post('invoice_date'));
            $posted_data = ($this->input->post());
            pr($posted_data);
            //pr($posted_data['invoice_date']);
            //json_encode ($posted_data);
            $var = $posted_data['invoice_date'];
            $date = str_replace('/', '-', $var);
            $db_table_data = array(
                'invoice_customer' => $this->input->post('lco_id'),
                'invoice_date' => date('Y-m-d', strtotime($date)),
                'invoice_period' => $this->input->post('inoice_period'),
                'invoice_billed_amount' => $this->input->post('amount_payable'),
                'invoice_meta' => json_encode($posted_data)
            );
            $this->db->insert('invoices', $db_table_data);
            //pr($db_table_data);
        }
        $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
        $this->load->view('console/invoice/invoice_format_bbbc', array('invoice_periods' => $invoice_periods));
    }

    public function fastbill_bbbc_new() {
        if ($this->input->post()) {
            //pr($this->input->post('invoice_date'));
            $posted_data = ($this->input->post());
            //pr($posted_data);
            //pr($posted_data['invoice_date']);
            //json_encode ($posted_data);
            $var = $posted_data['invoice_date'];
            $date = str_replace('/', '-', $var);
            $db_table_data = array(
                'invoice_customer' => $this->input->post('lco_id'),
                'invoice_date' => date('Y-m-d', strtotime($date)),
                'invoice_period' => $this->input->post('inoice_period'),
                'invoice_billed_amount' => $this->input->post('amount_payable'),
                'invoice_meta' => json_encode($posted_data)
            );
            /*****/
            $this->db->query("update options set option_value=lpad((option_value+1),3,'0') where option_key='billing_sqn'");
            /******/
            $this->db->insert('invoices', $db_table_data);
            //pr($db_table_data);
        }
        $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
        $this->load->view('console/invoice/invoice_format_bbbc_new', array('invoice_periods' => $invoice_periods));
    }

    public function credit_note() {
        if ($this->input->post()) {
            echo "saving facility is not implemented!";
            //die();
            pr($this->input->post(), 1);
        }
        $invoice_periods = $this->page_config['use_dropdown_columns_options']['invoice_period'];
        $this->load->view('console/invoice/creditnote_format', array('invoice_periods' => $invoice_periods));
    }

    public function view_detail() {

        $entryID = trim($this->input->post('entry'));
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        $data['details'] = $entryData;
        //pr($entryData);
        //echo $this->generate_detail_view($entryData, $this->page_config, 'invoice/invoice_format_readonly.php');
        $this->load->view('console/invoice/invoice_format_readonly.php', $data);
    }

    public function print_detail() {

        $entryID = trim($this->input->post('entry'));
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        $data['details'] = $entryData;
        //pr($entryData);
        //echo $this->generate_detail_view($entryData, $this->page_config, 'invoice/invoice_format_readonly.php');
        $this->load->view('console/invoice/invoice_format_readonly.php', $data);
    }

    public function print_invoice() {
        $invoices = $this->input->post('selectedItem');

        if ($invoices != NULL)
            foreach ($invoices as $key => $invoice) {
                $this->generate_invoice_print($invoice);
            }
    }

    private function generate_invoice_print($invoice = null) {

        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $invoice));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        $data['details'] = $entryData;
        #pr($data);
        $invoicePeriod = explode('-', $entryData['invoice_period']);
        if (intval($invoicePeriod[1]) < 17)
            $this->load->view('console/invoice/invoice_old_format_readonly.php', $data);
        else
            $this->load->view('console/invoice/invoice_format_readonly.php', $data);
    }

    public function prepare() {
        $lco_ids = null;
        $entryDatas = $this->{$this->targetModel}->get_list();

        krsort($entryDatas);
        $dataFull = null;
        foreach ($entryDatas as $entryData) {
            $meta = null;
            $meta = json_decode($entryData['invoice_meta'], true);
            //pr($meta);
            $meta['name_of_lco'] = $entryData['NAME_OF_LCO'];
            $meta['address'] = $entryData['ADDRESS'];
            $meta['contact_person'] = $entryData['CONTACT_PERSON'];
            $meta['lco_id'] = $entryData['ID'];
            $meta['code'] = $entryData['CODE'];
            $meta['invoice_date'] = date('d/m/Y', strtotime($entryData['invoice_date']));
            $meta['inoice_period'] = $entryData['invoice_period'];

            if (isset($meta['bill_no'])) {
                $c = explode('/', $meta['bill_no']);
                $lco_id[$meta['lco_id']] = $c[3];
            }
            $meta['bill_no'] = "BB/" . date('m', strtotime($entryData['invoice_date'])) . "/" . date('y', strtotime($entryData['invoice_date'])) . "/" . $lco_id[$meta['lco_id']];
            //pr($meta['bill_no']);
            /* 	$meta['bill_no'] => BB/01/16/013
              $meta['stb'] => 2592
              $meta['rate'] => 110.00
              $meta['total_stb_costing'] => 285120.00
              $meta['previous_due'] => 252550.00
              $meta['total_amount'] => 537670.00
              $meta['roundoff'] => 537670.00
              $meta['amount_payable'] => 537670.00
              $meta['num_to_word'] =>  FIVE LAKH THIRTY SEVEN THOUSAND SIX HUNDRED SEVENTY ONLY */
            $entryData['invoice_meta'] = json_encode($meta);
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryDataFinal = array_intersect_key($entryData, $entryData1[0]);
            pr($entryDataFinal);
            $this->{$this->targetModel}->update_data($entryDataFinal, array($this->page_config['tablePrimaryKey'] => $entryDataFinal[$this->page_config['tablePrimaryKey']]));
        }
    }

    public function mailInvoice() {
        $base_url=base_url();
        $invoice_id = $this->input->post('invoice_id');
        $entryDatas = $this->{$this->targetModel}->get_list(array('invoice_ID' => $invoice_id));

        //pr($entryDatas,1);

        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('webmaster@cablesoft.ml', 'Bengal BroadBand');
        $this->email->to($entryDatas[0]['EMAIL']);

        $this->email->subject('Email Invoice');
        $this->email->message('Dear Subscriber, please find your invoice <a href="'.$base_url.'console/invoice/viewMailInvoice/?invoice='.$this->encrypt->encode($invoice_id) .'">here</b> ');

        if ($this->email->send()) {
            echo json_encode(array('status' => 'Success'));
        } else {
            echo json_encode(array('status' => 'Failed'));
        }

        //echo $this->email->print_debugger();
    }

    public function viewMailInvoice() {
        //echo 'down for maintainence';
        //return false;
        $invoice_id = $this->encrypt->decode(str_ireplace(' ', '+', $this->input->get('invoice')));
        //pr($invoice_id);
        $this->generate_invoice_print($invoice_id);
    }

}

?>
