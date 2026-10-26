<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author Kallol
 */
class student extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'student_status';
        $this->targetModel = 'students_model';
        $this->moduleMeta = array('schools' => 'student');
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'student_assigned_to,student_due_date_of_month,student_status';
        $this->page_config['use_dropdown_columns_options']['student_status'] = array(0 => 'Off', 1 => 'On');
        $this->page_config['use_dropdown_columns_options']['student_assigned_to'] = $this->users_model->get_list_for_dropdown('user_login');
  
        $due_data = array();
        for ($due = 1; $due <= 31; $due++) {
            $due_data[] = $due;
        }
        $this->page_config['use_dropdown_columns_options']['student_due_date_of_month'] = $due_data;

        $this->allowed_action = array_merge($this->allowed_action, array('billing', 'extra_bill', 'print_statement'));
        $this->load->helper(array('dompdf', 'file', 'csv'));
        $this->page_config['tablePrimaryKey'] = $this->students_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'student'; //search title bar  student_assigned_to,student_area,,student_area
        $this->page_config['searchFields'] = 'student_name,student_code,student_address,student_status'; //search box,
        $this->page_config['list_columns'] = 'due,student_status,student_name,student_contact,student_code';
        /*         * end page_config* */
    }

    public function widget()
    {

        // page info here, db calls, etc.
        $data = null;
        //$html = $this->load->view('console/student/pdf_tpl', $data, true);
        $html = file_get_contents('http://prerelease.website/invoice_template/');
        pdf_create($html, 'filename');
        // or
        // $data = pdf_create($html, '', false);
        // write_file('name', $data);
    }

    public function student_search_by_name()
    {
        $results = $this->students_model->get_list_for_dropdown(null, array('student_status' => 1), null, 10, null, array('student_name' => $this->input->get('term')));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['student_ID'];
            $output[$key]['label'] = $result['student_name'] . '(' . $result['student_code'] . ')';
            $output[$key]['value'] = $result['student_name'];
            $invoice_generated = generate_invoice($result['student_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }
        echo json_encode($output);
    }

    public function student_search_by_code()
    {
        $results = $this->students_model->get_list_for_dropdown(null, array('student_status' => 1), null, 10, null, array('student_code' => $this->input->get('term')));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['student_id'];
            $output[$key]['label'] = $result['student_code'] . '(' . $result['student_name'] . ')';
            $output[$key]['value'] = $result['student_code'];
            if (!empty($this->input->get('invoice_date')))
                $invoice_generated = generate_invoice($result['student_ID'], ($this->input->get('invoice_date')));
            else
                $invoice_generated = generate_invoice($result['student_ID']);

            if (isset($invoices[0]) && !empty($invoices[0])) {
                $output[$key] = array_merge($output[$key], json_decode($invoices[0]['invoice_meta'], true));
            } else {
                $output[$key] = array_merge($output[$key], $invoice_generated);
            }
        }

        echo json_encode($output);
    }

    public function student_search_by_id()
    {
        $results = $this->students_model->get_list_for_dropdown(null, array('student_ID' => $this->input->get('term'), 'student_status' => 1), null, 10, null);
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['student_id'];
            $output[$key]['label'] = $result['student_code'] . '(' . $result['student_name'] . ')';
            $output[$key]['value'] = $result['student_code'];
            if (!empty($this->input->get('invoice_date')))
                $invoice_generated = generate_invoice($result['student_ID'], ($this->input->get('invoice_date')));
            else
                $invoice_generated = generate_invoice($result['student_ID']);

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

        /* if (!empty($likeCondition['student_code'])) {
          $condition['student_code'] = $likeCondition['student_code'];
          unset($likeCondition['student_code']);
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
          students.*,
          totalInvoice.total_invoice - totalCollections.total_collected as due
          from students
          right JOIN
          (
          select invoices.invoice_student, sum(invoices.invoice_billed_amount) as total_invoice from invoices group by invoices.invoice_student) as totalInvoice ON totalInvoice.invoice_student = students.student_ID
          JOIN ( select sum(collection_amount) as total_collected,collection_student from collections group by collection_student) as totalCollections ON totalCollections.collection_student = students.student_ID
          left join stbs on student_stb= stb_ID
          $likeConditionsSql
          $orderBy
          limit $offset,$limit"; */
        // pr($sql);
        $sql = "SELECT students.*,  total_billed - total_collected as due FROM students "
            . "LEFT JOIN "
            . "(select * from "
            . "(select sum(collection_amount) as total_collected,collection_student from collections group by collection_student) as totalCollections "
            . "join "
            . "(select sum(invoices.invoice_billed_amount) as total_billed,invoice_student from invoices group by invoice_student) as totalInvoices "
            . "ON totalCollections.collection_student = totalInvoices.invoice_student) as fullstudent "
            . "on student_ID = invoice_student  "
            . " $likeConditionsSql "
            . " $orderBy "
            . " limit $offset,$limit";

        /* $countsql="select 
          count(*) as totalrw
          from students
          right JOIN ( select invoices.invoice_student, sum(invoices.invoice_billed_amount) as total_invoice from invoices group by invoices.invoice_student) as totalInvoice ON totalInvoice.invoice_student = students.student_ID JOIN ( select sum(collection_amount) as total_collected,collection_student from collections group by collection_student) as totalCollections ON totalCollections.collection_student = students.student_ID
          left join stbs on student_stb= stb_ID
          $likeConditionsSql";
         */
        $countsql = "SELECT count(*) as totalrw FROM students "
            . "LEFT JOIN "
            . "(select * from "
            . "(select sum(collection_amount) as total_collected,collection_student from collections group by collection_student) as totalCollections "
            . "join "
            . "(select sum(invoices.invoice_billed_amount) as total_billed,invoice_student from invoices group by invoice_student) as totalInvoices "
            . "ON totalCollections.collection_student = totalInvoices.invoice_student) as fullstudent "
            . "on student_ID = invoice_student  "
            . " $likeConditionsSql ";
        $allData['current_paged_list'] = $this->db->query($sql)->result_array();
        $totalrw = $this->db->query($countsql)->result_array();
        $allData['total_rows'] = $totalrw[0]['totalrw'];
        //pr($allData['total_rows']);
        /* foreach ($allData['current_paged_list'] as $key => $data) {

          $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_student from invoices where invoice_student = ".$data['student_ID']." group by invoice_student")->result_array();
          $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_student from collections where collection_student= ".$data['student_ID']." group by collection_student")->result_array();

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

    public function student_wise_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $student_area = $this->input->post('student_area');
        $student_address = $this->input->post('student_address');
        $student_mso = $this->input->post('student_mso');
        $invoice_for = $this->input->post('invoice_for');
        $student_name = $this->input->post('student_name');
        $student_code = $this->input->post('student_code');

        $package = $this->packages_model->get_list();

        if (!empty($post_data)) {
            $sql = "SELECT * FROM  `students` WHERE 1 = 1 ";

            if (!empty($student_area)) {
                $sql .= "AND student_area like '%" . $student_area . "%'";
            }

            if (!empty($student_mso)) {
                $sql .= "AND student_mso = '" . $student_mso . "'";
            }
            if (!empty($student_address)) {
                $sql .= "AND student_address like '%" . $student_address . "%'";
            }
            if (!empty($student_name)) {
                $sql .= "AND student_name like '%" . $student_name . "%'";
            }
            if (!empty($student_code)) {
                $sql .= "AND student_code = '" . $student_code . "'";
            }
            $students = $this->db->query($sql)->result_array();

            $student_data = null;
            foreach ($students as $key => $student) {
                $output = null;
                $output = $this->with_due_calculation($student['student_ID']);
                $student_data[] = $output[0];
            }
        }
        if ($this->input->post()) {
            $this->load->view('console/student/student_wise_ajax_billing', array('student_data' => $student_data));
        } else {
            $this->load->view('console/student/student_wise_billing_report_tpl', array(
                'package' => $package
            ));
        }
    }

    public function inactive_student()
    {
        $condition = array('student_status' => 0);
        $allData = $this->{$this->targetModel}->get_list($condition, false, 200000, null);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->courses_model->get_list_for_dropdown('course_name');
        $this->load->view('console/student/student_listing_tpl', array('student_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function all_student()
    {
        $allData = $this->{$this->targetModel}->get_list(null, false, 200000, null);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->courses_model->get_list_for_dropdown('course_name');
        $this->load->view('console/student/student_listing_tpl', array('student_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    public function active_student()
    {
        $condition = array('student_status' => 1);
        $allData = $this->{$this->targetModel}->get_list($condition, false, 200000, null);
        $packages = $this->packages_model->get_list_for_dropdown('package_name');
        $adons = $this->courses_model->get_list_for_dropdown('course_name');
        $this->load->view('console/student/student_listing_tpl', array('student_data' => $allData, 'packages' => $packages, 'adons' => $adons));
    }

    /* public function package_student() {
      $student_package = null;
      $packages = $this->packages_model->get_list_for_dropdown('package_name');

      if ($this->input->get('package') != 'Unset') {
      $packagename = $this->input->get('package');

      $targetpackage = $this->packages_model->get_list(array('package_ID' => $packagename));

      $condition = array('student_status' => 1, 'student_package' => '["' . $targetpackage[0]['package_ID'] . '"]');
      $allData = $this->{$this->targetModel}->get_list($condition, false, 200000, null);
      } else {
      $packagelist = array();
      $condition = array('student_status' => 1, 'student_package' => '');
      foreach ($packages as $package_ID => $pack) {
      $packagelist[] = "'[\"$package_ID\"]'";
      }
      $packagelist = implode(',', $packagelist);

      $sql = $this->db->query('select * from students where student_package not in(' . $packagelist . ')');
      $allData = $sql->result_array();
      }
      $adons = $this->courses_model->get_list_for_dropdown('course_name');
      $this->load->view('console/student/student_listing_tpl', array('student_data' => $allData, 'packages' => $packages, 'adons' => $adons));
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

        $this->render($output, 'console/student/live_portal_compare_tpl');
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

                if (method_exists('student', $thefunction))
                    $output = $this->{$thefunction}();
                else
                    $output['error'] = " MSO " . $this->input->post('filter') . " is not active in your account. please contact to support";
            }
        }
        $output['filter'] = $filter;

        $this->render($output, 'console/student/box_compare_tpl');
    }

    public function student_import()
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
        $this->render($data, 'console/student/student_import_tpl');
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
            $csvstudentData['student_code'] = strtoupper($emapData[1]);
            $csvstudentData['student_name'] = strtoupper(str_ireplace("  ", " ", $emapData[2]));
            $csvstudentData['student_contact'] = $emapData[3];
            $csvstudentData['stb_no'] = strtoupper(str_ireplace("'", "", $emapData[4]));
            $csvstudentData['vc_no'] = strtoupper(str_ireplace("'", "", $emapData[5]));
            $csvstudentData['student_package'] = $emapData[6];
            $csvstudentData['student_address'] = $emapData[7];
            $csvstudentData['student_activation_date'] = date('Y-m-d', strtotime($emapData[8]));
            //  $csvSTB[] = strtolower(str_ireplace("'","",$emapData[5]));
            $csvData[] = $csvstudentData;
        }
        $liniercsvData = null;
        foreach ($csvData as $csvstudentData) {
            $linierData[] = $csvstudentData[$this->input->post('filter')];
        }

        fclose($file);


        $query = "SELECT * from students where student_status	 = 1  ";
        $rs = $this->db->query($query);
        $consolestudentData = $rs->result_array();

        $linierconsoleData = array();
        foreach ($consolestudentData as $consolestudent) {
            $linierconsoleData[] = strtoupper(trim($consolestudent[$this->input->post('filter')]));
        }
        //pr($linierData,1);
        $students_not_in_portal = array_diff($linierData, $linierconsoleData);
        $students_not_in_csv = array_diff($linierconsoleData, $linierData);

        //pr($students_not_in_portal);
        //pr($students_not_in_csv,1);

        return array('notincsv' => $students_not_in_csv, 'notinconsole' => $students_not_in_portal, 'choosenfilter' => $this->input->post('filter'));
    }

    

    /**
     * add detail
     */
    public function add_detail()
    {

        $postedData = $this->input->post();
        $stb = $this->input->post();
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();

            /*             * **********course data************** */

            $course_sql = "SELECT * FROM `courses`  WHERE course_type !='FTA'";
            $package_sql = "SELECT * FROM `packages`";

            $paycourse = $this->db->query($course_sql)->result_array();
            $packages = $this->db->query($package_sql)->result_array();

            if ($packages) {
                foreach ($packages as $key => $row) {
                    $data['packages'][] = $row;
                }
            }

            if ($paycourse) {
                foreach ($paycourse as $key => $row) {
                    $data['paycourses'][] = $row;
                }
            }
            $this->page_config['courseData'] = $data;

            /*             * **********course data****** */
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
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);
                if (function_exists('trigger_sms')) {
                    trigger_sms('welcome_school', $postedData);
                }
                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    // sftp://root@server2.olteho.com/home/lezrd/public_html/modules/schools/views/console/student
    /**
     * edit detail
     */
    public function edit_detail()
    {

        $postedData = $this->input->post();

        $config = $this->auto_fieldtype_detect(null);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {

            /*             * **********course data************** */

            $course_sql = "SELECT * FROM `courses`  WHERE course_type !='FTA'";
            $package_sql = "SELECT * FROM `packages`";

            $paycourse = $this->db->query($course_sql)->result_array();
            $packages = $this->db->query($package_sql)->result_array();

            if ($packages) {
                foreach ($packages as $key => $row) {
                    $data['packages'][] = $row;
                }
            }

            if ($paycourse) {
                foreach ($paycourse as $key => $row) {

                    $data['paycourses'][] = $row;
                }
            }
            $this->page_config['courseData'] = $data;

            /*             * **********course data****** */
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));


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
            $this->{$this->targetModel}->delete(array($this->page_config['tablePrimaryKey'] => $postedData['entry']));
        }
        echo json_encode(array('status' => 'success'));
    }

    

    public function print_statement()
    {
        $student = $this->students_model->get_list(array('student_ID' => $this->uri->segment(4)));
        $statement_for = $this->uri->segment(5);

        $data['studentData'] = $student[0];
        if (!empty($statement_for)) {
            $data['invoices'] = $this->invoices_model->get_list(array('invoice_for' => $statement_for, 'invoice_student' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_for' => $statement_for, 'collection_student' => $this->uri->segment(4)));
        } else {
            $data['invoices'] = $this->invoices_model->get_list(array('invoice_student' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_student' => $this->uri->segment(4)));
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
        //pr($this->students_model->account_statement($student,$invoice_date));

        $this->load->view('console/student/print_template_tpl', $data);
    }

    public function print_due_statement()
    {
        $collection_ID = $this->uri->segment(4);
        $collection_data = $this->collections_model->get_list(array('collection_ID' => $collection_ID));
        $data = $this->students_model->account_statement($collection_data[0]['student_ID'], $collection_data[0]['collection_date']);
        $this->load->view('console/student/print_template_due_tpl', array('collection' => $collection_data[0], 'data' => $data, 'date' => $collection_data[0]['collection_date']));
    }

    public function print_invoice_statement()
    {
        $invoice_ID = $this->uri->segment(4);
        $invoice_data = $this->invoices_model->get_list(array('invoice_ID' => $invoice_ID));
        $data = $this->students_model->account_statement($invoice_data[0]['invoice_student'], $invoice_data[0]['invoice_date']);

        $isthermal = get_option('thermal');
        if($isthermal=="true"){
          $this->load->view('console/student/print_thermal_template_invoice_tpl', array('invoice' => $invoice_data[0], 'data' => $data, 'date' => $invoice_data[0]['invoice_date'], 'collection_data' => $collection_data));

        } else{
                $this->load->view('console/student/print_template_invoice_tpl', array('invoice' => $invoice_data[0], 'data' => $data, 'date' => $invoice_data[0]['invoice_date'], 'collection_data' => $collection_data));
        }
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

                $invoice['invoice_student'] = $data['collection_student'];
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
                $collection['collection_student'] = $data['collection_student'];
                $collection['collection_note'] = $data['collection_note'];
                $collection['collection_amount'] = $data['collection_amount'];
                $collection['collection_date'] = $data['collection_date'];
                $collection['collection_for'] = $data['collection_for'];
                $collectionId = $this->collections_model->insert_data($collection);

                if (isset($generated['print'])) {
                    redirect(console_url('student/print_due_statement/' . $data['collection_student'] . '/' . $data['collection_date']));
                }
                // redirect(console_url('collection/print_receipt/' . $collectionId));
            }
            redirect(console_url('student/billing/' . $data['collection_student']));
        } else {
            $studentdata = $this->students_model->get_list(array('student_ID' => $this->uri->segment(4)));


            $data['invoices'] = $this->invoices_model->get_list(array('invoice_student' => $this->uri->segment(4)));
            $data['collections'] = $this->collections_model->get_list(array('collection_student' => $this->uri->segment(4)));

            $sheetData = null;
            foreach ($data['invoices'] as $value) {

                $k = count($sheetData[strtotime($value['invoice_date'])]);
                $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
                $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/student/print_invoice_statement/' . $this->uri->segment(4) . '/' . $value['invoice_date'] . '">' . $value['invoice_for'] . ' </a>';
                $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
                $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
                $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
            }
            ksort($sheetData);
            foreach ($data['collections'] as $value) { //pr($value);
                $k = count($sheetData[strtotime($value['collection_date'])]);
                $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
                $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/student/print_due_statement/' . $this->uri->segment(4) . '/' . $value['collection_date'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
                $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
                $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
                $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
            }
            ksort($sheetData);
            $data['sheetData'] = $sheetData;
            $data['studentdata'] = $studentdata[0];


            $student_package = json_decode($data['studentdata']['student_package'], true);

            $invoice_meta['billings'] = $student_package;
            $invoice_meta['total'] = $student_package['total'];
            $invoice['invoice_billed_amount'] = $student_package['total'];
            $invoice['invoice_tax_amount'] = $student_package['total'] / 1.18;
            $invoice['invoice_for'] = "schoolTv Billing";
            $invoice['invoice_meta'] = json_encode($invoice_meta);


            $data['billingData'] = $student_package['items'];
            $data['total'] = $invoice['invoice_billed_amount'];
            $data['sub_total'] = $student_package['subtotal'];

            //pr($data);
            $this->render($data, 'billing_tpl');
        }
    }

    public function create_bill()
    {
        $segment = $this->uri->segment_array();
        $data = $this->input->post();
        //pr($data,1);
        $this->generate_bill($data['student_ID'], $data['invoice_date']);
        redirect('/console/student/billing/' . $data['student_ID'], $data['invoice_date']);
    }

    public function generate_bill($student_id = null, $date = null, $return = false)
    {
        $invoice_date = $this->input->post('invoice_date');

        $statement_for = "schoolTv Billing -" . Date('F-y', strtotime($invoice_date));

        //$student_id = implode(',', $student_id);
        //pr($statement_for,1);

        if (empty($student_id))
            return;
        //if (empty($student_id))
        //  $students = $this->db->query('select * from students where student_status = 1')->result_array();
        //else
        $students = $this->db->query("select * from students where student_ID in($student_id)")->result_array();
        //$taxes = $this->taxes_model->get_list();
        foreach ($students as $data) {
            $already_entry = $this->db->query("select * from invoices where invoice_date='$invoice_date' and invoice_for = '$statement_for' and invoice_student = " . $data['student_ID'])->result_array();
            // pr($data,1);
            if (!empty($already_entry))
                continue;
            $invoice['invoice_student'] = $data['student_ID'];
            // pr( $invoice['invoice_student'],1);
            $invoice['invoice_date'] = $invoice_date;
            $total = 0.00;
            $billingData = null;
            if ($data['student_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-') . $data['student_due_date_of_month'];
            }
            if (empty(json_decode($data['student_package'], true))) {

                continue;
            }

            $student_package = json_decode($data['student_package'], true);
            $invoice_meta['billings'] = $student_package;
            $invoice_meta['total'] = $student_package['total'];
            $invoice['invoice_billed_amount'] = $student_package['total'];
            $invoice['invoice_tax_amount'] = $student_package['total'] - $student_package['total'] / 1.18;
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
        $students_data = $this->with_due_calculation();
        $this->render(array("students" => $students_data), 'due_list_tpl');
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

    private function with_due_calculation($student_id = null)
    {
        if (empty($student_id))
            $students_data = $this->db->query('select * from students')->result_array();
        else
            $students_data = $this->db->query('select * from students ')->result_array();
        $students_in = array();
        foreach ($students_data as $key => $value) {
            $students_in[] = $value['student_ID'];
        }
        $students_in = implode(',', $students_in);

        $invoices = $this->db->query("select sum(invoice_billed_amount) as total_invoice,invoice_student from invoices where invoice_student in ($students_in) group by invoice_student")->result_array();
        $collections = $this->db->query("select sum(collection_amount) as total_collected,collection_student from collections where collection_student in ($students_in) group by collection_student")->result_array();
        foreach ($invoices as $key => $value) {
            $students[$value['invoice_student']]['total_invoice'] = $value['total_invoice'];
        }
        foreach ($collections as $key => $value) {
            $students[$value['collection_student']]['total_collected'] = $value['total_collected'];
        }
        foreach ($students_data as $key => $value) {
            $students_data[$key]['total_collected'] = (float) $students[$value['student_ID']]['total_collected'];
            $students_data[$key]['total_invoice'] = (float) $students[$value['student_ID']]['total_invoice'];
            $students_data[$key]['due'] = (float) $students[$value['student_ID']]['total_invoice'] - (float) $students[$value['student_ID']]['total_collected'];
        }
        //pr($students_data);

        return $students_data;
    }

    public function billing_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $student_area = $this->input->post('student_area');
        $student_address = $this->input->post('student_address');
        $package_name = $this->input->post('package_name');
        $invoice_for = $this->input->post('invoice_for');
        $student_name = $this->input->post('student_name');
        $student_code = $this->input->post('student_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `invoices` join `students` on invoices.invoice_student=students.student_ID WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND invoice_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND invoice_date<='" . $period_end . "'";
            }
            if (!empty($package_name)) {
                $package_name = '"' . $package_name . '"';
                $sql .= "AND student_package='[" . $package_name . "]'";
            }
            if (!empty($invoice_for)) {
                $sql .= "AND invoice_for like '%" . $invoice_for . "%'";
            }
            if (!empty($student_area)) {
                $sql .= "AND student_area like '%" . $student_area . "%'";
            }
         
            if (!empty($student_address)) {
                $sql .= "AND student_address like '%" . $student_address . "%'";
            }
            if (!empty($student_name)) {
                $sql .= "AND student_name like '%" . $student_name . "%'";
            }
            if (!empty($student_code)) {
                $sql .= "AND student_code= '" . $student_code . "'";
            }
            # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
            $invoices = $this->db->query($sql)->result_array();
            //echo $sql;
            //pr($invoices,1);
            $student_data = null;
            foreach ($invoices as $key => $invoice) {
                $student_data[$key]['student_name'] = $invoice['student_name'];
                $student_data[$key]['student_code'] = $invoice['student_code'];
                $student_data[$key]['student_address'] = $invoice['student_address'];
                $student_data[$key]['student_area'] = $invoice['student_area'];
                $student_data[$key]['invoice_date'] = $invoice['invoice_date'];
                $student_data[$key]['invoice_for'] = $invoice['invoice_for'];
                $student_data[$key]['invoice_billed_amount'] = $invoice['invoice_billed_amount'];
                $student_data[$key]['invoice_tax_amount'] = $invoice['invoice_tax_amount'];
            }
            //    pr($student_data,1);
        }

        $package = $this->packages_model->get_list();
       
        if ($this->input->post()) {
            $this->load->view('console/student/billing_ajax_report_tpl', array('student_data' => $student_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/student/billing_report_tpl', array('student_data' => $student_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package, 'mso' => $mso));
        }
    }

    public function collection_report()
    {

        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $student_area = $this->input->post('student_area');
        $student_mso = $this->input->post('student_mso');
        $student_address = $this->input->post('student_address');
        $collection_collected_by = $this->input->post('collection_collected_by');
        $collection_for = $this->input->post('collection_for');
        $student_name = $this->input->post('student_name');
        $student_code = $this->input->post('student_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `collections` "
                . "join `students` on collections.collection_student=students.student_ID "
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
            if (!empty($student_area)) {
                $sql .= "AND student_area like '%" . $student_area . "%'";
            }
            if (!empty($student_mso)) {
                $sql .= "AND student_mso = '" . $student_mso . "'";
            }
            if (!empty($student_address)) {
                $sql .= "AND student_address like '%" . $student_address . "%'";
            }
            if (!empty($student_name)) {
                $sql .= "AND student_name like '%" . $student_name . "%'";
            }
            if (!empty($student_code)) {
                $sql .= "AND student_code= '" . $student_code . "'";
            }
            # $collections = $this->db->query("SELECT * FROM `collections` WHERE collection_date >='" . $period_start . "' AND collection_date<='" . $period_end . "'")->result_array();
            $collections = $this->db->query($sql)->result_array();
            //echo $sql;
            //pr($collections,1);
            $student_data = null;
            foreach ($collections as $key => $collection) {
                $student_data[$key]['student_name'] = $collection['student_name'];
                $student_data[$key]['student_code'] = $collection['student_code'];
                $student_data[$key]['student_address'] = $collection['student_address'];
                $student_data[$key]['student_area'] = $collection['student_area'];
                $student_data[$key]['collection_date'] = $collection['collection_date'];
                $student_data[$key]['collection_for'] = $collection['collection_for'];
                $student_data[$key]['collection_amount'] = $collection['collection_amount'];
                $student_data[$key]['collection_collected_by'] = $collection['collection_collected_by'];
            }
            //    pr($student_data,1);
        }

        $package = $this->packages_model->get_list();

        if ($this->input->post()) {
            $this->load->view('console/student/collection_ajax_report_tpl', array('student_data' => $student_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/student/collection_report_tpl', array('student_data' => $student_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package, 'mso' => $mso));
        }
    }

    public function not_collected_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $student_area = $this->input->post('student_area');
        $student_address = $this->input->post('student_address');
        $student_name = $this->input->post('student_name');
        $student_code = $this->input->post('student_code');
        #echo $package_name;
        if (!empty($post_data)) {
            $sql1 = "SELECT student_ID FROM `collections` "
                . "join `students` on collections.collection_student=students.student_ID "
                . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql1 .= "AND collection_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql1 .= "AND collection_date<='" . $period_end . "'";
            }


            /*             * ***************** */
            $sql = "SELECT * from `students`"
                . "WHERE student_ID not in ($sql1) ";
            if (!empty($student_area)) {
                $sql .= "AND student_area like '%" . $student_area . "%'";
            }
            if (!empty($student_address)) {
                $sql .= "AND student_address like '%" . $student_address . "%'";
            }
            if (!empty($student_name)) {
                $sql .= "AND student_name like '%" . $student_name . "%'";
            }
            if (!empty($student_code)) {
                $sql .= "AND student_code= '" . $student_code . "'";
            }

            # $collections = $this->db->query("SELECT * FROM `collections` WHERE collection_date >='" . $period_start . "' AND collection_date<='" . $period_end . "'")->result_array();
            $collections = $this->db->query($sql)->result_array();

            //  pr($collections,1);
            $student_data = null;
            foreach ($collections as $key => $collection) {
                $student_data[$key]['student_ID'] = $collection['student_ID'];
                $student_data[$key]['student_name'] = $collection['student_name'];
                $student_data[$key]['student_code'] = $collection['student_code'];
                $student_data[$key]['student_address'] = $collection['student_address'];
                $student_data[$key]['student_area'] = $collection['student_area'];
                $output = $this->with_due_calculation($collection['student_ID']);
                $student_data[$key]['due'] = $output[0]['due'];
            }
            // pr($student_data,1);
        }

        $package = $this->packages_model->get_list();
        if ($this->input->post()) {
            $this->load->view('console/student/not_collected_ajax_report_tpl', array('student_data' => $student_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/student/not_collected_report_tpl', array('student_data' => $student_data, 'start' => $period_start, 'end' => $period_end, 'package' => $package));
        }
    }

    public function items()
    {
        pr($this->input->post());
    }

    public function get_collection_for()
    {
        $collection_for = $this->invoices_model->get_list(array('invoice_student' => $this->input->post('student_id')));
        foreach ($collection_for as $key => $value) {
            echo '<option value = "' . $value['invoice_for'] . '">';
        }
    }

    private function renewal($student_ID)
    {
        $data = $this->db->query("select * from students 
		join packages on 
		students.student_package = packages.package_ID
		where student_ID = $student_ID
		")->result_array();
        foreach ($data as $k => $v) {
            $data['student_renewal_date'] = date('Y-m-d', strtotime('+' . $v['package_subscription_days'] . ' days', strtotime($v['student_last_renew_date'])));
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
        //     $this->load->view('console/student/table_tpl', $error);
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

                    $pack = $this->db->query("select * from packages  where package_name='" . $value['student_package'] . "'")->result_array();

                    $string_price = '"' . $value['student_package'] . '"';
                    $pack_price = (int) filter_var($string_price, FILTER_SANITIZE_NUMBER_INT);

                    $student_package =  '{"items":[{"name":"' . $pack[0]['package_name'] . '","price":' . $pack_price . '}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';

                    if (empty($pack)) {
                        // echo 'empty pack';
                        $this->db->query("INSERT INTO `packages`(`package_name`, package_rate) VALUES ('" . $value['student_package'] . "','" . $pack_price . "')");
                        $pack_data = $this->db->query("select * from packages where package_name='" . $value['student_package'] . "'")->result_array();
                        $value['student_package'] = '{"items":[{"name":"' . $pack_data[0]['package_name'] . '","price":"' . $pack_data[0]['package_rate'] . '"}],"subtotal":' . $pack_price . ',"discount":"0.00","total":' . $pack_price . '}';
                    } else {
                        $value['student_package'] = $student_package;
                    }

                  

                    // pr($value);
                    // die();

                    $duplicate_chk = $this->db->query("SELECT * FROM `students`")->result_array();
                    $student_con = str_replace(array('"',"'"), "", $value['student_contact']);
                    // if ($duplicate_chk[0]['student_stb'] === $value['student_stb']) {
                    //     echo "Duplicate Entry";
                    // } else {
                    $sql = "INSERT INTO students"
                        . "(student_code,"
                        . "student_name,"
                        . "student_address,"
                        . "student_contact,"

                        . "student_activation_date,"
                        . "student_package,"
                        . "student_assigned_to,"
                        . "student_area,"
                        . "student_status,"
                        . "student_last_renew_date,"
                        . "student_deactivation_date,"


                        . "student_due_date_of_month) "

                        . "VALUES('" . $value['student_code'] . "','" . $value['student_name'] . "','" . $value['student_address'] . "','" . $student_con . "',
                        '','" . $value['student_package'] . "','','" . $value['student_area'] . "','','','','','')";
                    $this->db->query($sql);
                    // print_r($sql);
                    // }
                }

                redirect('console/student');
            } else {
                print_r($errors[0]);
            }
        }

        // }
    }


    public function import_student()
    {

        $this->render();
    }

    public function searchstudent(){
        $data = $this->input->post();
        $student_code = $data['student_code'];
        $sql = "SELECT student_ID FROM `students` WHERE student_code = '".$student_code."'";
        $userData = $this->db->query($sql)->result_array();
        if(!empty($userData)){
            header('Content-Type: application/json');
            echo json_encode(array("status" => "success", "user_data" => $userData));
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => "faild"));
        }
        
    }

    public function fastbill()
    {
        $studentdata = $this->students_model->get_list(array('student_ID' => $this->uri->segment(4)));

        $data['invoices'] = $this->invoices_model->get_list(array('invoice_student' => $this->uri->segment(4)));
        $data['collections'] = $this->collections_model->get_list(array('collection_student' => $this->uri->segment(4)));
        $sheetData = null;
        foreach ($data['invoices'] as $value) {
            // pr($value);
            $k = count($sheetData[strtotime($value['invoice_date'])]);

            $sheetData[strtotime($value['invoice_date'])][$k]['ID'] = $value['invoice_ID'];
            $sheetData[strtotime($value['invoice_date'])][$k]['date'] = $value['invoice_date'];
            $sheetData[strtotime($value['invoice_date'])][$k]['type'] = '<a class="btn btn-info" href="/console/student/print_invoice_statement/' . $value['invoice_ID'] . '">' . $value['invoice_for'] . ' </a>';
            $sheetData[strtotime($value['invoice_date'])][$k]['bill'] = $value['invoice_billed_amount'];
            $sheetData[strtotime($value['invoice_date'])][$k]['paid'] = '';
            $sheetData[strtotime($value['invoice_date'])][$k]['note'] = $value['invoice_note'];
        }
        ksort($sheetData);
        foreach ($data['collections'] as $value) { //pr($value);
            $k = count($sheetData[strtotime($value['collection_date'])]);
            $sheetData[strtotime($value['collection_date'])][$k]['ID'] = $value['collection_ID'];
            $sheetData[strtotime($value['collection_date'])][$k]['date'] = $value['collection_date'];
            $sheetData[strtotime($value['collection_date'])][$k]['type'] = '<a class="btn btn-success" href="/console/student/print_due_statement/' . $value['collection_ID'] . '">' . $value['collection_for'] . ' collected-by:-' . $value['collection_collected_by'] . '</a>';
            $sheetData[strtotime($value['collection_date'])][$k]['bill'] = '';
            $sheetData[strtotime($value['collection_date'])][$k]['paid'] = $value['collection_amount'];
            $sheetData[strtotime($value['collection_date'])][$k]['note'] = $value['collection_note'];
        }
        ksort($sheetData);
        $data['sheetData'] = $sheetData;
        $data['studentdata'] = $studentdata[0];

        $student_package = json_decode($data['studentdata']['student_package'], true);

        $invoice_meta['billings'] = $student_package;
        $invoice_meta['total'] = $student_package['total'];
        $invoice['invoice_billed_amount'] = $student_package['total'];
        $invoice['invoice_tax_amount'] = $student_package['total'] / 1.18;
        $invoice['invoice_for'] = "schoolTv Billing";
        $invoice['invoice_meta'] = json_encode($invoice_meta);
        $data['billingData'] = $student_package['items'];
        $data['total'] = $invoice['invoice_billed_amount'];
        $data['sub_total'] = $student_package['subtotal'];


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
        $invoice['invoice_student'] = $data['invoice_student'];
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
            $this->students_model->update_data(array("student_package" => json_encode($billingData['billings'])), array('student_ID' => $data['invoice_student']));
        } else {
            if (!isset($data['otherbill'])) {
                $invoice['invoice_for'] = 'Bill for ' . date('F-y', strtotime($invoice['invoice_date']));
                $this->students_model->update_data(array("student_package" => json_encode($billingData['billings'])), array('student_ID' => $data['invoice_student']));
            } else {
                $invoice['invoice_for'] = 'Bill for items ';
            }
            $this->invoices_model->insert_data($invoice);
        }
        redirect('/console/student/fastbill/' . $data['invoice_student']);
    }

    public function generate_bill_all()
    {

        $posted = $this->input->post();

        if (!empty($posted)) {
            $student = $this->students_model->get_list(array("student_status" => 1));
            $invoice = array();
            $taxes = $this->db->query("SELECT SUM(tax_value) as total_tax FROM `taxes`")->result_array();
            $total_tax_rate = 0;
            if (!empty($taxes)) {
                $total_tax_rate =  isset($taxes[0]['total_tax']) ? floatval($taxes[0]['total_tax']) : 0;
              }

            foreach ($student as $c) {
                $billingData =  json_decode($c['student_package'], true);
                if (!empty($billingData)) {
                    if (empty($this->invoices_model->get_list(array('invoice_student' => $c['student_ID'], 'invoice_for' => $invoice['invoice_for'])))) {
                        $invoice['invoice_for'] = 'Bill for ' . date('F-y', strtotime($posted['invoice_bill_date']));
                        $invoice_meta['billings'] = $billingData;
                        $invoice_meta['total'] = $billingData['total'];// total comes with gst
                        $invoice['invoice_tax_amount'] = $billingData['subtotal'] * $total_tax_rate / 100;
                        $invoice['invoice_date'] = $posted['invoice_bill_date'];
                        $invoice['invoice_billed_amount'] =   $billingData['total'] ;
                        $invoice['invoice_due_date'] = $posted['invoice_due_date'];
                        $invoice['invoice_student'] = $c['student_ID'];
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
            $this->render(array('student' => $student), 'generate_bill_all_tpl');
        }

    }



    /**
     * generate view for view details 
     */
    protected function generate_detail_view($data = NULL, $user_config = array(), $view_template = 'student/student_tpl') {
        /** auto field type detect Start* */
        $config = $this->auto_fieldtype_detect($user_config);
        /** auto field type detect End* */
        /** dropdown */
        $config['use_dropdown_columns_options'] = isset($user_config['use_dropdown_columns_options']) ? $user_config['use_dropdown_columns_options'] : array();

        /** image */
        if (!isset($user_config['use_image_columns_path'])) {
            $user_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_image_columns'] = is_string(@$user_config['use_image_columns']) ? explode(',', $user_config['use_image_columns']) : NULL;
        $config['use_image_columns_path'] = is_string(@$user_config['use_image_columns_path']) ? explode(',', $user_config['use_image_columns_path']) : $user_config['use_image_columns_path'];



        $tabledata['table_meta']['config'] = $config;
        $tabledata['table_meta']['data'] = isset($data) ? $data : NULL;


        return $this->render($tabledata, $view_template, true, false, false);
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
}
