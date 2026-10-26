<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author Kallol
 */
class Customer extends MY_Controller {

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'customer_status';
        $this->targetModel = 'customers_model';
        $this->moduleMeta = array('cables' => 'Customer');
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'customer_package,customer_stb,,customer_adons,customer_assigned_to,customer_due_date_of_month,customer_status';
        $this->page_config['use_dropdown_columns_options']['multi']['customer_package'] = 'multiple';
        $this->page_config['use_dropdown_columns_options']['customer_package'] = $this->packages_model->get_list_for_dropdown('package_name');
        $this->page_config['use_dropdown_columns_options']['customer_stb'] = $this->stb();
        $this->page_config['use_dropdown_columns_options']['customer_status'] = array(0 => 'Off', 1 => 'On');
        $this->page_config['use_dropdown_columns_options']['customer_assigned_to'] = $this->users_model->get_list_for_dropdown('user_login');
        $this->page_config['use_dropdown_columns_options']['multi']['customer_adons'] = 'multiple';
        $this->page_config['use_dropdown_columns_options']['customer_adons'] = $this->channels_model->get_list_for_dropdown('channel_name');

        $due_data = array();
        for ($due = 1; $due <= 31; $due++) {
            $due_data[] = $due;
        }
        $this->page_config['use_dropdown_columns_options']['customer_due_date_of_month'] = $due_data;

        $this->allowed_action = array_merge($this->allowed_action, array('billing', 'extra_bill', 'print_statement'));
        $this->load->helper(array('dompdf', 'file', 'csv'));
        $this->page_config['tablePrimaryKey'] = $this->customers_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Customer'; //search title bar
        $this->page_config['searchFields'] = 'stb_no,stb_vc,customer_assigned_to,customer_name,customer_package,customer_code,customer_address,customer_area,customer_mso_account,customer_status'; //search box,
        $this->page_config['list_columns'] = 'due,customer_last_renew_date,customer_status,customer_stb,customer_name,customer_contact,customer_email,customer_code,customer_package,customer_adons,customer_area,customer_mso_account';
        /*         * end page_config* */
    }

    public function widget() {

        // page info here, db calls, etc.
        $data = null;
        //$html = $this->load->view('console/customer/pdf_tpl', $data, true);
        $html = file_get_contents('http://prerelease.website/invoice_template/');
        pdf_create($html, 'filename');
        // or
        // $data = pdf_create($html, '', false);
        // write_file('name', $data);
    }

    public function customer_search_by_name() {
        $results = $this->customers_model->get_list_for_dropdown(null, array('customer_status' => 1), null, 10, null, array('customer_name' => $this->input->get('term')));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['customer_ID'];
            $output[$key]['label'] = $result['customer_name'] . '(' . $result['customer_code'] . ')';
            $output[$key]['value'] = $result['customer_name'];
            $invoice_generated = generate_invoice($result['customer_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }
        echo json_encode($output);
    }

    public function customer_search_by_code() {
        $results = $this->customers_model->get_list_for_dropdown(null, array('customer_status' => 1), null, 10, null, array('customer_code' => $this->input->get('term')));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['customer_id'];
            $output[$key]['label'] = $result['customer_code'] . '(' . $result['customer_name'] . ')';
            $output[$key]['value'] = $result['customer_code'];
            if (!empty($this->input->get('invoice_date')))
                $invoice_generated = generate_invoice($result['customer_ID'], ($this->input->get('invoice_date')));
            else
                $invoice_generated = generate_invoice($result['customer_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }

        echo json_encode($output);
    }

    public function customer_search_by_id() {
        $results = $this->customers_model->get_list_for_dropdown(null, array('customer_ID' => $this->input->get('term'), 'customer_status' => 1), null, 10, null);
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['customer_id'];
            $output[$key]['label'] = $result['customer_code'] . '(' . $result['customer_name'] . ')';
            $output[$key]['value'] = $result['customer_code'];
            if (!empty($this->input->get('invoice_date')))
                $invoice_generated = generate_invoice($result['customer_ID'], ($this->input->get('invoice_date')));
            else
                $invoice_generated = generate_invoice($result['customer_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }

        echo json_encode($output);
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
        $paging = $this->uri->segment(4) ? $this->uri->segment(4) : 0;

        /* if (!empty($likeCondition['customer_code'])) {
          $condition['customer_code'] = $likeCondition['customer_code'];
          unset($likeCondition['customer_code']);
          }
          if (empty($likeCondition['stb_no'])) {
          unset($likeCondition['stb_no']);
          }
          if (empty($likeCondition['stb_vc'])) {
          unset($likeCondition['stb_vc']);
          } */

        //$this->current_site_settings['site_setting_record_per_page']
        //$allData = $this->{$this->targetModel}->get_list_for_tables($condition, FALSE, 100000000, NULL, $likeCondition);
        $likeConditionsSql = " where 1 = 1 ";
        foreach ($likeCondition as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $likeConditionsSql .= " and $key like '%$value%'";
        }
        //pr($lcq);
        $limit = $this->current_site_settings['site_setting_record_per_page'];
        $offset = $paging;
        /* $sql="select 
          customers.*,
          totalInvoice.total_invoice - totalCollections.total_collected as due
          from customers
          right JOIN
          (
          select invoices.invoice_customer, sum(invoices.invoice_billed_amount) as total_invoice from invoices group by invoices.invoice_customer) as totalInvoice ON totalInvoice.invoice_customer = customers.customer_ID
          JOIN ( select sum(collection_amount) as total_collected,collection_customer from collections group by collection_customer) as totalCollections ON totalCollections.collection_customer = customers.customer_ID
          left join stbs on customer_stb= stb_ID
          $likeConditionsSql
          $orderBy
          limit $offset,$limit"; */
        // pr($sql);
        $sql = "SELECT customers.*,  total_billed - total_collected as due FROM customers "
                . "LEFT JOIN "
                . "(select * from "
                . "(select sum(collection_amount) as total_collected,collection_customer from collections group by collection_customer) as totalCollections "
                . "join "
                . "(select sum(invoices.invoice_billed_amount) as total_billed,invoice_customer from invoices group by invoice_customer) as totalInvoices "
                . "ON totalCollections.collection_customer = totalInvoices.invoice_customer) as fullCustomer "
                . "on customer_ID = invoice_customer  "
                . " $likeConditionsSql "
                . " $orderBy "
                . " limit $offset,$limit";

        /* $countsql="select 
          count(*) as totalrw
          from customers
          right JOIN ( select invoices.invoice_customer, sum(invoices.invoice_billed_amount) as total_invoice from invoices group by invoices.invoice_customer) as totalInvoice ON totalInvoice.invoice_customer = customers.customer_ID JOIN ( select sum(collection_amount) as total_collected,collection_customer from collections group by collection_customer) as totalCollections ON totalCollections.collection_customer = customers.customer_ID
          left join stbs on customer_stb= stb_ID
          $likeConditionsSql";
         */
        $countsql = "SELECT count(*) as totalrw FROM customers "
                . "LEFT JOIN "
                . "(select * from "
                . "(select sum(collection_amount) as total_collected,collection_customer from collections group by collection_customer) as totalCollections "
                . "join "
                . "(select sum(invoices.invoice_billed_amount) as total_billed,invoice_customer from invoices group by invoice_customer) as totalInvoices "
                . "ON totalCollections.collection_customer = totalInvoices.invoice_customer) as fullCustomer "
                . "on customer_ID = invoice_customer  "
                . " $likeConditionsSql ";
        $allData['current_paged_list'] = $this->db->query($sql)->result_array();
        $totalrw = $this->db->query($countsql)->result_array();
        $allData['total_rows'] = $totalrw[0]['totalrw'];
        //pr($allData['total_rows']);
        /* foreach ($allData['current_paged_list'] as $key => $data) {

          $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_customer from invoices where invoice_customer = ".$data['customer_ID']." group by invoice_customer")->result_array();
          $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_customer from collections where collection_customer= ".$data['customer_ID']." group by collection_customer")->result_array();

          $totalInvoice = $invoices[0]['total_invoice'];
          $totalCollection = $collections[0]['total_collected'];
          $due = $totalInvoice-$totalCollection;
          $dataToProcess[$key] = array_merge($data,array('due'=>$due));
          }

          $this->array_sort_by_column($dataToProcess, $orderBy[0],$orderBy[1]);
          $dataToProcess=array_chunk($dataToProcess,$this->current_site_settings['site_setting_record_per_page']);
          $allData['current_paged_list']  = $current_paged_list;
         */
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function customer_wise_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_area = $this->input->post('customer_area');
        $customer_address = $this->input->post('customer_address');
        $package_name = $this->input->post('package_name');
        $invoice_for = $this->input->post('invoice_for');
        $customer_name = $this->input->post('customer_name');
        $customer_code = $this->input->post('customer_code');

        $package = $this->packages_model->get_list();

        if (!empty($post_data)) {
            $sql = "SELECT * FROM  `customers`  WHERE 1 = 1 ";

            if (!empty($customer_area)) {
                $sql .= "AND customer_area like '%" . $customer_area . "%'";
            }
            if (!empty($customer_address)) {
                $sql .= "AND customer_address like '%" . $customer_address . "%'";
            }
            if (!empty($customer_name)) {
                $sql .= "AND customer_name like '%" . $customer_name . "%'";
            }
            if (!empty($customer_code)) {
                $sql .= "AND customer_code= '" . $customer_code . "'";
            }
            $customers = $this->db->query($sql)->result_array();
            $customer_data = null;
            foreach ($customers as $key => $customer) {
                $output = null;
                $output = $this->with_due_calculation($customer['customer_ID']);
                $customer_data[] = $output[0];
            }
            
        }
        if ($this->input->post()) {
            $this->load->view('console/customer/customer_wise_ajax_billing', array('customer_data' => $customer_data));
        } else {
            $this->load->view('console/customer/customer_wise_billing_report_tpl', array(
                'package' => $package));
        }
    }

    public function inactive_customer() {
        $condition = array('customer_status' => 0);
        $allData = $this->{$this->targetModel}->get_list($condition, FALSE, 200000, NULL);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function all_customer() {
        $allData = $this->{$this->targetModel}->get_list(null, FALSE, 200000, NULL);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function active_customer() {
        $condition = array('customer_status' => 1);
        $allData = $this->{$this->targetModel}->get_list($condition, FALSE, 200000, NULL);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function package_customer() {
        $customer_package = null;
        $packages = $this->packages_model->get_list_for_dropdown('package_name');

        if ($this->input->get('package') != 'Unset') {
            $packagename = $this->input->get('package');

            $targetpackage = $this->packages_model->get_list(array('package_ID' => $packagename));

            $condition = array('customer_status' => 1, 'customer_package' => '["' . $targetpackage[0]['package_ID'] . '"]');
            $allData = $this->{$this->targetModel}->get_list($condition, FALSE, 200000, NULL);
        } else {
            $packagelist = '';
            $condition = array('customer_status' => 1, 'customer_package' => '');
            foreach ($packages as $package_ID => $pack) {
                $packagelist[] = "'[\"$package_ID\"]'";
            }
            $packagelist = implode(',', $packagelist);

            $sql = $this->db->query('select * from customers where customer_package not in(' . $packagelist . ')');
            $allData = $sql->result_array();
        }
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function live_portal_compare() {
        $fields = $this->{$this->targetModel}->get_field_list();
        $filter = null;
        foreach ($fields[0] as $key => $value) {
            $filter[$key] = str_ireplace('_', ' ', strtoupper($key));
        }

        if (isset($_FILES['userfile'])) {
            $errors = array();

            $file_name = $_FILES['userfile']['name'];
            $file_tmp = $_FILES['userfile']['tmp_name'];
            $file_ext = strtolower(end(explode('.', $_FILES['userfile']['name'])));
            $expensions = array("csv");
            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a csv file.";
            }
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, ROOTPATH . 'uploads/' . NODE . '/' . $file_name);
                if ($this->input->post('mso') == 'mn') {
                    $output = $this->media_neuclious($file_name);
                }
            }
        }
        $output['filter'] = $filter;

        $this->render($output, 'console/customer/live_portal_compare_tpl');
    }

    public function box_compare() {

        $fields = $this->{$this->targetModel}->get_field_list();
        $filter = null;
        foreach ($fields[0] as $key => $value) {
            $filter[$key] = str_ireplace('_', ' ', strtoupper($key));
        }

        if (isset($_FILES['userfile'])) {
            $errors = array();

            $file_name = $_FILES['userfile']['name'];
            $file_tmp = $_FILES['userfile']['tmp_name'];
            $file_ext = strtolower(end(explode('.', $_FILES['userfile']['name'])));
            $expensions = array("xlsx", "xls");
            if (in_array($file_ext, $expensions) === false) {
                $output['error'] = "extension not allowed, please choose a xlsx file.";
            }
            if (empty($output['error']) == true) {
                //move_uploaded_file($_FILES, ROOTPATH . 'uploads/daump/' . $file_name);
                $thefunction = $this->input->post('filter') . '_box_compare_data';

                if (method_exists('Customer', $thefunction))
                    $output = $this->{$thefunction}();
                else
                    $output['error'] = " MSO " . $this->input->post('filter') . " is not active in your account. please contact to support";
            }
        }
        $output['filter'] = $filter;

        $this->render($output, 'console/customer/box_compare_tpl');
    }

    public function customer_import() {
        $this->load->library('excel');

        if (isset($_FILES['userfile'])) {
            $errors = array();

            $file_name = $_FILES['userfile']['name'];
            $file_tmp = $_FILES['userfile']['tmp_name'];
            $file_ext = strtolower(end(explode('.', $_FILES['userfile']['name'])));
            $expension = array("xls", "xlsx");
            if (in_array($file_ext, $expension) === false) {
                $errors[] = "extension not allowed, please choose a csv file.";
            }
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, ROOTPATH . 'uploads/excel/' . $file_name);
                $data = file_get_content($file_name);
                // pr($data);
                /*                 * ***************** */
            }


//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
            $objReader = PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007 	  
            //Set to read only
            $objReader->setReadDataOnly(true);
            //Load excel file
            $objPHPExcel = $objReader->load(FCPATH . 'uploads/excel/' . $file_name);
            $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            //loop from first data untill last data
            for ($i = 2; $i <= $totalrows; $i++) {
                $FirstName = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
                $LastName = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue(); //Excel Column 1
                $Email = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue(); //Excel Column 2
                $Mobile = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue(); //Excel Column 3
                $Address = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue(); //Excel Column 4
                $data_user = array('FirstName' => $FirstName, 'LastName' => $LastName, 'Email' => $Email, 'Mobile' => $Mobile, 'Address' => $Address);
                //$this->excel_data_insert_model->Add_User($data_user);

                pr($data_user);
            }
            /*  unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
              redirect(base_url() . "put link were you want to redirect"); */
        }
        $data = array();
        $this->render($data, 'console/customer/customer_import_tpl');
    }

    private function media_neuclious($file_name) {

        $file = fopen(ROOTPATH . 'uploads/' . NODE . '/' . $file_name, "r");
        $csvData = null;
        $csvSTB = array();
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            //      $csvData[]= $emapData;
            if (empty($emapData[2]) && empty($emapData[3]) && empty($emapData[4]))
                continue;
            if (strtoupper($emapData[2]) == 'SUBSCRIBERNAME')
                continue;
            $csvCustomerData['customer_code'] = strtoupper($emapData[1]);
            $csvCustomerData['customer_name'] = strtoupper(str_ireplace("  ", " ", $emapData[2]));
            $csvCustomerData['customer_contact'] = $emapData[3];
            $csvCustomerData['stb_no'] = strtoupper(str_ireplace("'", "", $emapData[4]));
            $csvCustomerData['vc_no'] = strtoupper(str_ireplace("'", "", $emapData[5]));
            $csvCustomerData['customer_package'] = $emapData[6];
            $csvCustomerData['customer_address'] = $emapData[7];
            $csvCustomerData['customer_activation_date'] = date('Y-m-d', strtotime($emapData[8]));
            //  $csvSTB[] = strtolower(str_ireplace("'","",$emapData[5]));
            $csvData[] = $csvCustomerData;
        }
        $liniercsvData = null;
        foreach ($csvData as $csvCustomerData) {
            $linierData[] = $csvCustomerData[$this->input->post('filter')];
        }

        fclose($file);


        $query = "SELECT * from customers where customer_status	 = 1  ";
        $rs = $this->db->query($query);
        $consoleCustomerData = $rs->result_array();

        $linierconsoleData = null;
        foreach ($consoleCustomerData as $consoleCustomer) {
            $linierconsoleData[] = strtoupper(trim($consoleCustomer[$this->input->post('filter')]));
        }
        //pr($linierData,1);
        $customers_not_in_portal = array_diff($linierData, $linierconsoleData);
        $customers_not_in_csv = array_diff($linierconsoleData, $linierData);

        //pr($customers_not_in_portal);
        //pr($customers_not_in_csv,1);

        return array('notincsv' => $customers_not_in_csv, 'notinconsole' => $customers_not_in_portal, 'choosenfilter' => $this->input->post('filter'));
    }

    private function manthan_box_compare_data() {


        $uploadedData = excelToArray($_FILES['userfile']['tmp_name']);

        foreach ($uploadedData as $key => $val):
            $uploadedSTB[$val['FIRST_NAME']] = strtoupper(str_ireplace("'", "", $val['STB']));
        endforeach;
        #pr($uploadedSTB,1);
        $query = "SELECT * from customers where customer_status	 = 1  ";
        $rs = $this->db->query($query);
        $consoleCustomerData = $rs->result_array();

        foreach ($consoleCustomerData as $key => $val):
            $consoleSTB[$val['first_name']] = $val['stb_no'];
        endforeach;

        $extraSTB = array_diff($uploadedSTB, $consoleSTB);

        $customers_not_in_portal = array_diff($extraSTB, $consoleSTB);
        $customers_not_in_sheet = array_diff($extraSTB, $uploadedSTB);
        /* echo 'customers_not_in_portal:<br>';
          pr($customers_not_in_portal);
          echo 'customers_not_in_sheet:<br>';
          pr( $customers_not_in_sheet);
          #die('endpoint');
         * 
         */


        return array('notincsv' => $customers_not_in_sheet, 'notinconsole' => $customers_not_in_portal);
    }

    /**
     * add detail
     */
    public function add_detail() {
        $this->page_config['use_dropdown_columns_options']['customer_stb'] = $this->stb('SPARE');

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
                $this->change_stb_status(null, $postedData['customer_stb']);
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);
                if (function_exists('trigger_sms')) {
                    trigger_sms('welcome_cable', $postedData);
                }
                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    /**
     * edit detail
     */
    public function edit_detail() {

        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {

            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $this->page_config['use_dropdown_columns_options']['customer_stb'] = $this->stb('SPARE') + array($entryData2[0]['customer_stb'] => $entryData2[0]['stb_no'] . '(' . $entryData2[0]['stb_vc'] . ')');

            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
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
                $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData[$config['tablePrimaryKey']])));
                $this->change_stb_status($entryData2[0]['customer_stb'], $postedData['customer_stb']);
                $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
                echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

    /**
     * delete
     */
    public function delete() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['selectedItem'])) {
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['entry'])));
            $this->change_stb_status($entryData2[0]['customer_stb']);
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['entry']));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function change_stb_status($old, $new) {
        if (!empty($old))
            $this->db->query("UPDATE `stbs` SET `stb_type` = 'SPARE' WHERE `stbs`.`stb_ID` = $old;");
        if (!empty($new))
            $this->db->query("UPDATE `stbs` SET `stb_type` = 'ASSIGNED' WHERE `stbs`.`stb_ID` = $new;");
    }

    public function stb($type = null) {
        if (!empty($type)) {
            $data = $this->stbs_model->get_list(array('stb_type' => $type));
        } else {
            $data = $this->stbs_model->get_list();
        }
        $returndata = array();
        foreach ($data as $key => $value) {
            $returndata[$value['stb_ID']] = $value['stb_no'] . '(' . $value['stb_vc'] . ')';
        }
        return $returndata;
    }

    public function print_statement() {
        $customer = $this->customers_model->get_list(array('customer_ID' => $this->uri->segment(4)));
        $statement_for = $this->uri->segment(5);

        $data['customerData'] = $customer[0];
        if (!empty($statement_for)) {
            $data['invoices'] = $this->invoices_model->get_list(array('invoice_for' => $statement_for, 'invoice_customer' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_for' => $statement_for, 'collection_customer' => $this->uri->segment(4)));
        } else {
            $data['invoices'] = $this->invoices_model->get_list(array('invoice_customer' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_customer' => $this->uri->segment(4)));
        }
        $sheetData = null;
        foreach ($data['invoices'] as $value) {
            $sheetData[$value['invoice_for']][strtotime($value['invoice_date'])]['date'] = $value;
            ksort($sheetData[$value['invoice_for']]);
        }
        foreach ($data['collections'] as $value) {
            $sheetData[$value['collection_for']][strtotime($value['collection_entry_timestamp'])]['date'] = $value;
            ksort($sheetData[$value['collection_for']]);
        }
        $data['sheetData'] = $sheetData;
        $data['statement_for'] = $value['invoice_for'];
        //pr($this->customers_model->account_statement($customer,$invoice_date));

        $this->load->view('console/customer/print_template_tpl', $data);
    }

    public function print_due_statement() {
        $invoice_date = $this->uri->segment(5);
        $customer_id = $this->uri->segment(4);
        $data = $this->customers_model->account_statement($customer_id, $invoice_date);
        //  pr($data);
        $this->load->view('console/customer/print_template_due_tpl', array('data' => $data, 'date' => $invoice_date));
    }

    public function print_invoice_statement() {
        $invoice_date = $this->uri->segment(5);
        $customer_id = $this->uri->segment(4);
        $invoice_data = $this->invoices_model->get_list(array('invoice_date' => $invoice_date, 'invoice_customer' => $customer_id));
        // pr($invoice_data);
        // if (empty($invoice_data[0]))
        // redirect('/console/');
        $data = $this->customers_model->account_statement($invoice_data[0]['invoice_customer'], $invoice_data[0]['invoice_date']);
        //pr($data);
        $this->load->view('console/customer/print_template_invoice_tpl', array('invoice' => $invoice_data[0], 'data' => $data, 'date' => $invoice_data[0]['invoice_date']));
    }

    public function extra_bill($param) {
        pr('coming soon');
    }

    public function billing() { 
        error_reporting(1);


        if ($this->input->post()) { 
            $generated = $this->input->post();
            //pr($generated,1);
            $data = $generated;
            unset($data['print']);
            if ($data['invoice_adjustment'] != 0.00) {
                /*                 * ************************* */
                $billingData = null;
                $billingData[] = array(
                    'name' => 'Adjustment',
                    'cost' => (float) $data['invoice_adjustment']
                );
                $total += (float) $data['invoice_adjustment'];


                $taxtotal = 0.00;
                $invoice_meta['billings'] = $billingData;
                $invoice_meta['total'] = $taxtotal + $total;
                /*                 * **************************** */

                $invoice['invoice_customer'] = $data['collection_customer'];
                $invoice['invoice_due_date'] = $data['adjustment_date'];
                $invoice['invoice_date'] = $data['adjustment_date'];
                $invoice['invoice_billed_amount'] = $data['invoice_adjustment'];
                $invoice['invoice_tax_amount'] = 0.00;
                $invoice['invoice_for'] = 'Billing Adjustment';
                $invoice['invoice_meta'] = json_encode($invoice_meta);
                $this->invoices_model->insert_data($invoice);
            }
            if ($data['collection_amount'] != 0.00) {

                $collection['collection_collected_by'] = $data['collection_collected_by'];
                $collection['collection_customer'] = $data['collection_customer'];
                $collection['collection_note'] = $data['collection_note'];
                $collection['collection_amount'] = $data['collection_amount'];
                $collection['collection_date'] = $data['collection_date'];
                $collection['collection_for'] = $data['collection_for'];
                $collectionId = $this->collections_model->insert_data($collection);

                if (isset($generated['print'])) {
                    redirect(console_url('customer/print_due_statement/' . $data['collection_customer'] . '/' . $data['collection_date']));
                }
                // redirect(console_url('collection/print_receipt/' . $collectionId));
            }
            redirect(console_url('customer/billing/' . $data['collection_customer']));
        } else {
            $taxes = $this->taxes_model->get_list();
            $customerdata = $this->customers_model->get_list(array('customer_ID' => $this->uri->segment(4)));
            if (empty($customerdata[0]['customer_package']))
                redirect(console_url('customer'));

            $this->generate_bill(null, date('Y-m-d'));

            $data['invoices'] = $this->invoices_model->get_list(array('invoice_customer' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_customer' => $this->uri->segment(4)));

            $sheetData = null;
            foreach ($data['invoices'] as $value) {


                $k = count($sheetData[strtotime($value['invoice_date'])]);
                $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
                $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/customer/print_invoice_statement/' . $this->uri->segment(4) . '/' . $value['invoice_date'] . '">' . $value['invoice_for'] . ' </a>';
                $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
                $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
                $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
            }
            ksort($sheetData);
            foreach ($data['collections'] as $value) { //pr($value);
                $k = count($sheetData[strtotime($value['collection_date'])]);
                $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
                $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/customer/print_due_statement/' . $this->uri->segment(4) . '/' . $value['collection_date'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
                $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
                $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
                $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
            }
            ksort($sheetData);
            $data['sheetData'] = $sheetData;
            $data['customerdata'] = $customerdata[0];
            if (empty(json_decode($data['customerdata']['customer_package'], true))) {

                redirect(console_url('customer'));
            }
            $packages = $this->db->query(
                            "select * from packages where package_ID in (" .
                            implode(',', json_decode($data['customerdata']['customer_package'], true)) . ")")->result_array();
            $billingData = null;
            $total = 0.00;
            foreach ($packages as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['package_name'],
                    'cost' => (float) $valuex['package_rate']
                );
                $total += (float) $valuex['package_rate'];
            }
            if (empty(json_decode($data['customerdata']['customer_adons'], true))) {

                redirect(console_url('customer'));
            }

            $adons = $this->db->query(
                            "select * from channels where channel_ID in (" .
                            implode(',', json_decode($data['customerdata']['customer_adons'], true)) . ")")->result_array();
            foreach ($adons as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['channel_name'],
                    'cost' => (float) $valuex['channel_price']
                );
                $total += (float) $valuex['channel_price'];
            }
            $taxtotal = 0.00;
            foreach ($taxes as $value) {
                if ($value['tax_type'] == 0) {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . '%)',
                        'cost' => round((float) $value['tax_value'] * $total / 100, 2)
                    );
                    $taxtotal += round((float) $value['tax_value'] * $total / 100, 2);
                } else {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . ')',
                        'cost' => round((float) $value['tax_value'], 2)
                    );
                    $taxtotal += round((float) $value['tax_value'], 2);
                }
            }

            $data['billingData'] = $billingData;
            $data['total'] = $taxtotal + $total;
//pr($data);
            $this->render($data, 'billing_tpl');
        }
    }

    public function quick_bill() {
        $data = $this->input->post();
        $invoice['invoice_customer'] = $data['collection_customer'];
        $invoice['invoice_date'] = Date('Y-m-d');
        $invoice['invoice_due_date'] = $invoice['invoice_date'];

        $total = 0.00;
        $billingData = null;
        if ($data['customer_due_date_of_month'] == 0) {
            $invoice['invoice_due_date'] = $invoice['invoice_date'];
        } else {
            $invoice['invoice_due_date'] = Date('Y-m-') . $data['customer_due_date_of_month'];
        }

        $itemnames = null;
        foreach ($data['item'] as $k => $v) {
            $billingData[] = array(
                'name' => $data['item'][$k],
                'cost' => (float) $data['sum'][$k]
            );
            $itemnames[] = $data['item'][$k];
            $total += (float) (float) $data['sum'][$k];
        }

        $taxtotal = 0.00;
        $invoice_meta['billings'] = $billingData;
        $invoice_meta['total'] = $taxtotal + $total;
        $invoice['invoice_billed_amount'] = $taxtotal + $total;
        $invoice['invoice_tax_amount'] = $taxtotal;
        $invoice['invoice_for'] = 'Quick Bill for ' . implode(',', $itemnames);
        $invoice['invoice_meta'] = json_encode($invoice_meta);
        $this->invoices_model->insert_data($invoice);
        redirect('/console/customer/billing/' . $data['collection_customer']);
    }

    public function generate_bill($customer_id = null, $date = null, $return = false) {
        $statement_for = Date('F-y', strtotime($date));
        $customer_id = implode(',', $customer_id);
        if (empty($customer_id))
            $customers = $this->db->query('select * from customers where customer_status = 1')->result_array();
        else
            $customers = $this->db->query("select * from customers where customer_ID in($customer_id)")->result_array();
        $taxes = $this->taxes_model->get_list();


        foreach ($customers as $data) {
            $already_entry = $this->db->query("select * from invoices where invoice_for = '$statement_for' and invoice_customer = " . $data['customer_ID'])->result_array();
            //pr($already_entry,1);
            if (!empty($already_entry))
                continue;
            $invoice['invoice_customer'] = $data['customer_ID'];
            $invoice['invoice_date'] = Date('Y-m-d', strtotime($date));
            $total = 0.00;
            $billingData = null;
            if ($data['customer_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-') . $data['customer_due_date_of_month'];
            }
            if (empty(json_decode($data['customer_package'], true))) {

                continue;
            }

            $packages = $this->db->query(
                            "select * from packages where package_ID in (" .implode(',', json_decode($data['customer_package'], true)) . ")")->result_array();

            foreach ($packages as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['package_name'] . ' for ' . $statement_for,
                    'cost' => (float) $valuex['package_rate']
                );
                $total += (float) $valuex['package_rate'];
            }
            
            $add_on=json_decode($data['customer_adons'], true);

            if ($add_on[0]=="") {
              // pr($add_on,1);
                continue;
            }
            $adons = $this->db->query(
                            "select * from channels where channel_ID in (" .
                            implode(',', json_decode($data['customer_adons'], true)) . ")")->result_array();
            foreach ($adons as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['channel_name'],
                    'cost' => (float) $valuex['channel_price']
                );
                $total += (float) $valuex['channel_price'];
            }

            $taxtotal = 0.00;
            foreach ($taxes as $value) {
                if ($value['tax_type'] == 0) {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . '%)',
                        'cost' => (float) $value['tax_value'] * $total / 100
                    );
                    $taxtotal += (float) $value['tax_value'] * $total / 100;
                } else {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . ')',
                        'cost' => (float) $value['tax_value']
                    );
                    $taxtotal += (float) $value['tax_value'];
                }
            }

            $invoice_meta['billings'] = $billingData;
            $invoice_meta['total'] = $taxtotal + $total;
            $invoice['invoice_billed_amount'] = $taxtotal + $total;
            $invoice['invoice_tax_amount'] = $taxtotal;
            $invoice['invoice_for'] = $statement_for;
            $invoice['invoice_meta'] = json_encode($invoice_meta);

            if ($return) {
                return $invoice;
            } else {
                $this->invoices_model->insert_data($invoice);
            }
        }
    }

    public function due_list() {
        $customers_data = $this->with_due_calculation();
        $this->render(array("customers" => $customers_data), 'due_list_tpl');
    }

    public function array_sort_by_column(&$arr, $col, $dir) {
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        if ($dir == "desc") {
            $dir = SORT_DESC;
        }
        if ($dir == "asc") {
            $dir = SORT_ASC;
        }

        array_multisort($sort_col, $dir, $arr);
        // pr($sort_col);
    }

    private function with_due_calculation($customer_id = null) {
        if (empty($customer_id))
            $customers_data = $this->db->query('select * from customers  left join stbs on customer_stb = stb_ID')->result_array();
        else
            $customers_data = $this->db->query('select * from customers  left join stbs on customer_stb = stb_ID where customer_ID=' . $customer_id . '')->result_array();
        $customers_in = null;
        foreach ($customers_data as $key => $value) {
            $customers_in[] = $value['customer_ID'];
        }
        $customers_in = implode(',', $customers_in);

        $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_customer from invoices where invoice_customer in ($customers_in) group by invoice_customer")->result_array();
        $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_customer from collections where collection_customer in ($customers_in) group by collection_customer")->result_array();
        foreach ($invoices as $key => $value) {
            $customers[$value['invoice_customer']]['total_invoice'] = $value['total_invoice'];
        }
        foreach ($collections as $key => $value) {
            $customers[$value['collection_customer']]['total_collected'] = $value['total_collected'];
        }
        foreach ($customers_data as $key => $value) {
            $customers_data[$key]['total_collected'] = (float) $customers[$value['customer_ID']]['total_collected'];
            $customers_data[$key]['total_invoice'] = (float) $customers[$value['customer_ID']]['total_invoice'];
            $customers_data[$key]['due'] = (float) $customers[$value['customer_ID']]['total_invoice'] - (float) $customers[$value['customer_ID']]['total_collected'];
        }
        //pr($customers_data);

        return $customers_data;
    }

    public function migrate() {
        /*         * ********customer migrate********* */
        $this->db->query("UPDATE simplebillings_migrate.customers set stb_no = TRIM(Replace(Replace(Replace(stb_no,'\t',''),'\n',''),'\r',''))");
        $this->db->query("UPDATE simplebillings_migrate.customers set vc_no = TRIM(Replace(Replace(Replace(vc_no,'\t',''),'\n',''),'\r',''))");
        /*         * ************ */
        echo 'fixing old dbase stb and vc blank spaces..';
        $data = $this->db->query('select * from simplebillings_migrate.customers')->result_array();
        $this->db->query('TRUNCATE customers;');
        echo 'truncate current customers';

        $this->db->query('TRUNCATE stbs;');
        echo 'truncate current stbs';

        $datax = $this->db->query('select customer_ID,stb_no,count(*) as x from simplebillings_migrate.customers group by stb_no having x >1  ')->result_array();
        echo 'distinct customer and stb grouping';
        $customerIDS = '';
        foreach ($datax as $value) {
            if (!empty(trim($value['stb_no'])))
                $customerIDS[] = $value['customer_ID'];
        }


        if (!empty($customerIDS)) {
            $this->db->query("UPDATE simplebillings_migrate.`customers` SET `stb_no` = CONCAT(`stb_no`,'-DUPLICATE') WHERE `customers`.`customer_ID` IN (" . implode($customerIDS, ',') . ")");
        }
        echo 'finding and marking  duplicate stbs';
        foreach ($data as $value) {
            $stb = null;
            $datatoInsert = null;
            $datatoInsert['customer_ID'] = $value['customer_ID'];
            $datatoInsert['customer_code'] = $value['customer_code'];
            $datatoInsert['customer_name'] = $value['customer_name'];
            $datatoInsert['customer_address'] = $value['customer_address'];
            $datatoInsert['customer_contact'] = $value['customer_contact'];
            $datatoInsert['customer_activation_date'] = $value['customer_activation_date'];
            $datatoInsert['customer_package'] = $value['customer_package'];
            $datatoInsert['customer_adons'] = $value['customer_adons'];
            $datatoInsert['customer_assigned_to'] = $value['customer_agent'];
            $datatoInsert['customer_area'] = $value['customer_area'];
            $datatoInsert['customer_status'] = $value['customer_status'];
            $datatoInsert['customer_deactivation_date'] = $value['customer_deactivation_date'];
            $datatoInsert['customer_mso_account'] = $value['customer_mso_account'];
            $datatoInsert['customer_due_date_of_month'] = $value['customer_due_date_of_month'];
            $stb['stb_no'] = strtoupper(trim($value['stb_no']));
            //pr($this->stbs_model->get_list(array('stb_no'=>$value['stb_no'])));

            $stb['stb_vc'] = strtoupper(trim($value['vc_no']));
            $stb['stb_type'] = 'ASSIGNED';

            if (!empty(trim($value['stb_no'])))
                $datatoInsert['customer_stb'] = $this->stbs_model->insert_data($stb);
            else
                $datatoInsert['customer_stb'] = '';
            $this->customers_model->insert_data($datatoInsert);
        }
        redirect('/console/invoice/migrate');
    }

    public function billing_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_area = $this->input->post('customer_area');
        $customer_address = $this->input->post('customer_address');
        $package_name = $this->input->post('package_name');
        $invoice_for = $this->input->post('invoice_for');
        $customer_name = $this->input->post('customer_name');
        $customer_code = $this->input->post('customer_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `invoices` join `customers` on invoices.invoice_customer=customers.customer_ID WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND invoice_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND invoice_date<='" . $period_end . "'";
            }
            if (!empty($package_name)) {
                $package_name = '"' . $package_name . '"';
                $sql .= "AND customer_package='[" . $package_name . "]'";
            }
            if (!empty($invoice_for)) {
                $sql .= "AND invoice_for like '%" . $invoice_for . "%'";
            }
            if (!empty($customer_area)) {
                $sql .= "AND customer_area like '%" . $customer_area . "%'";
            }
            if (!empty($customer_address)) {
                $sql .= "AND customer_address like '%" . $customer_address . "%'";
            }
            if (!empty($customer_name)) {
                $sql .= "AND customer_name like '%" . $customer_name . "%'";
            }
            if (!empty($customer_code)) {
                $sql .= "AND customer_code= '" . $customer_code . "'";
            }
            # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
            $invoices = $this->db->query($sql)->result_array();
            //echo $sql;
            //pr($invoices,1);
            $customer_data = null;
            foreach ($invoices as $key => $invoice) {
                $customer_data[$key]['customer_name'] = $invoice['customer_name'];
                $customer_data[$key]['customer_code'] = $invoice['customer_code'];
                $customer_data[$key]['customer_address'] = $invoice['customer_address'];
                $customer_data[$key]['customer_area'] = $invoice['customer_area'];
                $customer_data[$key]['invoice_date'] = $invoice['invoice_date'];
                $customer_data[$key]['invoice_for'] = $invoice['invoice_for'];
                $customer_data[$key]['invoice_billed_amount'] = $invoice['invoice_billed_amount'];
                $customer_data[$key]['invoice_tax_amount'] = $invoice['invoice_tax_amount'];
            }
            //    pr($customer_data,1);
        }

        $package = $this->packages_model->get_list();
        if ($this->input->post()) {
            $this->load->view('console/customer/billing_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/customer/billing_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package));
        }
    }

    public function collection_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_area = $this->input->post('customer_area');
        $customer_address = $this->input->post('customer_address');
        $collection_collected_by = $this->input->post('collection_collected_by');
        $collection_for = $this->input->post('collection_for');
        $customer_name = $this->input->post('customer_name');
        $customer_code = $this->input->post('customer_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `collections` "
                    . "join `customers` on collections.collection_customer=customers.customer_ID "
                    . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND collection_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND collection_date<='" . $period_end . "'";
            }
            if (!empty($collection_collected_by)) {
                //   $collection_collected_by = '"' . $collection_collected_by . '"';
                $sql .= "AND collection_collected_by like '%" . $collection_collected_by . "%'";
            }
            if (!empty($collection_for)) {
                $sql .= "AND collection_for like '%" . $collection_for . "%'";
            }
            if (!empty($customer_area)) {
                $sql .= "AND customer_area like '%" . $customer_area . "%'";
            }
            if (!empty($customer_address)) {
                $sql .= "AND customer_address like '%" . $customer_address . "%'";
            }
            if (!empty($customer_name)) {
                $sql .= "AND customer_name like '%" . $customer_name . "%'";
            }
            if (!empty($customer_code)) {
                $sql .= "AND customer_code= '" . $customer_code . "'";
            }
            # $collections = $this->db->query("SELECT * FROM `collections` WHERE collection_date >='" . $period_start . "' AND collection_date<='" . $period_end . "'")->result_array();
            $collections = $this->db->query($sql)->result_array();
            //echo $sql;
            //pr($collections,1);
            $customer_data = null;
            foreach ($collections as $key => $collection) {
                $customer_data[$key]['customer_name'] = $collection['customer_name'];
                $customer_data[$key]['customer_code'] = $collection['customer_code'];
                $customer_data[$key]['customer_address'] = $collection['customer_address'];
                $customer_data[$key]['customer_area'] = $collection['customer_area'];
                $customer_data[$key]['collection_date'] = $collection['collection_date'];
                $customer_data[$key]['collection_for'] = $collection['collection_for'];
                $customer_data[$key]['collection_amount'] = $collection['collection_amount'];
                $customer_data[$key]['collection_collected_by'] = $collection['collection_collected_by'];
            }
            //    pr($customer_data,1);
        }

        $package = $this->packages_model->get_list();
        if ($this->input->post()) {
            $this->load->view('console/customer/collection_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/customer/collection_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package));
        }
    }

    public function not_collected_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_area = $this->input->post('customer_area');
        $customer_address = $this->input->post('customer_address');
        $customer_name = $this->input->post('customer_name');
        $customer_code = $this->input->post('customer_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql1 = "SELECT customer_ID FROM `collections` "
                    . "join `customers` on collections.collection_customer=customers.customer_ID "
                    . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql1 .= "AND collection_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql1 .= "AND collection_date<='" . $period_end . "'";
            }


            /*             * ***************** */
            $sql = "SELECT * from `customers`"
                    . "WHERE customer_ID not in ($sql1) ";
            if (!empty($customer_area)) {
                $sql .= "AND customer_area like '%" . $customer_area . "%'";
            }
            if (!empty($customer_address)) {
                $sql .= "AND customer_address like '%" . $customer_address . "%'";
            }
            if (!empty($customer_name)) {
                $sql .= "AND customer_name like '%" . $customer_name . "%'";
            }
            if (!empty($customer_code)) {
                $sql .= "AND customer_code= '" . $customer_code . "'";
            }

            # $collections = $this->db->query("SELECT * FROM `collections` WHERE collection_date >='" . $period_start . "' AND collection_date<='" . $period_end . "'")->result_array();
            $collections = $this->db->query($sql)->result_array();

            //  pr($collections,1);
            $customer_data = null;
            foreach ($collections as $key => $collection) {
                $customer_data[$key]['customer_ID'] = $collection['customer_ID'];
                $customer_data[$key]['customer_name'] = $collection['customer_name'];
                $customer_data[$key]['customer_code'] = $collection['customer_code'];
                $customer_data[$key]['customer_address'] = $collection['customer_address'];
                $customer_data[$key]['customer_area'] = $collection['customer_area'];
                $output = $this->with_due_calculation($collection['customer_ID']);
                $customer_data[$key]['due'] = $output[0]['due'];
            }
            // pr($customer_data,1);
        }

        $package = $this->packages_model->get_list();
        if ($this->input->post()) {
            $this->load->view('console/customer/not_collected_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/customer/not_collected_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package));
        }
    }

    public function items() {
        pr($this->input->post());
    }

    public function get_collection_for() {
        $collection_for = $this->invoices_model->get_list(array('invoice_customer' => $this->input->post('customer_id')));
        foreach ($collection_for as $key => $value) {
            echo '<option value = "'.$value['invoice_for'].'">';
        }
    }
    

}

?>
