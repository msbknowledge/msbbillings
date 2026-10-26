<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author Kallol
 */
class Internet_invoice extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->moduleMeta = array('internet' => 'internet_invoice');
        $this->targetModel = 'internet_invoices_model';
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'invoice_customer,customer_agent';
        $this->page_config['use_dropdown_columns_options']['invoice_customer'] = $this->customer_list();
        if($this->current_user_session['user_type_super']==1)
        $this->allowed_action = array('delete','view_detail');
       

        $this->page_config['tablePrimaryKey'] = $this->internet_invoices_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Invoice Bills'; //search title bar
        $this->page_config['searchFields'] = 'invoice_ID,invoice_note,'
                . 'customer_package,'
                . 'invoice_for,'
                . 'invoice_date,'
                . 'customer_address,'
                . 'customer_code,'
                . 'customer_name,'
                . 'customer_area'; //search box,
        //$this->page_config['default_search_value']['invoice_for'] = date('-');
        $this->page_config['list_columns'] = 'invoice_note,customer_code,customer_name,invoice_date,invoice_for,invoice_billed_amount';
        /*         * end page_config* */
    }
    
    public function customer_list() {
        $data = $this->internet_customers_model->get_list_for_dropdown();
        $returndata = null;
        foreach ($data as $key => $value) {
            if ($value['customer_is_free'] == 1 || $value['customer_status'] != 1)
                continue;
            $returndata[$key] = $value['customer_name'] . '(' . $value['customer_code'] . ')';
        }
        return $returndata;
    }

 public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
       // pr($allData,1);
       //$data['generateTableView'] = $this->generate_table_view($allData, $this->page_config);
               $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'internet_customer/table_tpl');

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
    public function view_detail() {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $entryID = trim($this->input->post('entry'));
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        unset($entryData['invoice_meta']); //suggestion: giving a print button
        echo $this->generate_detail_view($entryData, $this->page_config);
    }
 public function print_bill() {
       $postedData = $this->input->post();
  //pr($postedData,1);
    $data= $postedData['selectedItem'];
    //pr($data,1);
       //$data=array(566,568);
        $string= implode(',', $data);
       $output=$this->db->query("select * from internet_invoices where invoice_ID in ($string)")->result_array();
       //pr($data,1); 
       foreach ($output as $key =>$value){
        $invoice_data = $this->internet_invoices_model->get_list(array('invoice_date' => $value['invoice_date'], 'invoice_customer' =>$value['invoice_customer'] ));
        $data = $this->internet_customers_model->account_statement($value['invoice_customer'], $value['invoice_date']);
        $this->load->view('console/internet_customer/print_template_invoice_tpl', array('invoice' => $value, 'data' => $data, 'date' => $value['invoice_date']));
       }
    }

  
}

?>
