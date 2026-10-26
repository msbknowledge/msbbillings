<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author Kallol
 */
class Lco extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'lco_status';
        $this->targetModel = 'lcos_model';
        $this->moduleMeta = array('cables' => 'lco');
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'lco_stb,lco_assigned_to,lco_due_date_of_month,lco_status,lco_mso';
        $this->page_config['use_dropdown_columns_options']['lco_stb'] = $this->stb();
        $this->page_config['use_dropdown_columns_options']['lco_status'] = array(0 => 'Off', 1 => 'On');
        //$this->page_config['use_dropdown_columns_options']['lco_assigned_to'] = $this->users_model->get_list_for_dropdown('user_login');
        $this->page_config['use_dropdown_columns_options']['lco_mso'] = $this->stbs_model->get_list_for_dropdown('stb_mso');
        $due_data = array();
        for ($due = 1; $due <= 31; $due++) {
            $due_data[] = $due;
        }
        $this->page_config['use_dropdown_columns_options']['lco_due_date_of_month'] = $due_data;

        $this->allowed_action = array_merge($this->allowed_action, array('billing', 'extra_bill', 'print_statement'));
        $this->load->helper(array('dompdf', 'file', 'csv'));
        $this->page_config['tablePrimaryKey'] = $this->lcos_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'lco'; //search title bar
        $this->page_config['searchFields'] = 'stb_no,stb_vc,lco_name,lco_code,lco_address,stb_mso,lco_status'; //search box,
        $this->page_config['list_columns'] = 'stb_no,stb_vc,lco_name,lco_code,lco_address,stb_mso,lco_status';
        /*         * end page_config* */
    }

    public function widget()
    {

        // page info here, db calls, etc.
        $data = null;
        //$html = $this->load->view('console/lco/pdf_tpl', $data, true);
        $html = file_get_contents('http://prerelease.website/invoice_template/');
        pdf_create($html, 'filename');
        // or
        // $data = pdf_create($html, '', false);
        // write_file('name', $data);
    }

    public function lco_search_by_name()
    {
        $results = $this->lcos_model->get_list_for_dropdown(null, array('lco_status' => 1), null, 10, null, array('lco_name' => $this->input->get('term')));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['lco_ID'];
            $output[$key]['label'] = $result['lco_name'] . '(' . $result['lco_code'] . ')';
            $output[$key]['value'] = $result['lco_name'];
            $invoice_generated = generate_invoice($result['lco_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }
        echo json_encode($output);
    }

    public function lco_search_by_code()
    {
        $results = $this->lcos_model->get_list_for_dropdown(null, array('lco_status' => 1), null, 10, null, array('lco_code' => $this->input->get('term')));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['lco_id'];
            $output[$key]['label'] = $result['lco_code'] . '(' . $result['lco_name'] . ')';
            $output[$key]['value'] = $result['lco_code'];
            if (!empty($this->input->get('invoice_date')))
                $invoice_generated = generate_invoice($result['lco_ID'], ($this->input->get('invoice_date')));
            else
                $invoice_generated = generate_invoice($result['lco_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }

        echo json_encode($output);
    }

    public function lco_search_by_id()
    {
        $results = $this->lcos_model->get_list_for_dropdown(null, array('lco_ID' => $this->input->get('term'), 'lco_status' => 1), null, 10, null);
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['lco_id'];
            $output[$key]['label'] = $result['lco_code'] . '(' . $result['lco_name'] . ')';
            $output[$key]['value'] = $result['lco_code'];
            if (!empty($this->input->get('invoice_date')))
                $invoice_generated = generate_invoice($result['lco_ID'], ($this->input->get('invoice_date')));
            else
                $invoice_generated = generate_invoice($result['lco_ID']);

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
    public function index()
    {

        if (!empty($this->orderby_input_process())) {
            $orderBy = " order by ";
            $orderBy .= $this->orderby_input_process();
        }
        $condition = null;
        $likeCondition = $this->generate_search_like_condition();
        $paging = $this->uri->segment(4) ? $this->uri->segment(4) : 0;

        /* if (!empty($likeCondition['lco_code'])) {
          $condition['lco_code'] = $likeCondition['lco_code'];
          unset($likeCondition['lco_code']);
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
          lcos.*,
          totalInvoice.total_invoice - totalCollections.total_collected as due
          from lcos
          right JOIN
          (
          select invoices.invoice_lco, sum(invoices.invoice_billed_amount) as total_invoice from invoices group by invoices.invoice_lco) as totalInvoice ON totalInvoice.invoice_lco = lcos.lco_ID
          JOIN ( select sum(collection_amount) as total_collected,collection_lco from collections group by collection_lco) as totalCollections ON totalCollections.collection_lco = lcos.lco_ID
          left join stbs on lco_stb= stb_ID
          $likeConditionsSql
          $orderBy
          limit $offset,$limit"; */
        // pr($sql);
        $sql = "SELECT lcos.*,  total_billed - total_collected as due FROM lcos "
            . "LEFT JOIN "
            . "(select * from "
            . "(select sum(collection_amount) as total_collected,collection_lco from collections group by collection_lco) as totalCollections "
            . "join "
            . "(select sum(invoices.invoice_billed_amount) as total_billed,invoice_lco from invoices group by invoice_lco) as totalInvoices "
            . "ON totalCollections.collection_lco = totalInvoices.invoice_lco) as fulllco "
            . "on lco_ID = invoice_lco  "
            . " $likeConditionsSql "
            . " $orderBy "
            . " limit $offset,$limit";

        /* $countsql="select 
          count(*) as totalrw
          from lcos
          right JOIN ( select invoices.invoice_lco, sum(invoices.invoice_billed_amount) as total_invoice from invoices group by invoices.invoice_lco) as totalInvoice ON totalInvoice.invoice_lco = lcos.lco_ID JOIN ( select sum(collection_amount) as total_collected,collection_lco from collections group by collection_lco) as totalCollections ON totalCollections.collection_lco = lcos.lco_ID
          left join stbs on lco_stb= stb_ID
          $likeConditionsSql";
         */
        $countsql = "SELECT count(*) as totalrw FROM lcos "
            . "LEFT JOIN "
            . "(select * from "
            . "(select sum(collection_amount) as total_collected,collection_lco from collections group by collection_lco) as totalCollections "
            . "join "
            . "(select sum(invoices.invoice_billed_amount) as total_billed,invoice_lco from invoices group by invoice_lco) as totalInvoices "
            . "ON totalCollections.collection_lco = totalInvoices.invoice_lco) as fulllco "
            . "on lco_ID = invoice_lco  "
            . " $likeConditionsSql ";
        $allData['current_paged_list'] = $this->db->query($sql)->result_array();
        $totalrw = $this->db->query($countsql)->result_array();
        $allData['total_rows'] = $totalrw[0]['totalrw'];
        //pr($allData['total_rows']);
        /* foreach ($allData['current_paged_list'] as $key => $data) {

          $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_lco from invoices where invoice_lco = ".$data['lco_ID']." group by invoice_lco")->result_array();
          $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_lco from collections where collection_lco= ".$data['lco_ID']." group by collection_lco")->result_array();

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

    public function lco_wise_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $lco_area = $this->input->post('lco_area');
        $lco_address = $this->input->post('lco_address');
        $lco_mso = $this->input->post('lco_mso');
        $invoice_for = $this->input->post('invoice_for');
        $lco_name = $this->input->post('lco_name');
        $lco_code = $this->input->post('lco_code');

        $package = $this->packages_model->get_list();

        if (!empty($post_data)) {
            $sql = "SELECT * FROM  `lcos` WHERE 1 = 1 ";

            if (!empty($lco_area)) {
                $sql .= "AND lco_area like '%" . $lco_area . "%'";
            }

            if (!empty($lco_mso)) {
                $sql .= "AND lco_mso = '" . $lco_mso . "'";
            }
            if (!empty($lco_address)) {
                $sql .= "AND lco_address like '%" . $lco_address . "%'";
            }
            if (!empty($lco_name)) {
                $sql .= "AND lco_name like '%" . $lco_name . "%'";
            }
            if (!empty($lco_code)) {
                $sql .= "AND lco_code = '" . $lco_code . "'";
            }
            $lcos = $this->db->query($sql)->result_array();

            $lco_data = null;
            foreach ($lcos as $key => $lco) {
                $output = null;
                $output = $this->with_due_calculation($lco['lco_ID']);
                $lco_data[] = $output[0];
            }
        }

        $mso = $this->db->query("SELECT DISTINCT lco_mso FROM lcos")->result_array();
        if ($this->input->post()) {
            $this->load->view('console/lco/lco_wise_ajax_billing', array('lco_data' => $lco_data));
        } else {
            $this->load->view('console/lco/lco_wise_billing_report_tpl', array('package' => $package,'mso' => $mso));
        }
    }

    public function inactive_lco()
    {
        $condition = array('lco_status' => 0);
        $allData = $this->{$this->targetModel}->get_list($condition, false, 200000, null);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/lco/lco_listing_tpl', array('lco_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function all_lco()
    {
        $allData = $this->{$this->targetModel}->get_list(null, false, 200000, null);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/lco/lco_listing_tpl', array('lco_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function active_lco()
    {
        $condition = array('lco_status' => 1);
        $allData = $this->{$this->targetModel}->get_list($condition, false, 200000, null);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->channels_model->get_list_for_dropdown('channel_name');
        $this->load->view('console/lco/lco_listing_tpl', array('lco_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    /* public function package_lco() {
      $lco_package = null;
      $packages = $this->packages_model->get_list_for_dropdown('package_name');

      if ($this->input->get('package') != 'Unset') {
      $packagename = $this->input->get('package');

      $targetpackage = $this->packages_model->get_list(array('package_ID' => $packagename));

      $condition = array('lco_status' => 1, 'lco_package' => '["' . $targetpackage[0]['package_ID'] . '"]');
      $allData = $this->{$this->targetModel}->get_list($condition, false, 200000, null);
      } else {
      $packagelist = array();
      $condition = array('lco_status' => 1, 'lco_package' => '');
      foreach ($packages as $package_ID => $pack) {
      $packagelist[] = "'[\"$package_ID\"]'";
      }
      $packagelist = implode(',', $packagelist);

      $sql = $this->db->query('select * from lcos where lco_package not in(' . $packagelist . ')');
      $allData = $sql->result_array();
      }
      $adons = $this->channels_model->get_list_for_dropdown('channel_name');
      $this->load->view('console/lco/lco_listing_tpl', array('lco_data' => $allData, 'packages' => $packages, 'adons' => $adons));
      } */

    public function live_portal_compare()
    {
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

        $this->render($output, 'console/lco/live_portal_compare_tpl');
    }

    public function box_compare()
    {

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

                if (method_exists('lco', $thefunction))
                    $output = $this->{$thefunction}();
                else
                    $output['error'] = " MSO " . $this->input->post('filter') . " is not active in your account. please contact to support";
            }
        }
        $output['filter'] = $filter;

        $this->render($output, 'console/lco/box_compare_tpl');
    }

    public function lco_import()
    {
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
        $this->render($data, 'console/lco/lco_import_tpl');
    }

    private function media_neuclious($file_name)
    {

        $file = fopen(ROOTPATH . 'uploads/' . NODE . '/' . $file_name, "r");
        $csvData = null;
        $csvSTB = array();
        while (($emapData = fgetcsv($file, 10000, ",")) !== false) {
            //      $csvData[]= $emapData;
            if (empty($emapData[2]) && empty($emapData[3]) && empty($emapData[4]))
                continue;
            if (strtoupper($emapData[2]) == 'SUBSCRIBERNAME')
                continue;
            $csvlcoData['lco_code'] = strtoupper($emapData[1]);
            $csvlcoData['lco_name'] = strtoupper(str_ireplace("  ", " ", $emapData[2]));
            $csvlcoData['lco_contact'] = $emapData[3];
            $csvlcoData['stb_no'] = strtoupper(str_ireplace("'", "", $emapData[4]));
            $csvlcoData['vc_no'] = strtoupper(str_ireplace("'", "", $emapData[5]));
            $csvlcoData['lco_package'] = $emapData[6];
            $csvlcoData['lco_address'] = $emapData[7];
            $csvlcoData['lco_activation_date'] = date('Y-m-d', strtotime($emapData[8]));
            //  $csvSTB[] = strtolower(str_ireplace("'","",$emapData[5]));
            $csvData[] = $csvlcoData;
        }
        $liniercsvData = null;
        foreach ($csvData as $csvlcoData) {
            $linierData[] = $csvlcoData[$this->input->post('filter')];
        }

        fclose($file);


        $query = "SELECT * from lcos where lco_status	 = 1  ";
        $rs = $this->db->query($query);
        $consolelcoData = $rs->result_array();

        $linierconsoleData = array();
        foreach ($consolelcoData as $consolelco) {
            $linierconsoleData[] = strtoupper(trim($consolelco[$this->input->post('filter')]));
        }
        //pr($linierData,1);
        $lcos_not_in_portal = array_diff($linierData, $linierconsoleData);
        $lcos_not_in_csv = array_diff($linierconsoleData, $linierData);

        //pr($lcos_not_in_portal);
        //pr($lcos_not_in_csv,1);

        return array('notincsv' => $lcos_not_in_csv, 'notinconsole' => $lcos_not_in_portal, 'choosenfilter' => $this->input->post('filter'));
    }

    private function manthan_box_compare_data()
    {


        $uploadedData = excelToArray($_FILES['userfile']['tmp_name']);

        foreach ($uploadedData as $key => $val) :
            $uploadedSTB[$val['FIRST_NAME']] = strtoupper(str_ireplace("'", "", $val['STB']));
        endforeach;
        #pr($uploadedSTB,1);
        $query = "SELECT * from lcos where lco_status	 = 1  ";
        $rs = $this->db->query($query);
        $consolelcoData = $rs->result_array();

        foreach ($consolelcoData as $key => $val) :
            $consoleSTB[$val['first_name']] = $val['stb_no'];
        endforeach;

        $extraSTB = array_diff($uploadedSTB, $consoleSTB);

        $lcos_not_in_portal = array_diff($extraSTB, $consoleSTB);
        $lcos_not_in_sheet = array_diff($extraSTB, $uploadedSTB);
        /* echo 'lcos_not_in_portal:<br>';
          pr($lcos_not_in_portal);
          echo 'lcos_not_in_sheet:<br>';
          pr( $lcos_not_in_sheet);
          #die('endpoint');
         * 
         */


        return array('notincsv' => $lcos_not_in_sheet, 'notinconsole' => $lcos_not_in_portal);
    }

    /**
     * add detail
     */
    public function add_detail()
    {
        $this->page_config['use_dropdown_columns_options']['lco_stb'] = $this->stb('SPARE');

        $postedData = $this->input->post();
        $stb = $this->input->post();
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();

            /*             * **********channel data************** */

            $channel_sql = "SELECT * FROM `channels`  WHERE channel_type !='FTA'";
            $package_sql = "SELECT * FROM `packages`";

            $paychannel = $this->db->query($channel_sql)->result_array();
            $packages = $this->db->query($package_sql)->result_array();

            if ($packages) {
                foreach ($packages as $key => $row) {
                    $data['packages'][] = $row;
                }
            }

            if ($paychannel) {
                foreach ($paychannel as $key => $row) {
                    $data['paychannels'][] = $row;
                }
            }
            $this->page_config['channelData'] = $data;

            /*             * **********channel data****** */
            echo $this->generate_form_view($entryData[0], $this->page_config, 'add_edit_tpl');
        } else {
            if ($postedData) {
                /** status* */
                $config = $this->auto_fieldtype_detect(null);
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
                //$this->change_stb_status(null, $postedData['lco_stb']);
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);
                if (function_exists('trigger_sms')) {
                    trigger_sms('welcome_cable', $postedData);
                }
                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    // sftp://root@server2.olteho.com/home/lezrd/public_html/modules/cables/views/console/lco
    /**
     * edit detail
     */
    public function edit_detail()
    {

        $postedData = $this->input->post();

        $config = $this->auto_fieldtype_detect(null);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {

            /*             * **********channel data************** */

            $channel_sql = "SELECT * FROM `channels`  WHERE channel_type !='FTA'";
            $package_sql = "SELECT * FROM `packages`";

            $paychannel = $this->db->query($channel_sql)->result_array();
            $packages = $this->db->query($package_sql)->result_array();

            if ($packages) {
                foreach ($packages as $key => $row) {
                    $data['packages'][] = $row;
                }
            }

            if ($paychannel) {
                foreach ($paychannel as $key => $row) {

                    $data['paychannels'][] = $row;
                }
            }
            $this->page_config['channelData'] = $data;

            /*             * **********channel data****** */
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));


            $this->page_config['use_dropdown_columns_options']['lco_stb'] = $this->stb('SPARE') + array($entryData2[0]['lco_stb'] => $entryData2[0]['stb_no'] . '(' . $entryData2[0]['stb_vc'] . ')');
            $entryData1 = $this->{$this->targetModel}->get_field_list();

            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);

            echo $this->generate_form_view($entryData, $this->page_config, 'add_edit_tpl');
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

                //$this->change_stb_status($entryData2[0]['lco_stb'], $postedData['lco_stb']);
                $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
                echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

    /**
     * delete
     */
    public function delete()
    {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(null);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['selectedItem'])) {
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['selectedItem']), true);
        }

        if (isset($postedData['entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['entry'])));
            $this->change_stb_status($entryData2[0]['lco_stb'], null);
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['entry']));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function change_stb_status($old, $new)
    {
        if (!empty($old))
            $this->db->query("UPDATE `stbs` SET `stb_type` = 'SPARE' WHERE `stbs`.`stb_no` = '$old';");
        if (!empty($new))
            $this->db->query("UPDATE `stbs` SET `stb_type` = 'ASSIGNED' WHERE `stbs`.`stb_no` = '$new';");
    }

    public function stb($type = null)
    {
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

    public function print_statement()
    {
        $lco = $this->lcos_model->get_list(array('lco_ID' => $this->uri->segment(4)));
        $statement_for = $this->uri->segment(5);

        $data['lcoData'] = $lco[0];
        if (!empty($statement_for)) {
            $data['invoices'] = $this->invoices_model->get_list(array('invoice_for' => $statement_for, 'invoice_lco' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_for' => $statement_for, 'collection_lco' => $this->uri->segment(4)));
        } else {
            $data['invoices'] = $this->invoices_model->get_list(array('invoice_lco' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_lco' => $this->uri->segment(4)));
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
        $data['statement_for'] = $value['$value'];
        //pr($this->lcos_model->account_statement($lco,$invoice_date));

        $this->load->view('console/lco/print_template_tpl', $data);
    }

    public function print_due_statement()
    {
        $collection_ID = $this->uri->segment(4);
        $collection_data = $this->collections_model->get_list(array('collection_ID' => $collection_ID));
        $data = $this->lcos_model->account_statement($collection_data[0]['lco_ID'], $collection_data[0]['collection_date']);
        $this->load->view('console/lco/print_template_due_tpl', array('collection' => $collection_data[0], 'data' => $data, 'date' => $collection_data[0]['collection_date']));
    }

    public function print_invoice_statement()
    {
        $invoice_ID = $this->uri->segment(4);
        $invoice_data = $this->invoices_model->get_list(array('invoice_ID' => $invoice_ID));
        $data = $this->lcos_model->account_statement($invoice_data[0]['invoice_lco'], $invoice_data[0]['invoice_date']);
        $this->load->view('console/lco/print_template_invoice_tpl', array('invoice' => $invoice_data[0], 'data' => $data, 'date' => $invoice_data[0]['invoice_date'], 'collection_data' => $collection_data));
    }

    public function extra_bill($param)
    {
        pr('coming soon');
    }

    public function billing()
    {
        error_reporting(1);


        if ($this->input->post()) {
            $generated = $this->input->post();
            //pr($generated,1);
            $data = $generated;
            unset($data['print']);
            if ($data['invoice_adjustment'] != 0.00) {
                /*                 * ************************* */
                $billingData = null;
                $total = 0;
                $billingData[] = array(
                    'name' => 'Adjustment',
                    'price' => (float) $data['invoice_adjustment']
                );
                $total += (float) $data['invoice_adjustment'];


                $taxtotal = 0.00;
                $invoice_meta['billings'] = $billingData;
                $invoice_meta['total'] = $taxtotal + $total;
                /*                 * **************************** */

                $invoice['invoice_lco'] = $data['collection_lco'];
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
                $collection['collection_lco'] = $data['collection_lco'];
                $collection['collection_note'] = $data['collection_note'];
                $collection['collection_amount'] = $data['collection_amount'];
                $collection['collection_date'] = $data['collection_date'];
                $collection['collection_for'] = $data['collection_for'];
                $collectionId = $this->collections_model->insert_data($collection);

                if (isset($generated['print'])) {
                    redirect(console_url('lco/print_due_statement/' . $data['collection_lco'] . '/' . $data['collection_date']));
                }
                // redirect(console_url('collection/print_receipt/' . $collectionId));
            }
            redirect(console_url('lco/billing/' . $data['collection_lco']));
        } else {
            $lcodata = $this->lcos_model->get_list(array('lco_ID' => $this->uri->segment(4)));


            $data['invoices'] = $this->invoices_model->get_list(array('invoice_lco' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_lco' => $this->uri->segment(4)));

            $sheetData = null;
            foreach ($data['invoices'] as $value) {

                $k = count($sheetData[strtotime($value['invoice_date'])]);
                $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
                $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/lco/print_invoice_statement/' . $this->uri->segment(4) . '/' . $value['invoice_date'] . '">' . $value['invoice_for'] . ' </a>';
                $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
                $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
                $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
            }
            ksort($sheetData);
            foreach ($data['collections'] as $value) { //pr($value);
                $k = count($sheetData[strtotime($value['collection_date'])]);
                $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
                $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/lco/print_due_statement/' . $this->uri->segment(4) . '/' . $value['collection_date'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
                $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
                $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
                $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
            }
            ksort($sheetData);
            $data['sheetData'] = $sheetData;
            $data['lcodata'] = $lcodata[0];


            $lco_package = json_decode($data['lcodata']['lco_package'], true);

            $invoice_meta['billings'] = $lco_package;
            $invoice_meta['total'] = $lco_package['total'];
            $invoice['invoice_billed_amount'] = $lco_package['total'];
            $invoice['invoice_tax_amount'] = $lco_package['total'] / 1.18;
            $invoice['invoice_for'] = "CableTv Billing";
            $invoice['invoice_meta'] = json_encode($invoice_meta);


            $data['billingData'] = $lco_package['items'];
            $data['total'] = $invoice['invoice_billed_amount'];
            $data['sub_total'] = $lco_package['subtotal'];

            //pr($data);
            $this->render($data, 'billing_tpl');
        }
    }

    public function create_bill()
    {
        $segment = $this->uri->segment_array();
        $data = $this->input->post();
        //pr($data,1);
        $this->generate_bill($data['lco_ID'], $data['invoice_date']);
        redirect('/console/lco/billing/' . $data['lco_ID'], $data['invoice_date']);
    }

    public function generate_bill($lco_id = null, $date = null, $return = false)
    {
        $invoice_date = $this->input->post('invoice_date');

        $statement_for = "CableTv Billing -" . Date('F-y', strtotime($invoice_date));

        //$lco_id = implode(',', $lco_id);
        //pr($statement_for,1);

        if (empty($lco_id))
            return;
        //if (empty($lco_id))
        //  $lcos = $this->db->query('select * from lcos where lco_status = 1')->result_array();
        //else
        $lcos = $this->db->query("select * from lcos where lco_ID in($lco_id)")->result_array();
        //$taxes = $this->taxes_model->get_list();
        foreach ($lcos as $data) {
            $already_entry = $this->db->query("select * from invoices where invoice_date='$invoice_date' and invoice_for = '$statement_for' and invoice_lco = " . $data['lco_ID'])->result_array();
            // pr($data,1);
            if (!empty($already_entry))
                continue;
            $invoice['invoice_lco'] = $data['lco_ID'];
            // pr( $invoice['invoice_lco'],1);
            $invoice['invoice_date'] = $invoice_date;
            $total = 0.00;
            $billingData = null;
            if ($data['lco_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-') . $data['lco_due_date_of_month'];
            }
            if (empty(json_decode($data['lco_package'], true))) {

                continue;
            }

            $lco_package = json_decode($data['lco_package'], true);
            $invoice_meta['billings'] = $lco_package;
            $invoice_meta['total'] = $lco_package['total'];
            $invoice['invoice_billed_amount'] = $lco_package['total'];
            $invoice['invoice_tax_amount'] = $lco_package['total'] - $lco_package['total'] / 1.18;
            $invoice['invoice_for'] = $statement_for;
            $invoice['invoice_meta'] = json_encode($invoice_meta);

            if ($return) {
                return $invoice;
            } else {
                if (!empty($invoice['invoice_billed_amount'])) {
                    $this->invoices_model->insert_data($invoice);
                }
            }
        }
    }

    public function due_list()
    {
        $lcos_data = $this->with_due_calculation();
        $this->render(array("lcos" => $lcos_data), 'due_list_tpl');
    }

    public function array_sort_by_column(&$arr, $col, $dir)
    {
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

    private function with_due_calculation($lco_id = null)
    {
        if (empty($lco_id))
            $lcos_data = $this->db->query('select * from lcos  left join stbs on lco_stb = stb_ID')->result_array();
        else
            $lcos_data = $this->db->query('select * from lcos  left join stbs on lco_stb = stb_ID where lco_ID=' . $lco_id . '')->result_array();
        $lcos_in = array();
        foreach ($lcos_data as $key => $value) {
            $lcos_in[] = $value['lco_ID'];
        }
        $lcos_in = implode(',', $lcos_in);

        $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_lco from invoices where invoice_lco in ($lcos_in) group by invoice_lco")->result_array();
        $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_lco from collections where collection_lco in ($lcos_in) group by collection_lco")->result_array();
        foreach ($invoices as $key => $value) {
            $lcos[$value['invoice_lco']]['total_invoice'] = $value['total_invoice'];
        }
        foreach ($collections as $key => $value) {
            $lcos[$value['collection_lco']]['total_collected'] = $value['total_collected'];
        }
        foreach ($lcos_data as $key => $value) {
            $lcos_data[$key]['total_collected'] = (float) $lcos[$value['lco_ID']]['total_collected'];
            $lcos_data[$key]['total_invoice'] = (float) $lcos[$value['lco_ID']]['total_invoice'];
            $lcos_data[$key]['due'] = (float) $lcos[$value['lco_ID']]['total_invoice'] - (float) $lcos[$value['lco_ID']]['total_collected'];
        }
        //pr($lcos_data);

        return $lcos_data;
    }

    public function billing_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $lco_area = $this->input->post('lco_area');
        $lco_mso = $this->input->post('lco_mso');
        $lco_address = $this->input->post('lco_address');
        $package_name = $this->input->post('package_name');
        $invoice_for = $this->input->post('invoice_for');
        $lco_name = $this->input->post('lco_name');
        $lco_code = $this->input->post('lco_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `invoices` join `lcos` on invoices.invoice_lco=lcos.lco_ID WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND invoice_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND invoice_date<='" . $period_end . "'";
            }
            if (!empty($package_name)) {
                $package_name = '"' . $package_name . '"';
                $sql .= "AND lco_package='[" . $package_name . "]'";
            }
            if (!empty($invoice_for)) {
                $sql .= "AND invoice_for like '%" . $invoice_for . "%'";
            }
            if (!empty($lco_area)) {
                $sql .= "AND lco_area like '%" . $lco_area . "%'";
            }
            if (!empty($lco_mso)) {
                $sql .= "AND lco_mso = '" . $lco_mso . "'";
            }
            if (!empty($lco_address)) {
                $sql .= "AND lco_address like '%" . $lco_address . "%'";
            }
            if (!empty($lco_name)) {
                $sql .= "AND lco_name like '%" . $lco_name . "%'";
            }
            if (!empty($lco_code)) {
                $sql .= "AND lco_code= '" . $lco_code . "'";
            }
            # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
            $invoices = $this->db->query($sql)->result_array();
            //echo $sql;
            //pr($invoices,1);
            $lco_data = null;
            foreach ($invoices as $key => $invoice) {
                $lco_data[$key]['lco_name'] = $invoice['lco_name'];
                $lco_data[$key]['lco_code'] = $invoice['lco_code'];
                $lco_data[$key]['lco_address'] = $invoice['lco_address'];
                $lco_data[$key]['lco_area'] = $invoice['lco_area'];
                $lco_data[$key]['invoice_date'] = $invoice['invoice_date'];
                $lco_data[$key]['invoice_for'] = $invoice['invoice_for'];
                $lco_data[$key]['invoice_billed_amount'] = $invoice['invoice_billed_amount'];
                $lco_data[$key]['invoice_tax_amount'] = $invoice['invoice_tax_amount'];
            }
            //    pr($lco_data,1);
        }

        $package = $this->packages_model->get_list();
        $mso = $this->db->query("SELECT DISTINCT lco_mso FROM lcos")->result_array();
        if ($this->input->post()) {
            $this->load->view('console/lco/billing_ajax_report_tpl', array('lco_data' => $lco_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/lco/billing_report_tpl', array('lco_data' => $lco_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package, 'mso' => $mso));
        }
    }


    public function lco_stb_report()
    {
        $post_data = $this->input->post();
        // pr($post_data);
        // $period_start = $this->input->post('start');
        // $period_end = $this->input->post('end');
        $stb_no = $this->input->post('stb_no');
        $lco_code = $this->input->post('lco_code');
        $stb_vc = $this->input->post('stb_vc');
        $stb_type = $this->input->post('stb_type');
        $stb_status = $this->input->post('stb_status');
      
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `stbs` join lcos on lcos.lco_ID = stbs.stb_lco_id WHERE 1 = 1 ";
            
            if (!empty($lco_code)) {
                $sql .= "AND lco_code = '" . $lco_code . "'";
            }
            if (!empty($stb_no)) {
                $sql .= "AND stb_no = '" . $stb_no . "'";
            }
            if (!empty($stb_vc)) {
                $sql .= "AND stb_vc = '" . $stb_vc . "'";
            }
            if (!empty($stb_type)) {
                $sql .= "AND stb_type = '" . $stb_type . "'";
            }
            if (!empty($stb_status)) {
                $sql .= "AND stb_status = '" . $stb_status . "'";
            }
           
            $stbs = $this->db->query($sql)->result_array();
            // echo $sql;
        //    pr($stbs);
            $lco_data = null;
            foreach ($stbs as $key => $stb) {
                $lco_data[$key]['stb_no'] = $stb['stb_no'];
                $lco_data[$key]['lco_code'] = $stb['lco_code'];
                $lco_data[$key]['stb_vc'] = $stb['stb_vc'];
                $lco_data[$key]['stb_type'] = $stb['stb_type'];
                $lco_data[$key]['stb_status'] = $stb['stb_status'];
                $lco_data[$key]['lco_name'] = $stb['lco_name'];
                $lco_data[$key]['lco_area'] = $stb['lco_area'];
                // $lco_data[$key]['stb_status_count'] = $stb['stb_status_count'];
                // $lco_data[$key]['stb_type_count'] = $stb['stb_type_count'];
                
             
            }
        }

        //$package = $this->packages_model->get_list();
        $type = $this->db->query("SELECT DISTINCT(stb_type) FROM stbs")->result_array();
        $status = $this->db->query("SELECT DISTINCT(stb_status) FROM stbs")->result_array();
        $code = $this->db->query("SELECT DISTINCT(lco_code) FROM lcos")->result_array();
        if ($this->input->post()) {
            $this->load->view('console/lco/lco_stb_ajax_report_tpl', array('lco_data' => $lco_data, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/lco/lco_stb_report_tpl', array('lco_data' => $lco_data, 'type' => $type, 'status' => $status,'code' => $code));
        }
    }


    public function collection_report()
    {

        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $lco_area = $this->input->post('lco_area');
        $lco_mso = $this->input->post('lco_mso');
        $lco_address = $this->input->post('lco_address');
        $collection_collected_by = $this->input->post('collection_collected_by');
        $collection_for = $this->input->post('collection_for');
        $lco_name = $this->input->post('lco_name');
        $lco_code = $this->input->post('lco_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `collections` "
                . "join `lcos` on collections.collection_lco=lcos.lco_ID "
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
            if (!empty($lco_area)) {
                $sql .= "AND lco_area like '%" . $lco_area . "%'";
            }
            if (!empty($lco_mso)) {
                $sql .= "AND lco_mso = '" . $lco_mso . "'";
            }
            if (!empty($lco_address)) {
                $sql .= "AND lco_address like '%" . $lco_address . "%'";
            }
            if (!empty($lco_name)) {
                $sql .= "AND lco_name like '%" . $lco_name . "%'";
            }
            if (!empty($lco_code)) {
                $sql .= "AND lco_code= '" . $lco_code . "'";
            }
            # $collections = $this->db->query("SELECT * FROM `collections` WHERE collection_date >='" . $period_start . "' AND collection_date<='" . $period_end . "'")->result_array();
            $collections = $this->db->query($sql)->result_array();
            //echo $sql;
            //pr($collections,1);
            $lco_data = null;
            foreach ($collections as $key => $collection) {
                $lco_data[$key]['lco_name'] = $collection['lco_name'];
                $lco_data[$key]['lco_code'] = $collection['lco_code'];
                $lco_data[$key]['lco_address'] = $collection['lco_address'];
                $lco_data[$key]['lco_area'] = $collection['lco_area'];
                $lco_data[$key]['collection_date'] = $collection['collection_date'];
                $lco_data[$key]['collection_for'] = $collection['collection_for'];
                $lco_data[$key]['collection_amount'] = $collection['collection_amount'];
                $lco_data[$key]['collection_collected_by'] = $collection['collection_collected_by'];
            }
            //    pr($lco_data,1);
        }

        $package = $this->packages_model->get_list();
        $mso = $this->db->query("SELECT DISTINCT lco_mso FROM lcos")->result_array();

        if ($this->input->post()) {
            $this->load->view('console/lco/collection_ajax_report_tpl', array('lco_data' => $lco_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/lco/collection_report_tpl', array('lco_data' => $lco_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package, 'mso' => $mso));
        }
    }

    public function not_collected_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $lco_area = $this->input->post('lco_area');
        $lco_address = $this->input->post('lco_address');
        $lco_name = $this->input->post('lco_name');
        $lco_code = $this->input->post('lco_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql1 = "SELECT lco_ID FROM `collections` "
                . "join `lcos` on collections.collection_lco=lcos.lco_ID "
                . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql1 .= "AND collection_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql1 .= "AND collection_date<='" . $period_end . "'";
            }


            /*             * ***************** */
            $sql = "SELECT * from `lcos`"
                . "WHERE lco_ID not in ($sql1) ";
            if (!empty($lco_area)) {
                $sql .= "AND lco_area like '%" . $lco_area . "%'";
            }
            if (!empty($lco_address)) {
                $sql .= "AND lco_address like '%" . $lco_address . "%'";
            }
            if (!empty($lco_name)) {
                $sql .= "AND lco_name like '%" . $lco_name . "%'";
            }
            if (!empty($lco_code)) {
                $sql .= "AND lco_code= '" . $lco_code . "'";
            }

            # $collections = $this->db->query("SELECT * FROM `collections` WHERE collection_date >='" . $period_start . "' AND collection_date<='" . $period_end . "'")->result_array();
            $collections = $this->db->query($sql)->result_array();

            //  pr($collections,1);
            $lco_data = null;
            foreach ($collections as $key => $collection) {
                $lco_data[$key]['lco_ID'] = $collection['lco_ID'];
                $lco_data[$key]['lco_name'] = $collection['lco_name'];
                $lco_data[$key]['lco_code'] = $collection['lco_code'];
                $lco_data[$key]['lco_address'] = $collection['lco_address'];
                $lco_data[$key]['lco_area'] = $collection['lco_area'];
                $output = $this->with_due_calculation($collection['lco_ID']);
                $lco_data[$key]['due'] = $output[0]['due'];
            }
            // pr($lco_data,1);
        }

        $package = $this->packages_model->get_list();
        if ($this->input->post()) {
            $this->load->view('console/lco/not_collected_ajax_report_tpl', array('lco_data' => $lco_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/lco/not_collected_report_tpl', array('lco_data' => $lco_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package));
        }
    }

    public function items()
    {
        pr($this->input->post());
    }

    public function get_collection_for()
    {
        $collection_for = $this->invoices_model->get_list(array('invoice_lco' => $this->input->post('lco_id')));
        foreach ($collection_for as $key => $value) {
            echo '<option value = "' . $value['invoice_for'] . '">';
        }
    }

    private function renewal($lco_ID)
    {
        $data = $this->db->query("select * from lcos 
		join packages on 
		lcos.lco_package = packages.package_ID
		where lco_ID = $lco_ID
		")->result_array();
        foreach ($data as $k => $v) {
            $data['lco_renewal_date'] = date('Y-m-d', strtotime('+' . $v['package_subscription_days'] . ' days', strtotime($v['lco_last_renew_date'])));
        }
        return $data;
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
        //     $this->load->view('console/lco/table_tpl', $error);
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

                    $pack = $this->db->query("select * from packages  where package_name='" . $value['lco_package'] . "'")->result_array();

                    $string_price = '"' . $value['lco_package'] . '"';
                    $pack_price = (int) filter_var($string_price, FILTER_SANITIZE_NUMBER_INT);

                    $lco_package =  '{"items":[{"name":"' . $pack[0]['package_name'] . '","price":' . $pack_price . '}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';

                    if (empty($pack)) {
                        // echo 'empty pack';
                        $this->db->query("INSERT INTO `packages`(`package_name`, package_rate) VALUES ('" . $value['lco_package'] . "','" . $pack_price . "')");
                        $pack_data = $this->db->query("select * from packages where package_name='" . $value['lco_package'] . "'")->result_array();
                        $value['lco_package'] = '{"items":[{"name":"' . $pack_data[0]['package_name'] . '","price":"' . $pack_data[0]['package_rate'] . '"}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';
                    } else {
                        $value['lco_package'] = $lco_package;
                    }

                    $stb = $this->db->query("select * from stbs  where stb_no='" . $value['lco_stb'] . "'")->result_array();

                    if (empty($stb)) {
                        // echo 'empty stb';
                        $this->db->query("INSERT INTO `stbs`(`stb_no`) VALUES ('" . $value['lco_stb'] . "')");
                        $stb_data = $this->db->query("select * from stbs where stb_no='" . $value['lco_stb'] . "'")->result_array();
                        // pr($stb_data);
                        $value['lco_stb'] = $stb_data[0]['stb_no'];
                    } else {
                        $value['lco_stb'] = $stb[0]['stb_no'];
                    }

                    // pr($value);
                    // die();

                    $duplicate_chk = $this->db->query("SELECT * FROM `lcos`")->result_array();

                    // if ($duplicate_chk[0]['lco_stb'] === $value['lco_stb']) {
                    //     echo "Duplicate Entry";
                    // } else {
                    $sql = "INSERT INTO lcos"
                        . "(lco_code,"
                        . "lco_name,"
                        . "lco_address,"
                        . "lco_contact,"
                        . "lco_stb,"
                        . "lco_activation_date,"
                        . "lco_package,"
                        . "lco_assigned_to,"
                        . "lco_area,"
                        . "lco_status,"
                        . "lco_last_renew_date,"
                        . "lco_deactivation_date,"
                        . "lco_mso,"
                        . "lco_mso_account,"
                        . "lco_due_date_of_month) "

                        . "VALUES('" . $value['lco_code'] . "','" . $value['lco_name'] . "','" . $value['lco_address'] . "','" . $value['lco_contact'] . "','" . $value['lco_stb'] . "','','" . $value['lco_package'] . "','','" . $value['lco_area'] . "','1','','','" . $value['lco_mso'] . "','','')";
                    $this->db->query($sql);
                    // print_r($sql);
                    // }
                }

                redirect('console/lco');
            } else {
                print_r($errors[0]);
            }
        }

        // }
    }

    /** which have vc */
    public function do_upload_vc()
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
        //     $this->load->view('console/lco/table_tpl', $error);
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

                    $pack = $this->db->query("select * from packages  where package_name='" . $value['lco_package'] . "'")->result_array();

                    $string_price = '"' . $value['lco_package'] . '"';
                    $pack_price = (int) filter_var($string_price, FILTER_SANITIZE_NUMBER_INT);

                    $lco_package =  '{"items":[{"name":"' . $pack[0]['package_name'] . '","price":' . $pack_price . '}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';

                    if (empty($pack)) {
                        echo 'empty pack';
                        $this->db->query("INSERT INTO `packages`(`package_name`, package_rate) VALUES ('" . $value['lco_package'] . "','" . $pack_price . "')");
                        $pack_data = $this->db->query("select * from packages where package_name='" . $value['lco_package'] . "'")->result_array();
                        $value['lco_package'] = '{"items":[{"name":"' . $pack_data[0]['package_name'] . '","price":"' . $pack_data[0]['package_rate'] . '"}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';
                    } else {
                        $value['lco_package'] = $lco_package;
                    }

                    $stb = $this->db->query("select * from stbs  where stb_no='" . $value['lco_stb'] . "' OR stb_vc='" . $value['lco_vc'] . "' ")->result_array();

                    if (empty($stb)) {
                        echo 'empty stb';
                        $this->db->query("INSERT INTO `stbs`(`stb_no`,`stb_vc`) VALUES ('" . $value['lco_stb'] . "','" . $value['lco_vc'] . "')");
                        $stb_data = $this->db->query("select * from stbs where stb_no='" . $value['lco_stb'] . "' OR stb_vc='" . $value['lco_vc'] . "' ")->result_array();
                        pr($stb_data);
                        $value['lco_stb'] = $stb_data[0]['stb_no'] . "(" . $stb_data[0]['stb_vc'] . ")";
                    } else {
                        $value['lco_stb'] = $stb[0]['stb_no'] . "(" . $stb[0]['stb_vc'] . ")";
                    }

                    // pr($value);
                    // die();

                    $duplicate_chk = $this->db->query("SELECT * FROM `lcos`")->result_array();

                    // if ($duplicate_chk[0]['lco_stb'] === $value['lco_stb']) {
                    //     echo "Duplicate Entry";
                    // } else {
                    $sql = "INSERT INTO lcos"
                        . "(lco_code,"
                        . "lco_name,"
                        . "lco_address,"
                        . "lco_contact,"
                        . "lco_stb,"
                        . "lco_activation_date,"
                        . "lco_package,"
                        . "lco_assigned_to,"
                        . "lco_area,"
                        . "lco_status,"
                        . "lco_last_renew_date,"
                        . "lco_deactivation_date,"
                        . "lco_mso,"
                        . "lco_mso_account,"
                        . "lco_due_date_of_month) "

                        . "VALUES('" . $value['lco_code'] . "','" . $value['lco_name'] . "','" . $value['lco_address'] . "','" . $value['lco_contact'] . "','" . $value['lco_stb'] . "','','" . $value['lco_package'] . "','','" . $value['lco_area'] . "','1','','','" . $value['lco_mso'] . "','','')";
                    $this->db->query($sql);
                    // print_r($sql);
                    // }
                }

                redirect('console/lco');
            } else {
                print_r($errors[0]);
            }
        }

        // }
    }

    public function import_lco()
    {

        $this->render();
    }

    public function fastbill()
    {
        $lcodata = $this->lcos_model->get_list(array('lco_ID' => $this->uri->segment(4)));

        $data['invoices'] = $this->invoices_model->get_list(array('invoice_lco' => $this->uri->segment(4)));
        $data['collections'] = $this->collections_model->get_list(array('collection_lco' => $this->uri->segment(4)));
        $sheetData = null;
        foreach ($data['invoices'] as $value) {
            // pr($value);
            $k = count($sheetData[strtotime($value['invoice_date'])]);

            $sheetData[strtotime($value['invoice_date'])][$k]['ID'] = $value['invoice_ID'];
            $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
            $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/lco/print_invoice_statement/' . $value['invoice_ID'] . '">' . $value['invoice_for'] . ' </a>';
            $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
            $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
            $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
        }
        ksort($sheetData);
        foreach ($data['collections'] as $value) { //pr($value);
            $k = count($sheetData[strtotime($value['collection_date'])]);
            $sheetData[strtotime($value['collection_date'])][$k]['ID'] = $value['collection_ID'];
            $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
            $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/lco/print_due_statement/' . $value['collection_ID'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
            $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
            $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
            $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
        }
        ksort($sheetData);
        $data['sheetData'] = $sheetData;
        $data['lcodata'] = $lcodata[0];

        $lco_package = json_decode($data['lcodata']['lco_package'], true);

        $invoice_meta['billings'] = $lco_package;
        $invoice_meta['total'] = $lco_package['total'];
        $invoice['invoice_billed_amount'] = $lco_package['total'];
        $invoice['invoice_tax_amount'] = $lco_package['total'] / 1.18;
        $invoice['invoice_for'] = "CableTv Billing";
        $invoice['invoice_meta'] = json_encode($invoice_meta);
        $data['billingData'] = $lco_package['items'];
        $data['total'] = $invoice['invoice_billed_amount'];
        $data['sub_total'] = $lco_package['subtotal'];


        $taxes = $this->db->query("SELECT SUM(tax_value) as total_tax FROM `taxes`")->result_array();
        $data['total_tax_rate'] =  isset($taxes[0]['total_tax']) ? floatval($taxes[0]['total_tax']) : 0;
        if (!empty($taxes)) {
            $taxtotal = $data['sub_total'] * $data['total_tax_rate'] / 100;
            $data['gst'] = $taxtotal;
        } else {
            $data['gst'] = 0;
        }

        // pr($data);
        $this->render($data, 'fastbill_tpl');
    }
    public function quick_bill()
    {
        $data = $this->input->post();
        $invoice['invoice_lco'] = $data['invoice_lco'];
        $invoice['invoice_date'] = $data['invoice_date'];
        $invoice['invoice_due_date'] = $data['invoice_due_date'];
        $total = 0.00;
        $billingData = null;
        $itemnames = array();
        foreach ($data['item'] as $k => $v) {
            $itemnames[] = array(
                'name' => $data['item'][$k],
                'price' => (float) $data['sum'][$k]
            );
            $total += (float) (float) $data['sum'][$k];
        }

        $taxes = $this->taxes_model->get_list();
        // pr($taxes);
        if (!empty($taxes)) {
            $taxtotal = $total * 18 / 100;
        } else {
            $taxtotal = 0;
        }

        $billingData['billings']['items'] = $itemnames;
        $billingData['billings']['subtotal'] = $total;
        $billingData['billings']['discount'] = $data['discount'];
        $billingData['billings']['total'] = round($taxtotal + $total) - floatval($data['discount']);

        $invoice['invoice_billed_amount'] = $billingData['billings']['total'];
        $invoice['invoice_tax_amount'] = $taxtotal;
        $invoice['invoice_meta'] = json_encode($billingData);
        if (isset($data['package'])) {
            $this->lcos_model->update_data(array("lco_package" => json_encode($billingData['billings'])), array('lco_ID' => $data['invoice_lco']));
        } else {
            if (!isset($data['otherbill'])) {
                $invoice['invoice_for'] = 'Bill for ' . date('F-y', strtotime($invoice['invoice_date']));
                $this->lcos_model->update_data(array("lco_package" => json_encode($billingData['billings'])), array('lco_ID' => $data['invoice_lco']));
            } else {
                $invoice['invoice_for'] = 'Bill for items ';
            }
            $this->invoices_model->insert_data($invoice);
        }
        redirect('/console/lco/fastbill/' . $data['invoice_lco']);
    }

    public function generate_bill_all()
    {

        $posted = $this->input->post();

        if (!empty($posted)) {
            $lco = $this->lcos_model->get_list(array("lco_status" => 1));
            $invoice = array();
            $taxes = $this->db->query("SELECT SUM(tax_value) as total_tax FROM `taxes`")->result_array();
            $total_tax_rate = 0;
            if (!empty($taxes)) {
                $total_tax_rate =  isset($taxes[0]['total_tax']) ? floatval($taxes[0]['total_tax']) : 0;
              }

            foreach ($lco as $c) {
                $billingData =  json_decode($c['lco_package'], true);
                if (!empty($billingData)) {
                    if (empty($this->invoices_model->get_list(array('invoice_lco' => $c['lco_ID'], 'invoice_for' => $invoice['invoice_for'])))) {
                        $invoice['invoice_for'] = 'Bill for ' . date('F-y', strtotime($posted['invoice_bill_date']));
                        $invoice_meta['billings'] = $billingData;
                        $invoice_meta['total'] = $billingData['total'];// total comes with gst
                        $invoice['invoice_tax_amount'] = $billingData['subtotal'] * $total_tax_rate / 100;
                        $invoice['invoice_date'] = $posted['invoice_bill_date'];
                        $invoice['invoice_billed_amount'] =   $billingData['total'] ;
                        $invoice['invoice_due_date'] = $posted['invoice_due_date'];
                        $invoice['invoice_lco'] = $c['lco_ID'];
                        $invoice['invoice_meta'] = json_encode($invoice_meta);
                        $this->invoices_model->insert_data($invoice);
                    }
                }
            }

           header('Content-Type: application/json');
            if(count($billingData)>0){
               echo json_encode(array("status"=>"success"));
                }else{
                echo json_encode(array("status"=>"unsuccess"));
                }
            // die();
        }else{
            $this->render(array('lco' => $lco), 'generate_bill_all_tpl');
        }

    }
}
