<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @package internet
 * @author Kallol
 */
class Internet_customer extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'internet_customers_model';
        $this->moduleMeta = array('internet' => 'Internet Customer');

        $this->load->model($this->targetModel);

        $this->page_config['use_dropdown_columns'] = 'customer_package,customer_isp';
        //$this->page_config['use_dropdown_columns_options']['multi']['customer_package'] = 'multiple';


        $this->page_config['use_dropdown_columns_options']['customer_package'] = $this->internet_packages_model->get_list_for_dropdown('package_name');
        $this->page_config['use_dropdown_columns_options']['customer_isp'] = array(
            "ALLIANCE"=>'ALLIANCE',
            "SITI"=>'SITI',
            "HATHWAY"=>'HATHWAY',
            'IKF'=>'IKF',
            "MEGHBELA"=>"MEGHBELA",
            "WISHNET"=>"WISHNET",
            "BITTEL"=>"BITTEL",
            "GTPL"=>"GTPL",
        "MICRONET"=>"MICRONET"
        );

        $this->allowed_action = array_merge($this->allowed_action, array('billing', 'print_statement'));
        $this->page_config['tablePrimaryKey'] = $this->internet_customers_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Customer'; //search title bar
        $this->page_config['searchFields'] = 'customer_user_name,customer_ip,customer_name,customer_package,customer_code,customer_address,customer_area,customer_isp_account,customer_isp'; //search box,
        $this->page_config['list_columns'] = 'due,customer_last_renew_date,customer_renewal_date,customer_status,customer_ip,customer_name,customer_email,customer_package,customer_username,customer_area,customer_user_name';
        /*         * end page_config* */
    }

    /**
     * index show list'
     * todo: order by in custom fields not implemented
     * here orderby dont work
     */
    public function index2() {
        // $orderBy = $this->orderby_input_process();
        $condition = null;
        $likeCondition = $this->generate_search_like_condition();
        if (!empty($likeCondition['customer_code'])) {
            $condition['customer_code'] = $likeCondition['customer_code'];
            unset($likeCondition['customer_code']);
        }

        $allData = $this->{$this->targetModel}->get_list_for_tables($condition, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);

//foreach ($allData['current_paged_list'] as $key => $customer_data) {
        //$customer_ID = $customer_data['customer_ID'];
        /*         * *****due data****** */
        //$data = $this->with_due_calculation($customer_ID);
        //$allData['current_paged_list'] [$key] = $data[0];
        /*         * ****renewal_data*********** */
        //$returnData = $this->renewal($customer_ID);
        //$allData['current_paged_list'] [$key]['customer_renewal_date']= $returnData['customer_renewal_date'];
        //}
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function index() {
        //$orderBy = $this->orderby_input_process();
        $condition = null;
        $likeCondition = $this->generate_search_like_condition();
        
        if (!empty($likeCondition['customer_code'])) {
            $condition['customer_code'] = $likeCondition['customer_code'];
            unset($likeCondition['customer_code']);
        }


        $allData = $this->{$this->targetModel}->get_list_for_tables($condition, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        //pr($this->db->last_query());
        foreach ($allData['current_paged_list'] as $key => $customer_data) {
            $customer_ID = $customer_data['customer_ID'];
            /*             * *****due data****** */
            $data = $this->with_due_calculation($customer_ID);
            $allData['current_paged_list'] [$key] = $data[0];
            /*             * ****renewal_data*********** */
            $returnData = $this->renewal($customer_ID);
            $allData['current_paged_list'] [$key]['customer_renewal_date'] = $returnData['customer_renewal_date'];
        }
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

     public function import_customer()
    {

        $this->render();
    }

     public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 10000;
        $config['overwrite'] = true;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('userfile')) {
        //     pr('no');

        //     $error = array('error' => $this->upload->display_errors());
        //     $this->load->view('console/customer/table_tpl', $error);
        // } else {

        // pr($_FILES['userfile']);
        // die();

        if (isset($_FILES['userfile'])) {
            $errors = array();
            $file_name = $_FILES['userfile']['name'];
            $file_tmp = $_FILES['userfile']['tmp_name'];
            $file_size = $_FILES['userfile']['size'];
            $file_type = $_FILES['userfile']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['userfile']['name'])));

            $extensions = array("xlsx", "xls", "csv");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a xlsx, csv or xls file.";
            }

            // if ($file_size > 10000) {
            //     $errors[] = 'File size must be excately 2 MB';
            // }


            if (empty($errors) == true) {

                //pr($_FILES);

                $excel = excelToArray($file_tmp);

                foreach ($excel as $value) {

                    $pack = $this->db->query("select * from internet_packages  where package_name='" . $value['customer_package'] . "'")->result_array();

                    // $string_price = '"' . $value['customer_package'] . '"';
                    // $pack_price = (int) filter_var($string_price, FILTER_SANITIZE_NUMBER_INT);

                  //  $customer_package =  '{"items":[{"name":"' . $pack[0]['package_name'] . '","price":' . $pack_price . '}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';

                    if (empty($pack)) {
                        $this->db->query("INSERT INTO `internet_packages`(`package_name`, normal_bandwidth, streaming_and_peering_bandwidth, package_rate, package_cost_inclusive_tax, package_subscription_days) VALUES ('" . $value['customer_package'] . "','','','','','')");
                        $pack_data = $this->db->query("select * from internet_packages where package_name='" . $value['customer_package'] . "'")->result_array();
                        $package_id = $pack_data[0]['package_ID'];
                        //$value['customer_package'] = '{"items":[{"name":"' . $pack_data[0]['package_name'] . '","price":"' . $pack_data[0]['package_rate'] . '"}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';
                    } else {
                        $package_id = $pack[0]['package_ID'];
                        //$value['customer_package'] = $customer_package;
                    }
                    // $stb_no = str_replace(array('"',"'"), "", $value['customer_stb']);
                    // $stb = $this->db->query("select * from stbs  where stb_no='" . $stb_no . "'")->result_array();

                    // if (empty($stb)) {
                    //     // echo 'empty stb';()
                       
                    //     $this->db->query("INSERT INTO `stbs`(`stb_no`) VALUES ('" . $stb_no . "')");
                    //     $stb_data = $this->db->query("select * from stbs where stb_no='" . $stb_no . "'")->result_array();
                    //     // pr($stb_data);
                    //     $value['customer_stb'] = $stb_data[0]['stb_no'];
                    // } else {
                    //     $value['customer_stb'] = $stb[0]['stb_no'];
                    // }
                    $duplicate_chk = $this->db->query("SELECT * FROM `internet_customers`")->result_array();
                    $customer_con = str_replace(array('"',"'"), "", $value['customer_contact']);
                    // if ($duplicate_chk[0]['customer_stb'] === $value['customer_stb']) {
                    //     echo "Duplicate Entry";
                    // } else {
                    $sql = "INSERT INTO internet_customers"
                        . "(customer_name,"
                        . "customer_ip,"
                        . "customer_user_name,"
                        . "customer_address,"
                        . "customer_area,"
                        . "customer_contact,"
                        . "customer_package,"
                        . "customer_code,"
                        . "customer_isp,"
                        . "customer_isp_account,"
                        . "customer_status,"
                        . "customer_last_renew_date,"
                        . "customer_activation_date,"
                        . "customer_deactivation_date,"
                        . "customer_is_free) "

                        . "VALUES('" . $value['customer_name'] . "','" . $value['customer_ip'] . "','" . $value['customer_user_name'] . "','" . $value['customer_address'] . "','" . $value['customer_area'] . "','" . $customer_con . "','" . $package_id . "','" . $value['customer_code'] . "','','" . $value['customer_isp_account'] . "','" . $value['customer_status'] . "','','','','')";
                    $this->db->query($sql);
                    // print_r($sql);
                    // }
                }

                redirect('console/internet_customer');
            } else {
                print_r($errors[0]);
            }
        }

        // }
    }


    public function customer_wise_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_area = $this->input->post('customer_area');
        $customer_address = $this->input->post('customer_address');
        $package_ID = $this->input->post('package_ID');
        $invoice_for = $this->input->post('invoice_for');
        $customer_name = $this->input->post('customer_name');
        $customer_code = $this->input->post('customer_code');
        $customer_isp = $this->input->post('customer_isp');


        $package = $this->internet_packages_model->get_list();

        if (!empty($post_data)) {
            $sql = "SELECT * FROM  `internet_customers` left join internet_packages on internet_packages.package_ID = internet_customers.customer_package  WHERE 1 = 1 ";

            if (!empty($customer_area)) {
                $sql .= " AND customer_area like '%" . $customer_area . "%'";
            }
            if (!empty($customer_address)) {
                $sql .= " AND customer_address like '%" . $customer_address . "%'";
            }
            if (!empty($package_ID)) {
                $sql .= " AND package_ID = '" . $package_ID . "'";
            }
            if (!empty($customer_name)) {
                $sql .= " AND customer_name like '%" . $customer_name . "%'";
            }
            if (!empty($customer_code)) {
                $sql .= " AND customer_code= '" . $customer_code . "'";
            }
            if (!empty($customer_isp)) {
                $sql .= " AND customer_isp = '" . $customer_isp . "'";
            }
            $customers = $this->db->query($sql)->result_array();
           
           //print_r($sql);
            $customer_data = null;
            foreach ($customers as $key => $customer) {
                $output = null;
                $output = $this->with_due_calculation($customer['customer_ID']);
                $customer_data[] = $output[0];
            }
        }
        $isp = $this->db->query("SELECT DISTINCT customer_isp FROM internet_customers")->result_array();
        if ($this->input->post()) {
            $this->load->view('console/internet_customer/customer_wise_ajax_billing', array('customer_data' => $customer_data));
        } else {
            $this->load->view('console/internet_customer/customer_wise_billing_report_tpl', array('package' => $package,'isp' => $isp));
        }
    }

    public function inactive_customer() {
        $condition = array('customer_status' => 0);
        $allData = $this->{$this->targetModel}->get_list($condition, FALSE, 200000, NULL);
        $packages = $this->internet_packages_model->get_list_for_dropdown('package_name');
        $this->load->view('console/internet_customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages));
    }

    public function all_customer() {
        $allData = $this->{$this->targetModel}->get_list(null, FALSE, 200000, NULL);
        $packages = $this->internet_packages_model->get_list_for_dropdown('package_name');
        $this->load->view('console/internet_customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages));
    }

    public function active_customer() {
        $condition = array('customer_status' => 1);
        $allData = $this->{$this->targetModel}->get_list($condition, FALSE, 200000, NULL);
        $packages = $this->internet_packages_model->get_list_for_dropdown('package_name');
        $this->load->view('console/internet_customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages));
    }

    public function package_customer() {
        $customer_package = null;
        $packages = $this->internet_packages_model->get_list_for_dropdown('package_name');

        if ($this->input->get('package') != 'Unset') {
            $packagename = $this->input->get('package');

            $targetpackage = $this->internet_packages_model->get_list(array('package_ID' => $packagename));

            $condition = array('customer_status' => 1, 'customer_package' => $targetpackage[0]['package_ID']);
            $allData = $this->{$this->targetModel}->get_list($condition, FALSE, 200000, NULL);
        } else {
            $packagelist = '';
            $condition = array('customer_status' => 1, 'customer_package' => '');
            foreach ($packages as $package_ID => $pack) {
                $packagelist[] = $package_ID;
            }
            $packagelist = implode(',', $packagelist);

            $sql = $this->db->query('select * from internet_customers where customer_package not in(' . $packagelist . ')');
            $allData = $sql->result_array();
        }
        $this->load->view('console/internet_customer/customer_listing_tpl', array('customer_data' => $allData, 'packages' => $packages));
    }

    /**
     * add detail
     */
    public function add_detail() {
        
        $postedData = $this->input->post();
       
     
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
        
            //echo $this->generate_form_view($entryData[0], $this->page_config);
         echo $this->generate_form_view($entryData[0], $this->page_config,'add_edit_tpl');//,
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
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
            //echo $this->generate_form_view($entryData, $this->page_config,'add_edit_tpl');
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
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['entry']));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function print_statement() {
        $customer = $this->internet_customers_model->get_list(array('customer_ID' => $this->uri->segment(4)));
        $statement_for = $this->uri->segment(5);

        $data['customerData'] = $customer[0];
        if (!empty($statement_for)) {
            $data['invoices'] = $this->internet_invoices_model->get_list(array('invoice_for' => $statement_for, 'invoice_customer' => $this->uri->segment(4)));
            $data['collections'] = $this->internet_collections_model->get_list(array('collection_for' => $statement_for, 'collection_customer' => $this->uri->segment(4)));
        } else {
            $data['invoices'] = $this->internet_invoices_model->get_list(array('invoice_customer' => $this->uri->segment(4)));
            $data['collections'] = $this->internet_collections_model->get_list(array('collection_customer' => $this->uri->segment(4)));
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
        //pr($this->internet_customers_model->account_statement($customer,$invoice_date));

        $this->load->view('console/internet_customer/print_template_tpl', $data);
    }

    public function print_due_statement() {
        $invoice_date = $this->uri->segment(5);
        $customer_id = $this->uri->segment(4);
        $data = $this->internet_customers_model->account_statement($customer_id, $invoice_date);
        $isthermal = get_option('thermal');
        if($isthermal=="true"){
            $this->load->view('console/internet_customer/print_thermal_template_due_tpl', array('data' => $data, 'date' => $invoice_date));
        } else{
            $this->load->view('console/internet_customer/print_template_due_tpl', array('data' => $data, 'date' => $invoice_date));
        }

    }

    public function print_invoice_statement() {
        $invoice_id = $this->uri->segment(5);
        $customer_id = $this->uri->segment(4);
        $invoice_data = $this->internet_invoices_model->get_list(array('invoice_ID' => $invoice_id, 'invoice_customer' => $customer_id));
        if (empty($invoice_data[0])) {

            redirect('/console/');
        }
        $data = $this->internet_customers_model->account_statement($invoice_data[0]['invoice_customer'], $invoice_data[0]['invoice_date']);
        $isthermal = get_option('thermal');
        if($isthermal=="true"){
           $this->load->view('console/internet_customer/print_thermal_template_invoice_tpl', array('invoice' => $invoice_data[0], 'data' => $data, 'date' => $invoice_data[0]['invoice_date']));
        } else{
            $this->load->view('console/internet_customer/print_template_invoice_tpl', array('invoice' => $invoice_data[0], 'data' => $data, 'date' => $invoice_data[0]['invoice_date']));
        }

        
    }

    public function billing() {
        error_reporting(1);

//pr($this->input->post(),1);
        if ($this->input->post()) {
            $generated = $this->input->post();
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
                $this->internet_invoices_model->insert_data($invoice);
            }
            if ($data['collection_amount'] != 0.00) {

                $collection['collection_collected_by'] = $data['collection_collected_by'];
                $collection['collection_customer'] = $data['collection_customer'];
                $collection['collection_note'] = $data['collection_note'];
                $collection['collection_amount'] = $data['collection_amount'];
                $collection['collection_date'] = $data['collection_date'];
                $collection['collection_for'] = $data['collection_for'];
                $collectionId = $this->internet_collections_model->insert_data($collection);
                if (isset($generated['print']))
                    redirect(console_url('internet_customer/print_due_statement/' . $data['collection_customer'] . "/" . $data['collection_date']));
            }
            redirect(console_url('internet_customer/billing/' . $data['collection_customer']));
        } else {
            $taxes = $this->internet_taxes_model->get_list();
            $customerdata = $this->internet_customers_model->get_list(array('customer_ID' => $this->uri->segment(4)));

            if (empty($customerdata))
                redirect(console_url('customer'));
            // pr($customerdata,1);
            //$this->generate_bill();

            $data['invoices'] = $this->internet_invoices_model->get_list(array('invoice_customer' => $this->uri->segment(4)));
            $data['collections'] = $this->internet_collections_model->get_list(array('collection_customer' => $this->uri->segment(4)));

            $sheetData = null;
            foreach ($data['invoices'] as $value) {


                $k = count($sheetData[strtotime($value['invoice_date'])]);
                $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
                $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/internet_customer/print_invoice_statement/' . $this->uri->segment(4) . '/' . $value['invoice_ID'] . '">' . $value['invoice_for'] . '</a>';
                $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
                $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
                $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
            }
            ksort($sheetData);
            foreach ($data['collections'] as $value) { //pr($value);
                $k = count($sheetData[strtotime($value['collection_date'])]);
                $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
                $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/internet_customer/print_due_statement/' . $this->uri->segment(4) . '/' . $value['collection_date'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
                $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
                $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
                $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
            }
            ksort($sheetData);
            $data['sheetData'] = $sheetData;
            $data['customerdata'] = $customerdata[0];
            //pr($data['customerdata']);
            if (!empty($data['customerdata']['customer_package'])) {
                //$packages = $this->db->query("select * from internet_packages where package_ID in (" . implode(',', json_decode($data['customerdata']['customer_package'])) . ")")->result_array();
                $packages = $this->db->query("select * from internet_packages where package_ID =  " . $data['customerdata']['customer_package'])->result_array();
            }
            if (empty($packages))
                redirect('/console/internet_customer/' . $data['customerData']);
            $billingData = null;
            $total = 0.00;
            foreach ($packages as $valuex) {

                $billingData[] = array(
                    'name' => $valuex['package_name'],
                    'cost' => (float) $valuex['package_rate']
                );
                $total += (float) $valuex['package_rate'];
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

            $data['billingData'] = $billingData;
            $data['total'] = $taxtotal + $total;

            $this->render($data, 'billing_tpl');
        }
    }

     public function fastbill()
    {
        $customerdata = $this->internet_customers_model->get_list(array('customer_ID' => $this->uri->segment(4)));

        $data['invoices'] = $this->internet_invoices_model->get_list(array('invoice_customer' => $this->uri->segment(4)));
        $data['collections'] = $this->internet_collections_model->get_list(array('collection_customer' => $this->uri->segment(4)));
        $sheetData = null;
        foreach ($data['invoices'] as $value) {
            // pr($value);
            $k = count($sheetData[strtotime($value['invoice_date'])]);

            $sheetData[strtotime($value['invoice_date'])][$k]['ID'] = $value['invoice_ID'];
            $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
            $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/internet_customer/print_invoice_statement/' . $this->uri->segment(4) . '/' . $value['invoice_ID'] . '">' . $value['invoice_for'] . '</a>';
            $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
            $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
            $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
        }
        ksort($sheetData);
        foreach ($data['collections'] as $value) { //pr($value);
            $k = count($sheetData[strtotime($value['collection_date'])]);
            $sheetData[strtotime($value['collection_date'])][$k]['ID'] = $value['collection_ID'];
            $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
            // $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/internet_customer/print_due_statement/' . $value['collection_ID'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
            $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/internet_customer/print_due_statement/' . $this->uri->segment(4) . '/' . $value['collection_date'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
            $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
            $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
            $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
        }
        ksort($sheetData);
        $data['sheetData'] = $sheetData;
        $data['customerdata'] = $customerdata[0];
       // $customer_package = json_decode($data['customerdata']['customer_package'], true);
        if (!empty($data['customerdata']['customer_package'])) {
                //$packages = $this->db->query("select * from internet_packages where package_ID in (" . implode(',', json_decode($data['customerdata']['customer_package'])) . ")")->result_array();
                $customer_package = $this->db->query("select * from internet_packages where package_ID =  " . $data['customerdata']['customer_package'])->result_array();
            }

        $invoice_meta['billings'] = $customer_package;
        $invoice_meta['total'] = $customer_package['package_cost_inclusive_tax'];
        $invoice['invoice_billed_amount'] = $customer_package['package_cost_inclusive_tax'];
        $invoice['invoice_tax_amount'] = $customer_package['package_cost_inclusive_tax'] / 1.18;
        $invoice['invoice_for'] = "Internet Billing";
        $invoice['invoice_meta'] = json_encode($invoice_meta);
        $data['billingData'] = $customer_package;
        $data['total'] = $invoice['invoice_billed_amount'];
        $data['sub_total'] = $customer_package['package_rate'];


        $taxes = $this->db->query("SELECT SUM(tax_value) as total_tax FROM `taxes`")->result_array();
        $data['total_tax_rate'] =  isset($taxes[0]['total_tax']) ? floatval($taxes[0]['total_tax']) : 0;
        if (!empty($taxes)) {
            $taxtotal = $data['sub_total'] * $data['total_tax_rate'] / 100;
            $data['gst'] = $taxtotal;
        } else {
            $data['gst'] = 0;
        }
        $this->render($data, 'fastbill_tpl');

    }

     public function fastquick_bill()
    {
        $data = $this->input->post();
        $invoice['invoice_customer'] = $data['invoice_customer'];
        $invoice['invoice_date'] = $data['invoice_date'];
        $invoice['invoice_due_date'] = $data['invoice_due_date'];
        $total = 0.00;
        $billingData = null;
        $itemnames = array();
        foreach ($data['item'] as $k => $v) {
            $itemnames[] = array(
                'name' => $data['item'][$k],
                'cost' => (float) $data['sum'][$k]
            );
            $total += (float) (float) $data['sum'][$k];
        }

        $taxes = $this->taxes_model->get_list();
        // if (!empty($taxes)) {
        //     $taxtotal = $total * 18 / 100;
        // } else {
        //     $taxtotal = 0;
        // }
        $taxtotal = 0.00;
            foreach ($taxes as $value) {
                if ($value['tax_type'] == 0) {
                    $itemnames[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . '%)',
                        'cost' => (float) $value['tax_value'] * $total / 100
                    );
                    $taxtotal += (float) $value['tax_value'] * $total / 100;
                } else {
                    $itemnames[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . ')',
                        'cost' => (float) $value['tax_value']
                    );

                    $taxtotal += (float) $value['tax_value'];
                }
            }
        $billingData['billings'] = $itemnames;
        //$billingData['billings']['items'] = $itemnames;
       // $billingData['billings']['subtotal'] = $total;
        //$billingData['billings']['discount'] = $data['discount'];
        $billingData['total'] = round($taxtotal + $total);
        //- floatval($data['discount']);

        $invoice['invoice_billed_amount'] = $billingData['total'];
        $invoice['invoice_tax_amount'] = $taxtotal;
        $invoice['invoice_meta'] = json_encode($billingData);

        $package_id = $this->db->query("SELECT * FROM `internet_packages` WHERE `package_name` LIKE '".$data['item'][0]."'")->result_array();
      
        if (isset($data['package'])) {
            $this->internet_customers_model->update_data(array("customer_package" => $package_id[0]['package_ID']), array('customer_ID' => $data['invoice_customer']));
        } else {
            if (!isset($data['otherbill'])) {
                $invoice['invoice_for'] = 'Bill for ' . date('F-y', strtotime($invoice['invoice_date']));
                $this->internet_customers_model->update_data(array("customer_package" => $package_id[0]['package_ID']), array('customer_ID' => $data['invoice_customer']));
            } else {
                $invoice['invoice_for'] = 'Bill for items ';
            }
           
            $this->internet_invoices_model->insert_data($invoice);
        }
        redirect('/console/internet_customer/fastbill/' . $data['invoice_customer']);
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
        $this->internet_invoices_model->insert_data($invoice);

        redirect('/console/internet_customer/fastbill/' . $data['invoice_customerbillingData']);
    }

    public function generate_bill($customer_id = null, $statement_for = null, $return = false) {
        $statement_for = Date('F-y');
        $customer_id = implode(',', $customer_id);
        if (empty($customer_id))
            $customers = $this->db->query('select * from internet_customers where customer_status = 1')->result_array();
        else
            $customers = $this->db->query("select * from internet_customers where customer_ID in($customer_id) ")->result_array();
        $taxes = $this->internet_taxes_model->get_list();

       // pr($customers, 1);

        foreach ($customers as $data) {
            $already_entry = $this->db->query("select * from internet_invoices where invoice_for = '$statement_for' and invoice_customer = " . $data['customer_ID'])->result_array();

            if (!empty($already_entry)) {

                continue;
            }

            $invoice['invoice_customer'] = $data['customer_ID'];
            $invoice['invoice_date'] = Date('Y-m-d');
            $total = 0.00;
            $billingData = null;
            if ($data['customer_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-') . $data['customer_due_date_of_month'];
            }

            $packages = $this->db->query(
                            "select * from internet_packages where package_ID in (" . $data['customer_package'] . ")")->result_array();


            foreach ($packages as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['package_name'] . ' for ' . $statement_for,
                    'cost' => (float) $valuex['package_rate']
                );

                $total += (float) $valuex['package_rate'];
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
                $this->internet_invoices_model->insert_data($invoice);
            }
        }
    }

    public function due_list() {
        $customers_data = $this->with_due_calculation();
        $this->render(array("customers" => $customers_data), 'due_list_tpl');
    }

    private function with_due_calculation($customer_id = null) {

        if (empty($customer_id))
            $customers_data = $this->db->query('select * from internet_customers ')->result_array();
        else
            $customers_data = $this->db->query('select * from internet_customers  where customer_ID=' . $customer_id . '')->result_array();
        $customers_in = null;
        foreach ($customers_data as $key => $value) {
            $customers_in[] = $value['customer_ID'];
        }
        $customers_in = implode(',', $customers_in);

        $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_customer from internet_invoices where invoice_customer in ($customers_in) group by invoice_customer")->result_array();
        $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_customer from internet_collections where collection_customer in ($customers_in) group by collection_customer")->result_array();
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
        return $customers_data;
    }

    public function billing_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_area = $this->input->post('customer_area');
        $customer_isp = $this->input->post('customer_isp');
        $customer_address = $this->input->post('customer_address');
        $package_name = $this->input->post('package_name');
        $invoice_for = $this->input->post('invoice_for');
        $customer_name = $this->input->post('customer_name');
        $customer_code = $this->input->post('customer_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `internet_invoices` join `internet_customers` on internet_invoices.invoice_customer=internet_customers.customer_ID WHERE 1 = 1 ";

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
            if (!empty($customer_isp)) {
                $sql .= "AND customer_isp = '" . $customer_isp . "'";
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
            $invoices = $this->db->query($sql)->result_array();



            $customer_data = null;
            foreach ($invoices as $key => $invoice) {
                $customer_data[$key]['customer_name'] = $invoice['customer_name'];
                $customer_data[$key]['customer_code'] = $invoice['customer_code'];
                $customer_data[$key]['customer_address'] = $invoice['customer_address'];
                $customer_data[$key]['customer_area'] = $invoice['customer_area'];
                $customer_data[$key]['customer_isp'] = $invoice['customer_isp'];
                $customer_data[$key]['invoice_date'] = $invoice['invoice_date'];
                $customer_data[$key]['invoice_for'] = $invoice['invoice_for'];
                $customer_data[$key]['invoice_billed_amount'] = $invoice['invoice_billed_amount'];
                $customer_data[$key]['invoice_tax_amount'] = $invoice['invoice_tax_amount'];
            }
        }

        $package = $this->internet_packages_model->get_list();
        $isp = $this->db->query("SELECT DISTINCT customer_isp FROM internet_customers")->result_array();
        if ($this->input->post()) {
            $this->load->view('console/internet_customer/billing_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/internet_customer/billing_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package, 'isp' => $isp));
        }
    }

    public function collection_report() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $collection_note = $this->input->post('collection_note');
        //$customer_area = $this->input->post('customer_area');
        $customer_isp = $this->input->post('customer_isp');
        //$customer_address = $this->input->post('customer_address');
        $collection_collected_by = $this->input->post('collection_collected_by');
        $collection_for = $this->input->post('collection_for');
        $customer_name = $this->input->post('customer_name');
       // $customer_code = $this->input->post('customer_code');
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `internet_collections` "
                    . "join `internet_customers` on internet_collections.collection_customer=internet_customers.customer_ID "
                    . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND collection_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND collection_date <='" . $period_end . "'";
            }
            if (!empty($collection_collected_by)) {
                //$collection_collected_by = '"' . $collection_collected_by . '"';
                $sql .= "AND collection_collected_by like '%" . $collection_collected_by . "%'";
            }
            if (!empty($collection_for)) {
                $sql .= "AND collection_for like '%" . $collection_for . "%'";
            }
            if (!empty($collection_note)) {
                $sql .= "AND collection_note like '" . $collection_note . "'";
            }
            // if (!empty($customer_area)) {
            //     $sql .= "AND customer_area like '%" . $customer_area . "%'";
            // }
            // if (!empty($customer_address)) {
            //     $sql .= "AND customer_address like '%" . $customer_address . "%'";
            // }
            if (!empty($customer_isp)) {
                $sql .= "AND customer_isp = '" . $customer_isp . "'";
            }
            if (!empty($customer_name)) {
                $sql .= "AND customer_name like '%" . $customer_name . "%'";
            }
            // if (!empty($customer_code)) {
            //     $sql .= "AND customer_code= '" . $customer_code . "'";
            // }
            $collections = $this->db->query($sql)->result_array();
            $customer_data = null;
            foreach ($collections as $key => $collection) {
                $customer_data[$key]['customer_name'] = $collection['customer_name'];
                $customer_data[$key]['customer_code'] = $collection['customer_code'];
                $customer_data[$key]['customer_address'] = $collection['customer_address'];
                $customer_data[$key]['customer_isp'] = $collection['customer_isp'];
                $customer_data[$key]['customer_area'] = $collection['customer_area'];
                $customer_data[$key]['collection_date'] = $collection['collection_date'];
                $customer_data[$key]['collection_for'] = $collection['collection_for'];
                $customer_data[$key]['collection_amount'] = $collection['collection_amount'];
                $customer_data[$key]['collection_collected_by'] = $collection['collection_collected_by'];
                $customer_data[$key]['collection_note'] = $collection['collection_note'];
            }
        }

        $package = $this->internet_packages_model->get_list();
        $isp = $this->db->query("SELECT DISTINCT customer_isp FROM internet_customers")->result_array();
        if ($this->input->post()) {
            $this->load->view('console/internet_customer/collection_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/internet_customer/collection_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package, 'isp' => $isp));
        }
    }

    private function renewal($customer_ID) {
        $data = $this->db->query("select * from internet_customers 
        join internet_packages on 
        internet_customers.customer_package = internet_packages.package_ID
        where customer_ID = $customer_ID
        ")->result_array();
        foreach ($data as $k => $v) {
            $data['customer_renewal_date'] = date('Y-m-d', strtotime('+' . $v['package_subscription_days'] . ' days', strtotime($v['customer_last_renew_date'])));
        }
        return $data;
    }

}
