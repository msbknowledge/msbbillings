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
class Sale extends MY_Controller
{

    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->targetModel = 'sales_model';
        $this->moduleMeta = array('medical' => 'Sale');
        $this->page_config['tablePrimaryKey'] = $this->sales_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Sale'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,edit_detail,delete,view_detail,export,print,mail';
       
        $this->page_config['searchFields'] = 'medicine_name,medicine_hsn,customer_contact,sale_date,sale_invoice,customer_name,sale_batch,sale_mrp'; //search box,
        $this->page_config['list_columns'] = 'sale_date,medicine_name,medicine_hsn,sale_invoice,customer_name,sale_total_paid';
        $this->page_config['autocomplete']['customer_name'] = array('customers' => 'customer_name');
        $this->page_config['autocomplete']['doctor_name'] = array('customers' => 'doctor_name');
        $this->page_config['autocomplete']['customer_contact'] = array('customers' => 'customer_contact');
        // $this->page_config['autocomplete']['doctor_name'] = array('doctors' => 'doctor_name');
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        $this->page_config['autocomplete']['sale_batch'] = array('sales' => 'sale_batch');

        /*         * end page_config* */
    }

    public function add_detail()
    {

//pr($this->input->post());
//error_reporting(4);

        if ($this->input->post()) {
            $customer['customer_name'] = strtoupper($this->input->post('customer_name'));
            $customer['customer_address'] = strtoupper($this->input->post('customer_address'));
            $customer['email'] =$this->input->post('email');
            $customer['customer_gst'] = strtoupper($this->input->post('customer_gst'));
            $customer['customer_contact'] = $this->input->post('customer_contact');
            $customer['doctor_name'] = strtoupper($this->input->post('doctor_name'));
            $customer_ID = null;
            $data = $this->customers_model->get_list($customer);
            if (empty($data)) {
                $customer_ID = $this->customers_model->insert_data($customer);
            } else {
                $customer_ID = $data[0]['customer_ID'];
            }

            $doctor_ID = null;
            $doctor['doctor_name'] = strtoupper($this->input->post('doctor_name'));
            $doctor['doctor_address'] = strtoupper($this->input->post('doctor_address'));
            $doctor['doctor_contact'] = $this->input->post('doctor_contact');
            $data = $this->doctors_model->get_list($doctor);
            if (empty($data)) {
                $data = $this->doctors_model->insert_data($doctor);
                $doctor_ID = $data;
            } else {
                $doctor_ID = $data[0]['doctor_ID'];
            }
            $sale = null;
            $stock = 0;
            $unit = 0;
            //pr($this->input->post('sale_total'),1);
            
            for ($i = 0; $i < count($this->input->post('sale_total')); $i++) {
                $medicine = null;$invoiceno = $this->input->post('sale_invoice');
                $sale[$i]['sale_invoice'] =$invoiceno;

                $sale[$i]['sale_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('sale_date')));

                $sale[$i]['sale_customer'] = $customer_ID;
                $sale[$i]['sale_doctor'] = $doctor_ID;

                $sale[$i]['sale_loose_quantity'] = $this->input->post('sale_loose_quantity')[$i];
                $sale[$i]['sale_strip_quantity'] = $this->input->post('sale_strip_quantity')[$i];

                $medicine['medicine_name'] = strtoupper($this->input->post('medicine_name')[$i]);
                   
                $data = $this->medicines_model->get_list($medicine);

                $sale[$i]['sale_batch'] = $this->input->post('sale_batch')[$i];
                // $sale[$i]['category'] = $this->input->post('medicine_category')[$i];
                // $sale[$i]['schedule'] = $this->input->post('medicine_schedule')[$i];
                $sale[$i]['sale_expire_month'] = $this->input->post('sale_expire_month')[$i];
                $sale[$i]['sale_expire_year'] = $this->input->post('sale_expire_year')[$i];
                $sale[$i]['sale_mrp'] = $this->input->post('sale_mrp')[$i];
                $sale[$i]['sale_rate'] = $this->input->post('sale_rate')[$i];
                
                
             
                if (empty($data)) {
                    $medicine['medicine_unit'] = $this->input->post('medicine_unit')[$i];
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                    $strip = (int) $sale[$i]['sale_strip_quantity'];
                    $loose = (int) $sale[$i]['sale_loose_quantity'];
                    medicine_stock_update(
                        $sale[$i]['sale_batch'],
                        $medicine_id,
                        $strip,
                        $loose,
                        '+',
                        $sale[$i]['sale_mrp'],
                        $sale[$i]['sale_expire_month'],
                        $sale[$i]['sale_expire_year']
                    );
                    
                    //  echo '<div class="alert alert-error alert-block"><strong>Duplicate</strong>,Please select Medicine</div>';
                    //  echo '<script>
                    //     setTimeout(function(){
                    //     	window.location.href ="https://antu.msbbillings.in/console/sale";
                    //     },3000);// for 1 second redirection
                    //     </script>';
                    //  //;
                    
                    //  exit();
                } else {
                    $medicine_id = $data[0]['medicine_id'];
                }

                $sale[$i]['sale_medicine_id'] = $medicine_id;
                $sale[$i]['sale_discount_percent'] = $this->input->post('sale_discount_percent')[$i];
                $sale[$i]['sale_taxable'] = $this->input->post('sale_taxable')[$i];
                $sale[$i]['sale_new_mrp'] = $this->input->post('sale_new_mrp')[$i];
                $sale[$i]['sale_sgst_percent'] = $this->input->post('sale_sgst_percent')[$i];
                $sale[$i]['sale_sgst'] = $this->input->post('sale_sgst')[$i];
                $sale[$i]['sale_cgst_percent'] = $this->input->post('sale_cgst_percent')[$i];
                $sale[$i]['sale_cgst'] = $this->input->post('sale_cgst')[$i];
                $sale[$i]['sale_total'] = $this->input->post('sale_total')[$i];
                $sale[$i]['sale_total_previous_due'] = $this->input->post('sale_total_previous_due');
                $sale[$i]['sale_total_paid'] = $this->input->post('sale_total_paid');
                $sale[$i]['sale_total_current_due'] = $this->input->post('sale_total_current_due');
                //$sale[$i]['sale_grand_discount'] = $this->input->post('sale_grand_discount');
                $sale[$i]['sale_paid_by'] = $this->input->post('sale_paid_by');
                $sale[$i]['sale_note'] = $this->input->post('sale_note');
                medicine_stock_update($sale[$i]['sale_batch'], $medicine_id, $sale[$i]['sale_strip_quantity'], $sale[$i]['sale_loose_quantity'], '-');
            }
            $this->db->query("UPDATE `options` SET `option_value`=(option_value+1) WHERE option_key='invoice_last_count'");

            $data = $this->sales_model->insert_data($sale, true);


            $payment['customer_payment_customer'] = $customer_ID;
            $payment['customer_payment_date'] = date('Y-m-d', strtotime($this->input->post('sale_date')));
            $payment['customer_payment_paid_amount'] = $this->input->post('sale_total_paid');
            $payment['customer_payment_note'] = $this->input->post('sale_note');
            $payment['customer_payment_invoice'] = $this->input->post('sale_invoice');
            $data = $this->customer_payment_model->insert_data($payment);
            if (!empty($this->input->post('print'))) {
                redirect('/console/sale/view_detail/' . base64_encode($sale[0]['sale_invoice']) . '/print');
            }
            $this->render(array('status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'));
        } else {
            $this->render();
        }
    }

    /**
     * index show list
     */
    public function index()
    {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'sale_invoice');
        $newdata = null;
        foreach ($allData['current_paged_list'] as $keys => $values) {
            foreach ($values as $key => $value) {
                if ($key == 'sale_timestamp') {
                    $values[$key] = date('Y-m-d h:i:s a', strtotime('+5 hour +30 minutes', strtotime($value)));
                } else {
                    $values[$key] = $value;
                }
            }
            $allData['current_paged_list'][$keys] = $values;
        }

        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }


 public function generate_sale() {
		// create file name
        $fileName = 'purchse-'.time().'.xlsx';  
		// load excel library
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header//Purchase Batch
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sale Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Sale Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Sale Total Paid');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Customer Name');
        // set Row
        $rowCount = 2;
         $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, null, NULL, $likeCondition, $orderBy, 'sale_invoice');
    
        foreach ($allData['current_paged_list'] as $key =>$list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['sale_invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['sale_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$list['sale_total_paid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['medicine_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['customer_name']);
            $rowCount++;
        }
      
        $filename = "sale".date("Y-m-d-H-i-s").".csv";//csv/xlsx/xls
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  //CSV/Excel5
		$objWriter->save('php://output'); 

    }
    /**
     *  view detail old not in use
     */
    public function old_view_detail()
    {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));
        $data = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
        /* $data = $this->{$this->targetModel}->get_list();
          pr($data,1); */
        if ($type == 'print') {
            $this->load->view('console/sale/print_detail', array('data' => $data));
        } else {
            $this->render(array('data' => $data));
        }
    }

    /**
     * current view details is use
     */
    /**
     * current view details is use
     */
    public function view_detail()
    {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));
        $data = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
        /* $data = $this->{$this->targetModel}->get_list();*/
        // pr($data); 
        $fullDataArray = array();
        foreach ($data as $value) {
            if ((int) $value['sale_strip_quantity'] > 0 || (int) $value['sale_loose_quantity'] > 0) {

                $fullDataArray['total_sale_mrp'] += ($value['sale_mrp'] * (int)$value['sale_strip_quantity']) + (($value['sale_mrp'] / (int)$value['medicine_unit']) * (int)$value['sale_loose_quantity']);

                $fullDataArray['total_sale_dist'] += $value['sale_mrp'] * (int)$value['sale_strip_quantity'] + (($value['sale_mrp'] / (int)$value['medicine_unit']) * (int)$value['sale_loose_quantity']) - $value['sale_total'];

                // $fullDataArray['total_grand_sale_dist']+=($value['sale_total'] * $value['sale_grand_discount'] / 100);

                $fullDataArray['total_sale_total'] += $value['sale_total'];

                $fullDataArray['total_payable_total'] += $value['sale_total'];
            }
            if ((int) $value['sale_strip_quantity'] <= -1) {
                // $fullDataArray['total_sale_return_mrp']+=$value['sale_mrp'];
                $fullDataArray['total_sale_return_total'] += $value['sale_total'];
            }
        }
        //echo $total_sale_mrp,$total_sale_return;

        if ($type == 'print') {
            // pr($data,1);
            $counter = count($data);
          
            if ($counter < 20) {

                $this->load->view('console/sale/print_details', array('data' => $data, 'fullDataArray' => $fullDataArray, 'fulldata' => $data));
            } else {
                $nop = 0;
                $nthPage = 0;
                $pagedData = array_chunk($data, 20);
              
                foreach ($pagedData as $key => $val) {
                    $nthPage++;
                    foreach ($val as $keys => $value) {
                        $pagedDatas[$key][$nop] = $value;
                        $nop++;
                    }
                }

                

                // foreach ($pagedDatas as $page => $value) {
                  
                //     $count_init = $page;
                //     $nthPage++;

                    echo $this->load->view('console/sale/print_details', array('fulldata' => $data, 'fullDataArray' => $fullDataArray, 'nthPage' => $nthPage, 'count' => count($pagedData), 'data' => $data, 'counter' => 0), true);
               // }
            }
        } else {
            $this->render(array('data' => $data));
        }
    }


    public function view_detail_old()
    {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));
        $data = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
        /* $data = $this->{$this->targetModel}->get_list();
          pr($data,1); */
        if ($type == 'print') {
            $counter = count($data);
            if ($counter < 16) {

                $this->load->view('console/sale/print_detail', array('data' => $data));
            } else {
                $pagedData = array_chunk($data, 16);
                foreach ($pagedData as $page => $value) {
                    $this->load->view('console/sale/detail_tpl', array('fulldata' => $data, 'page' => $page, 'count' => count($pagedData), 'data' => $value));
                }
            }
        } else {
            $this->render(array('data' => $data));
        }
    }

    /**
     * view detail
     */
    public function edit_detail()
    {

        if ($this->input->post()) {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));

            $customer['customer_name'] = strtoupper($this->input->post('customer_name'));
            $customer['customer_address'] = strtoupper($this->input->post('customer_address'));
            $customer['customer_gst'] = strtoupper($this->input->post('customer_gst'));
            $customer['customer_contact'] = $this->input->post('customer_contact');
            $customer_ID = null;
            $data = $this->customers_model->get_list($customer);
            if (empty($data)) {
                $data = $this->customers_model->insert_data($customer);
                $customer_ID = $data;
            } else {
                $customer_ID = $data[0]['customer_ID'];
            }

            $doctor['doctor_name'] = strtoupper($this->input->post('doctor_name'));
            $doctor['doctor_address'] = strtoupper($this->input->post('doctor_address'));
            $doctor['doctor_contact'] = $this->input->post('doctor_contact');
            $doctor_ID = null;
            $data = $this->doctors_model->get_list($doctor);
            if (empty($data)) {
                $data = $this->doctors_model->insert_data($doctor);
                $doctor_ID = $data;
            } else {
                $doctor_ID = $data[0]['doctor_ID'];
            }
            $sale = null;
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('sale_total')); $i++) {
                $medicine = null;
                $sale[$i]['sale_invoice'] = $this->input->post('sale_invoice');
                $sale[$i]['sale_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('sale_date')));
                $sale[$i]['sale_customer'] = $customer_ID;
                $sale[$i]['sale_doctor'] = $doctor_ID;
                $sale[$i]['sale_loose_quantity'] = $this->input->post('sale_loose_quantity')[$i];
                $sale[$i]['sale_strip_quantity'] = $this->input->post('sale_strip_quantity')[$i];

                $medicine['medicine_name'] = strtoupper($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);

                if (empty($data)) {
                    $medicine['medicine_unit'] = $this->input->post('medicine_unit')[$i];
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                    $strip = (int) $sale[$i]['sale_strip_quantity'];
                    $loose = (int) $sale[$i]['sale_loose_quantity'];
                    medicine_stock_update(
                        $sale[$i]['sale_batch'],
                        $medicine_id,
                        $strip,
                        $loose,
                        '+',
                        $sale[$i]['sale_mrp'],
                        $sale[$i]['sale_expire_month'],
                        $sale[$i]['sale_expire_year']
                    );
                } else {
                    $medicine_id = $data[0]['medicine_id'];
                }

                $stock_change = (int) $sale[$i]['sale_quantity'];
                $sale[$i]['sale_medicine_id'] = $medicine_id;
                $sale[$i]['sale_batch'] = $this->input->post('sale_batch')[$i];
                $sale[$i]['sale_expire_month'] = $this->input->post('sale_expire_month')[$i];
                $sale[$i]['sale_expire_year'] = $this->input->post('sale_expire_year')[$i];
                $sale[$i]['sale_mrp'] = $this->input->post('sale_mrp')[$i];
                $sale[$i]['sale_rate'] = $this->input->post('sale_rate')[$i];
                $sale[$i]['sale_discount_percent'] = $this->input->post('sale_discount_percent')[$i];
                $sale[$i]['sale_taxable'] = $this->input->post('sale_taxable')[$i];
                $sale[$i]['sale_sgst_percent'] = $this->input->post('sale_sgst_percent')[$i];
                $sale[$i]['sale_sgst'] = $this->input->post('sale_sgst')[$i];
                $sale[$i]['sale_cgst_percent'] = $this->input->post('sale_cgst_percent')[$i];
                $sale[$i]['sale_cgst'] = $this->input->post('sale_cgst')[$i];
                $sale[$i]['sale_total'] = $this->input->post('sale_total')[$i];
                $sale[$i]['sale_total_previous_due'] = $this->input->post('sale_total_previous_due');
                //$sale[$i]['sale_grand_discount'] = $this->input->post('sale_grand_discount');
                $sale[$i]['sale_total_paid'] = $this->input->post('sale_total_paid');
                $sale[$i]['sale_total_current_due'] = $this->input->post('sale_total_current_due');
                $sale[$i]['sale_paid_by'] = $this->input->post('sale_paid_by');
                $sale[$i]['sale_note'] = $this->input->post('sale_note');
                medicine_stock_update($sale[$i]['sale_batch'], $medicine_id, $sale[$i]['sale_strip_quantity'], $sale[$i]['sale_loose_quantity'], '-');
            }

            $this->sales_model->delete(array('sale_invoice' => $this->input->post('invoice_number')));
            $data = $this->sales_model->insert_data($sale, true);
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
            $payment['customer_payment_customer'] = $customer_ID;
            $payment['customer_payment_date'] = date('Y-m-d', strtotime($this->input->post('sale_date')));
            $payment['customer_payment_paid_amount'] = $this->input->post('sale_total_paid');
            $payment['customer_payment_note'] = $this->input->post('sale_note');
            $payment['customer_payment_invoice'] = $this->input->post('sale_invoice');
            if (!empty($this->customer_payment_model->get_list(array('customer_payment_customer' => $payment['customer_payment_customer'], 'customer_payment_invoice' => $payment['customer_payment_invoice'])))) {

                $data = $this->customer_payment_model->update_data(array('customer_payment_paid_amount' => $payment['customer_payment_paid_amount'], 'customer_payment_note' => $payment['customer_payment_note'], 'customer_payment_date' => $payment['customer_payment_date']), array('customer_payment_invoice' => $payment['customer_payment_invoice'], 'customer_payment_customer' => $payment['customer_payment_customer']));
            } else {
                $data = $this->customer_payment_model->insert_data($payment);
            }
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'));
        } else {
            $invoice = base64_decode($this->uri->segment(4));
         // $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => 0));
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
             // print_r($dataFull);
            $this->render(array('data' => $dataFull));
        }
    }

    /**
     * delete
     */
    public function delete()
    {
        $postedData = $this->input->post();
        if (isset($postedData['selectedItem'])) {
            foreach ($postedData['selectedItem'] as $k => $value) {
                $postedData['selectedItem'][$k] = base64_decode($value);
            }
            $this->medical_stock_rollback($postedData['selectedItem']);

            $this->{$this->targetModel}->delete(array('sale_invoice' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('sale_invoice' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    /*     * **********stock update is hold************ */

    private function medical_stock_update($old, $new)
    {
        $toupdate = null;
        $updatewith = null;
        foreach ($old as $key => $value) {
            medicine_stock_update($value['sale_batch'], $value['sale_medicine_id'], $value['sale_strip_quantity'], $value['sale_loose_quantity'], '+');
        }
        foreach ($new as $key => $value) {
            medicine_stock_update($value['sale_batch'], $value['sale_medicine_id'], $value['sale_strip_quantity'], $value['sale_loose_quantity'], '-');
        }
    }

    /*     * **********stock update is hold************ */

    private function medical_stock_rollback($items)
    {
        if (is_array($items)) {
            foreach ($items as $value) {
                $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $value));
                $this->medical_stock_update($dataFull, null);
            }
        } else {
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $items));
            $this->medical_stock_update($dataFull, null);
        }
    }

    public function sale_return()
    {

        if ($this->input->post()) {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
            $dataReturn = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => TRUE));
            $dataFinal = $this->sale_return_stocks($dataFull, $dataReturn);

            $customer['customer_name'] = strtoupper($this->input->post('customer_name'));
            $customer['customer_address'] = strtoupper($this->input->post('customer_address'));
            $customer['customer_gst'] = strtoupper($this->input->post('customer_gst'));
            $customer['customer_contact'] = $this->input->post('customer_contact');
            $data = $this->customers_model->get_list($customer);
            $customer_ID = $data[0]['customer_ID'];
            $sale = null;
            $stock = 0;
            if (empty($this->input->post('medicine_hsn'))) {
                foreach ($dataReturn as $value) {
                    medicine_stock_update($value['sale_batch'], $value['sale_medicine_id'], $value['sale_strip_quantity'], $value['sale_loose_quantity'], '-');
                    $this->db->query('delete from sales where sale_return = true and sale_ID = "' . $value['sale_ID'] . '"');
                }

                //pr($data);
                //$this->medical_stock_update($dataFull, $sale);
            } else {
                for ($i = 0; $i < count($this->input->post('sale_total')); $i++) {
                    if ($this->input->post('sale_returned')[$i] == 'true') {
                        continue;
                    }
                    $sale[$i]['sale_invoice'] = $this->input->post('sale_invoice');
                    $sale[$i]['sale_return_date'] = date('Y-m-d', strtotime($this->input->post('sale_return_date')));
                    $sale[$i]['sale_date'] = date('Y-m-d', strtotime($this->input->post('sale_date')));
                    $sale[$i]['sale_customer'] = $customer_ID;
                    $sale[$i]['sale_quantity'] = $this->input->post('sale_quantity')[$i];
                    $medicine['medicine_name'] = strtoupper($this->input->post('medicine_name')[$i]);
                    $medicine['medicine_manufacturer'] = strtoupper($this->input->post('medicine_manufacturer')[$i]);
                    $medicine['medicine_hsn'] = $this->input->post('medicine_hsn')[$i];


                    $medicine_id = null;
                    $data = $this->medicines_model->get_list($medicine);

                    $medicine_id = $data[0]['medicine_id'];
                    $stock = (int) $data[0]['medicine_stock'] + (int) $sale[$i]['sale_quantity'];
                    $sale[$i]['sale_medicine_id'] = $medicine_id;
                    $sale[$i]['sale_batch'] = $this->input->post('sale_batch')[$i];
                    $sale[$i]['sale_expire_month'] = $this->input->post('sale_expire_month')[$i];
                    $sale[$i]['sale_expire_year'] = $this->input->post('sale_expire_year')[$i];
                    $sale[$i]['sale_mrp'] = $this->input->post('sale_mrp')[$i];
                    $sale[$i]['sale_rate'] = $this->input->post('sale_rate')[$i];
                    $sale[$i]['sale_discount_percent'] = $this->input->post('sale_discount_percent')[$i];
                    $sale[$i]['sale_taxable'] = $this->input->post('sale_taxable')[$i];
                    $sale[$i]['sale_sgst_percent'] = $this->input->post('sale_sgst_percent')[$i];
                    $sale[$i]['sale_sgst'] = $this->input->post('sale_sgst')[$i];
                    $sale[$i]['sale_cgst_percent'] = $this->input->post('sale_cgst_percent')[$i];
                    $sale[$i]['sale_cgst'] = $this->input->post('sale_cgst')[$i];
                    $sale[$i]['sale_total'] = $this->input->post('sale_total')[$i];
                    $sale[$i]['sale_return'] = true;
                    $sale[$i]['sale_total_previous_due'] = $this->input->post('sale_total_previous_due');
                    $sale[$i]['sale_total_paid'] = $this->input->post('sale_total_paid')[$i];
                    $sale[$i]['sale_total_current_due'] = $this->input->post('sale_total_current_due');
                    $sale[$i]['sale_paid_by'] = $this->input->post('sale_paid_by');
                    $sale[$i]['sale_note'] = $this->input->post('sale_note');

                    if (!empty($sale)) {
                        medicine_stock_update($sale[$i]['sale_batch'], $medicine_id, $sale[$i]['sale_strip_quantity'], $sale[$i]['sale_loose_quantity'], '+');
                    }
                }

                //$this->sales_model->delete(array('sale_invoice' => $this->input->post('invoice_number')));
                if (!empty($sale)) {
                    $data = $this->sales_model->insert_data($sale, true);
                }
            }
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
            $onlysale = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => false));
            $dataReturn = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => TRUE));
            $dataFinal = $this->sale_return_stocks($dataFull, $dataReturn);
            $this->render(array(
                'status' => 'success', 'data' => $dataFinal,
                'message' => '<strong>Well done!</strong> Data Save.'
            ));
        } else {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
            $dataReturn = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => TRUE));
            $dataFinal = $this->sale_return_stocks($dataFull, $dataReturn);
            // pr($dataFinal);
            $this->render(array('data' => $dataFinal));
        }
    }

    private function sale_return_stocks($dataFull, $return)
    {
        foreach ($dataFull as $dfk => $df) {
            foreach ($return as $rk => $r) {
                if ($df['sale_medicine_id'] == $r['sale_medicine_id'] && $df['sale_return'] == false) {
                    $dataFull[$dfk]['sale_quantity'] = $dataFull[$dfk]['sale_quantity'] - $r['sale_quantity'];
                }
            }
        }
        return $dataFull;
    }

    ///// batchnumber bug
    public function autocomplete()
    {
        $field = $this->uri->segment(5);
        $model = $this->uri->segment(4);
        $search = $this->input->get('term');
        if ($model == "medicines_model") {
            $data = $this->db->query('select '
                . 'medicines.*, '
                . 'purchase_batch as sale_batch,'
                . 'purchase_expire_month as sale_expire_month,'
                . 'purchase_expire_year as sale_expire_year,'
                . 'purchase_unit as sale_quantity,'
                . 'purchase_mrp/purchase_unit as sale_mrp,'
                . 'purchase_sgst_percent as sale_sgst_percent,'
                . 'purchase_cgst_percent as sale_cgst_percent'
                . '  from medicines'
                . ' join purchases on medicine_id=purchase_medicine_id '
                . ' join medicine_stocks on medicine_id=medicine_stock_medicine '
                . 'where medicine_id in('
                . 'select distinct(purchase_medicine_id) from purchases order by purchase_date) and medicine_name like "%' . $search . '%" and '
                . 'medicine_stock_count >0 group by medicine_id order by medicine_stock_batch desc')->result_array();
        } else {
            $data = ($this->{$model}->get_list_for_dropdown(null, NULL, NULL, 10, NULL, array($field => $search)));
        }
        $responce = null;
        foreach ($data as $id => $value) {
            $responce[] = array('id' => $id, 'label' => $value[$field], 'value' => $value[$field], 'complete' => $value);
        }
        echo json_encode($responce);
    }

    public function daily_sale_medicine()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $sale_invoice = $this->input->post('sale_invoice');
        $medicine_name = $this->input->post('medicine_name');

        if (!empty($post_data)) {
            $sql = "SELECT medicines.medicine_name,sales.sale_date,sales.sale_batch,sales.sale_strip_quantity,sales.sale_loose_quantity,sales.sale_invoice FROM `sales` join `medicines` on sales.sale_medicine_id=medicines.medicine_id WHERE 1 = 1";

            if (!empty($period_start)) {
                $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
            }

            if (!empty($sale_invoice)) {
                $sql .= " AND sale_invoice like '%" . $sale_invoice . "%'";
            }
            if (!empty($medicine_name)) {
                $sql .= " AND medicine_name like '" . $medicine_name . "%'";
            }
            //$sql .= "GROUP BY sale_invoice";

            $sale = $this->db->query($sql)->result_array();

            $medicine_data = null;
            foreach ($sale as $key => $invoice) {
                $medicine_data[$key]['sale_invoice'] = $invoice['sale_invoice'];
                $medicine_data[$key]['sale_date'] = $invoice['sale_date'];
                $medicine_data[$key]['sale_strip_quantity'] = $invoice['sale_strip_quantity'];
                $medicine_data[$key]['sale_loose_quantity'] = $invoice['sale_loose_quantity'];
                $medicine_data[$key]['medicine_name'] = $invoice['medicine_name'];
                $medicine_data[$key]['sale_batch'] = $invoice['sale_batch'];
            }
        }
        if ($this->input->post('key')) {
            $this->load->view('console/sale/report_daily_medicine', array('medicine_data' => $medicine_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/sale/report_daily_medicine_tpl', array('medicine_data' => $medicine_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    public function report_daily_wise()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $customer_gst = $this->input->post('customer_gst');
        #echo $package_name;
        $sql = "SELECT customers.*,sales.sale_date,sales.sale_return,sales.sale_grand_discount,sales.sale_return_date,sales.sale_invoice,sum(sale_taxable) as sale_taxable,sum(sale_discount_percent) as sale_discount_percent,sum(sale_cgst) as sale_cgst,sum(sale_sgst) as sale_sgst,sum(sale_total) as sale_total  FROM `sales` join `customers` on sales.sale_customer=customers.customer_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d')  >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= "AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= "AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= "GROUP BY sale_invoice";
        # echo $sql;
        # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
        $sale = $this->db->query($sql)->result_array();
        # pr($sale);
        $customer_data = null;
        foreach ($sale as $key => $invoice) {

            $customer_data[$key]['customer_name'] = $invoice['customer_name'];
             $customer_data[$key]['customer_contact'] = $invoice['customer_contact'];
            $customer_data[$key]['customer_gst'] = $invoice['customer_gst'];
            $customer_data[$key]['sale_invoice'] = $invoice['sale_invoice'];
            $customer_data[$key]['sale_date'] = $invoice['sale_date'];
            $customer_data[$key]['sale_loose_quantity'] = $invoice['sale_loose_quantity'];
            $customer_data[$key]['sale_strip_quantity'] = $invoice['sale_strip_quantity'];
            $customer_data[$key]['sale_quantity'] = $invoice['sale_quantity'];
            $customer_data[$key]['sale_batch'] = $invoice['sale_batch'];
            $customer_data[$key]['sale_taxable'] = $invoice['sale_taxable'];
            $customer_data[$key]['sale_discount_percent'] = $invoice['sale_discount_percent'];
            $original_price = (100 * $invoice['sale_taxable']) / (100 - $invoice['sale_discount_percent']);
            $customer_data[$key]['sale_discount'] = $original_price - $invoice['sale_taxable'];
            $customer_data[$key]['sale_cgst'] = $invoice['sale_cgst'];
            $customer_data[$key]['sale_sgst'] = $invoice['sale_sgst'];
            $customer_data[$key]['sale_grand_discount'] = $invoice['sale_total'] * $invoice['sale_grand_discount']  / 100;
            $customer_data[$key]['sale_total'] = $invoice['sale_total'];
            $customer_data[$key]['sale_return'] = $invoice['sale_return'];
            $customer_data[$key]['sale_return_date'] = $invoice['sale_return_date'];
        }
        $sql = "SELECT sum(sale_cgst),sale_cgst_percent FROM `sales` join `customers` on sales.sale_customer=customers.customer_ID WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= " GROUP BY sale_cgst_percent";
        // pr($sql);
        $data = $this->db->query($sql)->result_array();
        $daily_gst_data = null;

        foreach ($data as $key => $val) {
            // pr($data,1);
            $daily_gst_data[$key]['sale_cgst'] = $val['sum(sale_cgst)'];
            $daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
        }

        $sql = "SELECT medicines.medicine_hsn,sum(sales.sale_sgst) as sgst, sum(sales.sale_cgst) as cgst FROM `sales` INNER JOIN medicines ON medicines.medicine_id = sales.sale_medicine_id WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= " GROUP BY medicines.medicine_hsn";
        // pr($sql);
        $hsndata = $this->db->query($sql)->result_array();
        $hsn_daily_gst_data = null;

        foreach ($hsndata as $key => $val) {
            // pr($hsndata,1);
            $hsn_daily_gst_data[$key]['sale_cgst'] = $val['cgst'];
            $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
        }

        #pr($customer_data,1);
        #$package=$this->packages_model->get_list();

        if ($this->input->post('key')) {
            $this->load->view('console/sale/report_day_wise_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/sale/gst_record_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }
    
     public function report_daily_wise_export()
    {
        $post_data = $this->input->get();
        $period_start = $this->input->get('start');
        $period_end = $this->input->get('end');
        $customer_name = $this->input->get('customer_name');
        $customer_gst = $this->input->get('customer_gst');
        #echo $package_name;
        $sql = "SELECT customers.*,sales.sale_date,sales.sale_return,sales.sale_grand_discount,sales.sale_return_date,sales.sale_invoice,sum(sale_taxable) as sale_taxable,sum(sale_discount_percent) as sale_discount_percent,sum(sale_cgst) as sale_cgst,sum(sale_sgst) as sale_sgst,sum(sale_total) as sale_total  FROM `sales` join `customers` on sales.sale_customer=customers.customer_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d')  >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= "AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= "AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= "GROUP BY sale_invoice";
        # echo $sql;
        # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
        $sale = $this->db->query($sql)->result_array();
        # pr($sale);
        $customer_data = null;
        foreach ($sale as $key => $invoice) {

            $customer_data[$key]['customer_name'] = $invoice['customer_name'];
            $customer_data[$key]['customer_gst'] = $invoice['customer_gst'];
            $customer_data[$key]['sale_invoice'] = $invoice['sale_invoice'];
            $customer_data[$key]['sale_date'] = $invoice['sale_date'];
            $customer_data[$key]['sale_loose_quantity'] = $invoice['sale_loose_quantity'];
            $customer_data[$key]['sale_strip_quantity'] = $invoice['sale_strip_quantity'];
            $customer_data[$key]['sale_quantity'] = $invoice['sale_quantity'];
            $customer_data[$key]['sale_batch'] = $invoice['sale_batch'];
            $customer_data[$key]['sale_taxable'] = $invoice['sale_taxable'];
            $customer_data[$key]['sale_discount_percent'] = $invoice['sale_discount_percent'];
            $original_price = (100 * $invoice['sale_taxable']) / (100 - $invoice['sale_discount_percent']);
            $customer_data[$key]['sale_discount'] = $original_price - $invoice['sale_taxable'];
            $customer_data[$key]['sale_cgst'] = $invoice['sale_cgst'];
            $customer_data[$key]['sale_sgst'] = $invoice['sale_sgst'];
            $customer_data[$key]['sale_grand_discount'] = $invoice['sale_total'] * $invoice['sale_grand_discount']  / 100;
            $customer_data[$key]['sale_total'] = $invoice['sale_total'];
            $customer_data[$key]['sale_return'] = $invoice['sale_return'];
            $customer_data[$key]['sale_return_date'] = $invoice['sale_return_date'];
        }
        $sql = "SELECT sum(sale_cgst),sum(sale_sgst),sum(sales.sale_taxable) as sale_taxable,sale_cgst_percent,sale_sgst_percent FROM `sales` join `customers` on sales.sale_customer=customers.customer_ID WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= " GROUP BY sale_cgst_percent";
        // pr($sql);
        $data = $this->db->query($sql)->result_array();
        $daily_gst_data = null;

        foreach ($data as $key => $val) {
            // pr($data,1);
             $daily_gst_data[$key]['sale_cgst'] = $val['sum(sale_cgst)'];
            $daily_gst_data[$key]['sale_sgst'] = $val['sum(sale_sgst)'];
            $daily_gst_data[$key]['sale_taxable'] = $val['sale_taxable'];
            $daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
            $daily_gst_data[$key]['sale_sgst_percent'] = $val['sale_sgst_percent'];
            $daily_gst_data[$key]['total_sale_taxable'] += $val['sale_taxable'];
            
            // $daily_gst_data[$key]['sale_cgst'] = $val['sum(sale_cgst)'];
            // $daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
        }

        $sql = "SELECT medicines.medicine_hsn,sales.sale_strip_quantity as sale_strip_quantity ,sum(sales.sale_sgst) as sgst, sum(sales.sale_cgst) as cgst ,sum(sales.sale_rate) as sale_rate,sum(sales.sale_taxable) as sale_taxable,sales.sale_cgst_percent,sales.sale_discount_percent as sale_discount_percent FROM `sales` INNER JOIN medicines ON medicines.medicine_id = sales.sale_medicine_id WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= " GROUP BY medicines.medicine_hsn";
        // pr($sql);
        $hsndata = $this->db->query($sql)->result_array();
        $hsn_daily_gst_data = null;

        foreach ($hsndata as $key => $val) {
            // pr($hsndata,1);
            $hsn_daily_gst_data[$key]['sale_strip_quantity'] = $val['sale_strip_quantity'];
            $hsn_daily_gst_data[$key]['sale_cgst'] = $val['cgst'];
            $hsn_daily_gst_data[$key]['sale_sgst'] = $val['sgst'];
            $hsn_daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
            $hsn_daily_gst_data[$key]['sale_taxable'] = ($val['sale_taxable']*$val['sale_strip_quantity']);
            $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
            $hsn_daily_gst_data[$key]['total_sale_taxable'] += ( $val['sale_taxable']*$val['sale_strip_quantity']);
            // $hsn_daily_gst_data[$key]['sale_cgst'] = $val['cgst'];
            // $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
        }

        #pr($customer_data,1);
         $fileName = 'purchse-'.time().'.xlsx';  
		// load excel library
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
    //   $objPHPExcel->getActiveSheet()
    // ->getStyle('A1:E1')
    // ->getFill()
    // ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    // ->getStartColor()
    // ->setRGB('FF8080');
       
        // set Header//Purchase Batch
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sale Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Customer GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Sale Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Taxable');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Total');
         
      
        // set Row
        $rowCount = 2;
       // pr($gst_data);
        $totalCount = count($customer_data)+3;
        $total_sale='';
        foreach ($customer_data as $key =>$list) {
            
             $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['sale_invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['customer_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,'N/A');
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,$list['sale_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['sale_taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['sale_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list['sale_sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list['sale_total']);
            $total_sale_taxable+=$list['sale_taxable'];
            $total_sale_cgst+=$list['sale_cgst'];
            $total_sale_sgst+=$list['sale_sgst'];
            $total_sale+=$list['sale_total'];
            $rowCount++;
        }
        //total footer
        $objPHPExcel->getActiveSheet()->SetCellValue('A' .$totalCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' .$totalCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' .$totalCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $totalCount, $total_sale_taxable);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $totalCount, $total_sale_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $totalCount,$total_sale_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $totalCount, $total_sale);
        
        
        $rowCoun = 2;
        
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Sale Taxable');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total HSN CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Total HSN SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'GST Percent');
        $totalCoun = count($hsn_daily_gst_data)+3;
        
        foreach ($hsn_daily_gst_data as $key =>$list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($rowCoun), $list['sale_strip_quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . ($rowCoun), $list['sale_taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($rowCoun), $list['medicine_hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . ($rowCoun), $list['sale_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . ($rowCoun), $list['medicine_hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($rowCoun), $list['sale_sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . ($rowCoun), $list['sale_cgst_percent']);
            $total_h_sale_cgst+=$list['sale_cgst'];
            $total_h_sale_sgst+=$list['sale_sgst'];
            $total_h_sale_taxable+=$list['sale_taxable'];
            $total_quantity+=$list['sale_strip_quantity'];
            $rowCoun++;
        }
        //total footer
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($totalCoun),$total_quantity);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . ($totalCoun),$total_h_sale_taxable);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($totalCoun), 'Total ');
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . ($totalCoun),$total_h_sale_cgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . ($totalCoun), 'Total ');
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($totalCoun),$total_h_sale_sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . ($totalCoun),'Total ');
        
        $rowCou = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Sale CGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Total Purchase CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Sale SGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Total Sale SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Total Sale Taxable');
        $totalCou = count($daily_gst_data)+3;
        
      foreach ($daily_gst_data as $key =>$list) {
            
        $objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($rowCou), $list['sale_cgst_percent']);
        $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($rowCou),$list['sale_cgst']);
        $objPHPExcel->getActiveSheet()->SetCellValue('S' . ($rowCou), $list['sale_sgst_percent']);
        $objPHPExcel->getActiveSheet()->SetCellValue('T' . ($rowCou),$list['sale_sgst']);
        $objPHPExcel->getActiveSheet()->SetCellValue('U' . ($rowCou),$list['sale_taxable']);
        $total_d_sale_cgst+=$list['sale_cgst'];
        $total_d_sale_sgst+=$list['sale_sgst'];
        $total_d_sale_taxable+=$list['total_sale_taxable'];
        $rowCou++;
        }
        //FOTTER
        $objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($totalCou), 'Total cgst');
        $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($totalCou),'Total '+$total_d_sale_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('S' . ($totalCou), 'Total sgst');
        $objPHPExcel->getActiveSheet()->SetCellValue('T' . ($totalCou),'Total '+$total_d_sale_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('U' . ($totalCou),'Total '+$total_d_sale_taxable);
     
        $filename = "day_wise". date("Y-m-d-H-i-s").".csv";
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
		$objWriter->save('php://output'); 
     
    }
 public function report_gstin_wise_export()
    {
        $post_data = $this->input->get();
        $period_start = $this->input->get('start');
        $period_end = $this->input->get('end');
        #echo $package_name;
        $sql = "SELECT customers.*,sales.sale_date,sales.sale_return,sales.sale_return_date,sales.sale_invoice,sum(sale_taxable) as sale_taxable,sum(sale_discount_percent) as sale_discount_percent,sum(sale_cgst) as sale_cgst,sum(sale_sgst) as sale_sgst,sum(sale_total) as sale_total  FROM `sales` join `customers` on sales.sale_customer=customers.customer_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d')<='" . $period_end . "'";
        }
        $sql .= "GROUP BY customer_name";
       // $sql .= "GROUP BY customer_gst";
        $sale = $this->db->query($sql)->result_array();
        # pr($sale);
        $customer_data = null;
        foreach ($sale as $key => $invoice) {

            $customer_data[$key]['customer_name'] = $invoice['customer_name'];
            $customer_data[$key]['customer_gst'] = $invoice['customer_gst'];
            $customer_data[$key]['sale_invoice'] = $invoice['sale_invoice'];
            $customer_data[$key]['sale_date'] = $invoice['sale_date'];
            $customer_data[$key]['sale_loose_quantity'] = $invoice['sale_loose_quantity'];
            $customer_data[$key]['sale_strip_quantity'] = $invoice['sale_strip_quantity'];
            $customer_data[$key]['sale_quantity'] = $invoice['sale_quantity'];
            $customer_data[$key]['sale_batch'] = $invoice['sale_batch'];
            $customer_data[$key]['sale_taxable'] = $invoice['sale_taxable'];
            $customer_data[$key]['sale_discount_percent'] = $invoice['sale_discount_percent'];
            $original_price = (100 * $invoice['sale_taxable']) / (100 - $invoice['sale_discount_percent']);
            $customer_data[$key]['sale_discount'] = $original_price - $invoice['sale_taxable'];
            $customer_data[$key]['sale_cgst'] = $invoice['sale_cgst'];
            $customer_data[$key]['sale_sgst'] = $invoice['sale_sgst'];
            $customer_data[$key]['sale_total'] = $invoice['sale_total'];
            $customer_data[$key]['sale_return'] = $invoice['sale_return'];
            $customer_data[$key]['sale_return_date'] = $invoice['sale_return_date'];
        }
         
        
        #$package=$this->packages_model->get_list();
        $sql = "SELECT sales.sale_date,customers.customer_name,customers.customer_gst,sum(sale_total * sale_grand_discount / 100) as sale_grand_discount FROM `sales` join `customers` on sales.sale_customer=customers.customer_ID WHERE 1=1";
        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

       
        $sale_grand_dis_data = $this->db->query($sql)->result_array();

        $sql = "SELECT sum(sale_cgst),sum(sale_sgst),sum(sales.sale_taxable) as sale_taxable,sale_cgst_percent,sale_sgst_percent FROM `sales` join `customers` on sales.sale_customer=customers.customer_ID WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d')<='" . $period_end . "'";
        }

        
        $sql .= " GROUP BY sale_cgst_percent";
        // pr($sql);
        $data = $this->db->query($sql)->result_array();
        $daily_gst_data = null;
        foreach ($data as $key => $val) {
            // pr($data,1);
            $daily_gst_data[$key]['sale_cgst'] = $val['sum(sale_cgst)'];
            $daily_gst_data[$key]['sale_sgst'] = $val['sum(sale_sgst)'];
            $daily_gst_data[$key]['sale_taxable'] = $val['sale_taxable'];
            $daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
            $daily_gst_data[$key]['sale_sgst_percent'] = $val['sale_sgst_percent'];
            $daily_gst_data[$key]['total_sale_taxable'] += $val['sale_taxable'];
        }

        $sql = "SELECT medicines.medicine_hsn,sales.sale_strip_quantity as sale_strip_quantity ,sum(sales.sale_sgst) as sgst, sum(sales.sale_cgst) as cgst ,sum(sales.sale_rate) as sale_rate,sum(sales.sale_taxable) as sale_taxable,sales.sale_cgst_percent,sales.sale_discount_percent as sale_discount_percent FROM `sales` INNER JOIN medicines ON medicines.medicine_id = sales.sale_medicine_id WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

       
        $sql .= " GROUP BY medicines.medicine_hsn";
        // pr($sql);
        $hsndata = $this->db->query($sql)->result_array();
        $hsn_daily_gst_data = null;

        foreach ($hsndata as $key => $val) {
            // pr($hsndata,1);sale_strip_quantity
            $hsn_daily_gst_data[$key]['sale_strip_quantity'] = $val['sale_strip_quantity'];
            $hsn_daily_gst_data[$key]['sale_cgst'] = $val['cgst'];
            $hsn_daily_gst_data[$key]['sale_sgst'] = $val['sgst'];
            $hsn_daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
            $hsn_daily_gst_data[$key]['sale_taxable'] = ($val['sale_taxable']);
            $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
            $hsn_daily_gst_data[$key]['total_sale_taxable'] += ( $val['sale_taxable']);
        }


        
            // $this->load->view('console/sale/report_gst_wise_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'sale_grand_dis_data' => $sale_grand_dis_data, 'start' => $period_start, 'end' => $period_end));
            
         $fileName = 'purchse-'.time().'.xlsx';  
		// load excel library
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
    //   $objPHPExcel->getActiveSheet()
    // ->getStyle('A1:E1')
    // ->getFill()
    // ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    // ->getStartColor()
    // ->setRGB('FF8080');
       
        // set Header//Purchase Batch
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'customer GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Sale Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Taxable');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Total');
         
      
        // set Row
        $rowCount = 2;
       // pr($gst_data);
        $totalCount = count($customer_data)+3;
        $total_sale='';
        foreach ($customer_data as $key =>$list) {
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['customer_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount,$list['customer_gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$list['sale_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['sale_taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['sale_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['sale_sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list['sale_total']);
            $total_sale_taxable+=$list['sale_taxable'];
            $total_sale_cgst+=$list['sale_cgst'];
            $total_sale_sgst+=$list['sale_sgst'];
            $total_sale+=$list['sale_total'];
            $rowCount++;
        }
        //total footer
        $objPHPExcel->getActiveSheet()->SetCellValue('A' .$totalCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $totalCount, $total_sale_taxable);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $totalCount, $total_sale_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $totalCount,$total_sale_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $totalCount, $total_sale);
        
        
        $rowCoun = 2;
        
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Sale Taxable');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total HSN CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Total HSN SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'GST Percent');
        $totalCoun = count($hsn_daily_gst_data)+3;
        
        foreach ($hsn_daily_gst_data as $key =>$list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($rowCoun), $list['sale_strip_quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . ($rowCoun), $list['sale_taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($rowCoun), $list['medicine_hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . ($rowCoun), $list['sale_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . ($rowCoun), $list['medicine_hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($rowCoun), $list['sale_sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . ($rowCoun), $list['sale_cgst_percent']);
            $total_h_sale_cgst+=$list['sale_cgst'];
            $total_h_sale_sgst+=$list['sale_sgst'];
            $total_h_sale_taxable+=$list['sale_taxable'];
            $total_quantity+=$list['sale_strip_quantity'];
            $rowCoun++;
        }
        //total footer
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($totalCoun),$total_quantity);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . ($totalCoun),$total_h_sale_taxable);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($totalCoun), 'Total ');
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . ($totalCoun),$total_h_sale_cgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . ($totalCoun), 'Total ');
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($totalCoun),$total_h_sale_sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . ($totalCoun),'Total ');
        
        $rowCou = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Sale CGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Total Purchase CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Sale SGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Total Sale SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Total Sale Taxable');
        $totalCou = count($daily_gst_data)+3;
        
      foreach ($daily_gst_data as $key =>$list) {
            
        $objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($rowCou), $list['sale_cgst_percent']);
        $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($rowCou),$list['sale_cgst']);
        $objPHPExcel->getActiveSheet()->SetCellValue('S' . ($rowCou), $list['sale_sgst_percent']);
        $objPHPExcel->getActiveSheet()->SetCellValue('T' . ($rowCou),$list['sale_sgst']);
        $objPHPExcel->getActiveSheet()->SetCellValue('U' . ($rowCou),$list['sale_taxable']);
        $total_d_sale_cgst+=$list['sale_cgst'];
        $total_d_sale_sgst+=$list['sale_sgst'];
        $total_d_sale_taxable+=$list['total_sale_taxable'];
        $rowCou++;
        }
        //FOTTER
        $objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($totalCou), 'Total cgst');
        $objPHPExcel->getActiveSheet()->SetCellValue('R' . ($totalCou),'Total '+$total_d_sale_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('S' . ($totalCou), 'Total sgst');
        $objPHPExcel->getActiveSheet()->SetCellValue('T' . ($totalCou),'Total '+$total_d_sale_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('U' . ($totalCou),'Total '+$total_d_sale_taxable);
        
       $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'E05CC2')
            )
        )

);
        $filename = "gstin_wise". date("Y-m-d-H-i-s").".csv";
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
		$objWriter->save('php://output'); 
        
    }
    public function report_gstin_wise()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $customer_gst = $this->input->post('customer_gst');
        #echo $package_name;
        $sql = "SELECT customers.*,sales.sale_date,sales.sale_return,sales.sale_return_date,sales.sale_invoice,sum(sale_taxable) as sale_taxable,sum(sale_discount_percent) as sale_discount_percent,sum(sale_cgst) as sale_cgst,sum(sale_sgst) as sale_sgst,sum(sale_total) as sale_total  FROM `sales` join `customers` on sales.sale_customer=customers.customer_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND DATE_FORMAT(sale_date, '%Y-%m-%d')<='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= "AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= "AND customer_gst like '" . $customer_gst . "%'";
        }
         $sql .= "GROUP BY customer_name";
        //$sql .= "GROUP BY customer_gst";
        # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
        $sale = $this->db->query($sql)->result_array();
        # pr($sale);
        $customer_data = null;
        foreach ($sale as $key => $invoice) {

            $customer_data[$key]['customer_name'] = $invoice['customer_name'];
            $customer_data[$key]['customer_gst'] = $invoice['customer_gst'];
            $customer_data[$key]['sale_invoice'] = $invoice['sale_invoice'];
            $customer_data[$key]['sale_date'] = $invoice['sale_date'];
            $customer_data[$key]['sale_loose_quantity'] = $invoice['sale_loose_quantity'];
            $customer_data[$key]['sale_strip_quantity'] = $invoice['sale_strip_quantity'];
            $customer_data[$key]['sale_quantity'] = $invoice['sale_quantity'];
            $customer_data[$key]['sale_batch'] = $invoice['sale_batch'];
            $customer_data[$key]['sale_taxable'] = $invoice['sale_taxable'];
            $customer_data[$key]['sale_discount_percent'] = $invoice['sale_discount_percent'];
            $original_price = (100 * $invoice['sale_taxable']) / (100 - $invoice['sale_discount_percent']);
            $customer_data[$key]['sale_discount'] = $original_price - $invoice['sale_taxable'];
            $customer_data[$key]['sale_cgst'] = $invoice['sale_cgst'];
            $customer_data[$key]['sale_sgst'] = $invoice['sale_sgst'];
            $customer_data[$key]['sale_total'] = $invoice['sale_total'];
            $customer_data[$key]['sale_return'] = $invoice['sale_return'];
            $customer_data[$key]['sale_return_date'] = $invoice['sale_return_date'];
        }
        
        #pr($customer_data,1);
        #$package=$this->packages_model->get_list();
        $sql = "SELECT sales.sale_date,customers.customer_name,customers.customer_gst,sum(sale_total * sale_grand_discount / 100) as sale_grand_discount FROM `sales` join `customers` on sales.sale_customer=customers.customer_ID WHERE 1=1";
        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sale_grand_dis_data = $this->db->query($sql)->result_array();

        $sql = "SELECT sum(sale_cgst),sum(sale_sgst),sum(sales.sale_taxable) as sale_taxable,sale_cgst_percent,sale_sgst_percent FROM `sales` join `customers` on sales.sale_customer=customers.customer_ID WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d')<='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= " GROUP BY sale_cgst_percent";
        // pr($sql);
        $data = $this->db->query($sql)->result_array();
        $daily_gst_data = null;
        foreach ($data as $key => $val) {
            // pr($data,1);
            $daily_gst_data[$key]['sale_cgst'] = $val['sum(sale_cgst)'];
            $daily_gst_data[$key]['sale_sgst'] = $val['sum(sale_sgst)'];
            $daily_gst_data[$key]['sale_taxable'] = $val['sale_taxable'];
            $daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
            $daily_gst_data[$key]['sale_sgst_percent'] = $val['sale_sgst_percent'];
        }

        $sql = "SELECT medicines.medicine_hsn,sales.sale_strip_quantity as sale_strip_quantity ,sum(sales.sale_sgst) as sgst, sum(sales.sale_cgst) as cgst ,sum(sales.sale_rate) as sale_rate,sum(sales.sale_taxable) as sale_taxable,sales.sale_cgst_percent,sales.sale_discount_percent as sale_discount_percent FROM `sales` INNER JOIN medicines ON medicines.medicine_id = sales.sale_medicine_id WHERE 1=1";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= " GROUP BY medicines.medicine_hsn";
        // pr($sql);
        $hsndata = $this->db->query($sql)->result_array();
        $hsn_daily_gst_data = null;

        foreach ($hsndata as $key => $val) {
            // pr($hsndata,1);sale_strip_quantity
            $hsn_daily_gst_data[$key]['sale_strip_quantity'] = $val['sale_strip_quantity'];
            $hsn_daily_gst_data[$key]['sale_cgst'] = $val['cgst'];
            $hsn_daily_gst_data[$key]['sale_sgst'] = $val['sgst'];
            $hsn_daily_gst_data[$key]['sale_cgst_percent'] = $val['sale_cgst_percent'];
            $hsn_daily_gst_data[$key]['sale_taxable'] =($val['sale_taxable']);
            $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
        }
//pr(count($customer_data),1);
        if ($this->input->post('key')) {
            $this->load->view('console/sale/report_gst_wise_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'sale_grand_dis_data' => $sale_grand_dis_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/sale/gst_record_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'sale_grand_dis_data' => $sale_grand_dis_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }
    
    
    public function supplier_medicine_details()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $supplier_id = $this->input->post('supplier_id');
        $alldata = null;
        $supplier_names = $this->db->query("SELECT * FROM suppliers")->result_array();
        // pr($supplier_names,1);
        $sql = "SELECT 
suppliers.supplier_name,
purchases.purchase_date,
round(sum(purchases.purchase_total)) as total_purchase,
purchases.purchase_invoice FROM purchases 
join suppliers 
on purchases.purchase_supplier=suppliers.supplier_id  
WHERE 1 = 1 ";
        if (!empty($supplier_id)) {
            $sql .= "AND supplier_id = " . $supplier_id . "";
        }
        if (!empty($period_start)) {
            $sql .= " AND purchase_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND purchase_date<='" . $period_end . "'";
        }
        $sql .= " GROUP BY purchase_invoice";
        $purchase = $this->db->query($sql)->result_array();

        foreach ($purchase as $k => $v) {
            $alldata[$v['purchase_date']][] = array(
                'date' => $v['purchase_date'],
                'supplier' => $v['supplier_name'],
                'debit' => $v['total_purchase'],
                'credit' => 0,
                'note' => 'purchase',
                'number' => $v['purchase_invoice']
            );
        }
        //pr($alldata,1);
        $sql = "
SELECT suppliers.supplier_name,
return_purchases.return_purchase_date,return_purchases.return_purchase_ref,
round(sum(return_purchases.return_purchase_total)) as total_return_purchase,
return_purchases.return_purchase_entry_number FROM `return_purchases` join `suppliers` on 
return_purchases.return_purchase_supplier=suppliers.supplier_id  WHERE 1 = 1";
        if (!empty($supplier_id)) {
            $sql .= " AND supplier_id =" . $supplier_id . " ";
        }
        if (!empty($period_start)) {
            $sql .= " AND return_purchase_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND return_purchase_date<='" . $period_end . "'";
        }
        $sql .= " GROUP BY return_purchase_entry_number";

        $return_purchase = $this->db->query($sql)->result_array();

        foreach ($return_purchase as $k => $v) {
            $alldata[$v['return_purchase_date']][] = array(
                'date' => $v['return_purchase_date'],
                'supplier' => $v['supplier_name'],
                'debit' => 0,
                'credit' => $v['total_return_purchase'],
                'note' => 'return',
                'number' => $v['return_purchase_ref']
            );
        }

        $sql = "SELECT suppliers.supplier_name,
payments.payment_date,payments.payment_ID,
payments.payment_paid_amount,
payments.payment_note FROM payments
 join suppliers on payments.payment_suppliers=suppliers.supplier_id  WHERE 1 = 1";
        if (!empty($supplier_id)) {
            $sql .= " AND supplier_id = " . $supplier_id . " ";
        }
        if (!empty($period_start)) {
            $sql .= " AND payment_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND payment_date<='" . $period_end . "'";
        }

        $payment = $this->db->query($sql)->result_array();
        foreach ($payment as $k => $v) {

            $alldata[$v['payment_date']][] = array(
                'date' => $v['payment_date'],
                'supplier' => $v['supplier_name'],
                'debit' => 0,
                'credit' => $v['payment_paid_amount'],
                'note' => 'payment',
                'number' => $v['payment_ID']
            );
        }
        $sql = "SELECT suppliers.supplier_name,
expiry_returns.expiry_return_date,expiry_returns.expiry_return_ref,
 round(sum(expiry_returns.expiry_return_total)) as total_expiry_return,
 expiry_returns.expiry_return_entry_number FROM `expiry_returns` 
 join  `suppliers` on expiry_returns.expiry_return_supplier=suppliers.supplier_id  WHERE 1 = 1";
        if (!empty($supplier_id)) {
            $sql .= " AND supplier_id = " . $supplier_id . " ";
        }
        if (!empty($period_start)) {
            $sql .= " AND expiry_return_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND expiry_return_date<='" . $period_end . "'";
        }
        $sql .= " GROUP BY expiry_return_entry_number";
        $expiry_return = $this->db->query($sql)->result_array();

        foreach ($expiry_return as $k => $v) {
            $alldata[$v['expiry_return_date']][] = array(
                'date' => $v['expiry_return_date'],
                'supplier' => $v['supplier_name'],
                'debit' => 0,
                'credit' => $v['total_expiry_return'],
                'note' => 'expiry',
                'number' => $v['expiry_return_entry_number']
            );
        }
        //pr($alldata, 1);
        if (!empty($this->input->post())) {
            $this->load->view('console/sale/supplier_medicine', array('alldata' => $alldata, 'start' => $period_start, 'end' => $period_end, 'supplier' => $supplier_names));
        } else {

            $this->load->view('console/sale/supplier_medicine_tpl', array('alldata' => $alldata, 'start' => $period_start, 'end' => $period_end, 'supplier' => $supplier_names));
        }
    }

    public function customer_payment_report()
    {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $alldata = null;
        $customer_names = $this->db->query("SELECT * FROM customers")->result_array();

        // $sql = "SELECT sales.sale_date ,sales.sale_invoice,sales.sale_total,sales.sale_total_paid,customers.customer_name FROM sales JOIN customers ON sales.sale_customer=customers.customer_ID  WHERE 1 = 1 ";

        // if (!empty($period_start)) {
        //     $sql .= "AND sales.sale_date >='" . $period_start . "'";
        // }
        // if (!empty($period_end)) {
        //     $sql .= "AND sales.sale_date<='" . $period_end . "'";
        // }

        // if (!empty($customer_name)) {
        //     $sql .= "AND customer_name like '%" . $customer_name . "%'";
        // }
        // $sale_data = $this->db->query($sql)->result_array();

        //  //pr($sale_data);
        // foreach ($sale_data as $k => $v) {
        //     $alldata[$v['sale_date']][] = array(
        //         'date' => $v['sale_date'],
        //         'customer' => $v['customer_name'],
        //         'debit' => $v['sale_total'],
        //         'credit' => 0,
        //         'note' => 'sale',
        //         'number' => $v['sale_invoice']
        //     );
        // }

        $sql = "SELECT customer_payments.customer_payment_invoice,customer_payments.customer_payment_date,customer_payments.customer_payment_paid_amount,customers.customer_name FROM customer_payments JOIN customers ON customer_payments.customer_payment_customer=customers.customer_ID WHERE 1 = 1 ";
        //print_r($sql);
        if (!empty($period_start)) {
            $sql .= "AND customer_payments.customer_payment_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND customer_payments.customer_payment_date <='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= "AND customer_name like '%" . $customer_name . "%'";
        }
        $payment_data = $this->db->query($sql)->result_array();
        foreach ($payment_data as $k => $v) {
            $alldata[$v['customer_payment_date']][] = array(
                'date' => $v['customer_payment_date'],
                'customer' => $v['customer_name'],
                'debit' => 0,
                'credit' => $v['customer_payment_paid_amount'],
                'note' => 'payment',
                'number' => $v['customer_payment_invoice']
            );
        }
        // pr($alldata, 1);
        if ($this->input->post('key')) {
            $this->load->view('console/sale/report_daily_customer', array('alldata' => $alldata, 'start' => $period_start, 'end' => $period_end, 'customer' => $customer_names));
        } else {

            $this->load->view('console/sale/report_daily_customer_tpl', array('alldata' => $alldata, 'start' => $period_start, 'end' => $period_end, 'customer' => $customer_names));
        }
    }
    
    
          public function mailInvoice()
            {
                // Set JSON header to inform client about JSON response
                header('Content-Type: application/json');
                
                // Clear output buffer to avoid accidental output before JSON
                if (ob_get_length()) {
                    ob_clean();
                }
            
                $invoice_id = $this->input->post('invoice_id'); 
            
                if (!$invoice_id) {
                    echo json_encode(['status' => 'error', 'message' => 'Invoice ID missing']);
                    exit;
                }
            
                $invoice_number = base64_decode($invoice_id);
            
                $data = $this->{$this->targetModel}->get_list(['sale_invoice' => $invoice_number]);
            
                if (empty($data)) {
                    echo json_encode(['status' => 'error', 'message' => 'Invoice not found']);
                    exit;
                }
            
                $customer = $data[0];
                if (empty($customer['email'])) {
                    echo json_encode(['status' => 'error', 'message' => 'Customer email not found']);
                    exit;
                }
            
                $fullDataArray = [];
                foreach ($data as $value) {
                    $fullDataArray['total_sale_total'] = ($fullDataArray['total_sale_total'] ?? 0) + $value['sale_total'];
                }
            
                $counter = count($data);
            
                if ($counter < 20) {
                    $invoice_html = $this->load->view('console/sale/print_mail', [
                        'data' => $data,
                        'fullDataArray' => $fullDataArray,
                        'fulldata' => $data
                    ], true);
                } else {
                    $nop = 0;
                    $nthPage = 0;
                    $pagedData = array_chunk($data, 20);
            
                    foreach ($pagedData as $key => $val) {
                        $nthPage++;
                        foreach ($val as $keys => $value) {
                            $pagedDatas[$key][$nop] = $value;
                            $nop++;
                        }
                    }
            
                    $invoice_html = $this->load->view('console/sale/print_mail', [
                        'fulldata' => $data,
                        'fullDataArray' => $fullDataArray,
                        'nthPage' => $nthPage,
                        'count' => count($pagedData),
                        'data' => $data,
                        'counter' => 0
                    ], true);
                }
            
                $mailMeta = [
                    'to' => $customer['email'],
                    'subject' => 'Invoice #' . $invoice_number,
                    'body' => $invoice_html,
                    'from' => [
                        'email' => 'admin@msbbillings.in',
                        'name' => 'Do Not Reply'
                    ],
                    'attachment' => '',
                ];
            
                if ($this->sendmail($mailMeta, TRUE)) {
                    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to send email']);
                }
                exit;
            }

        
        public function downloadPdf()
        {
         $invoice_number =base64_decode($this->uri->segment(4));
         $data = $this->{$this->targetModel}->get_list(['sale_invoice' => $invoice_number]);
            if(empty($data)) {
                echo json_encode(['status' => 'error', 'message' => 'Invoice data not found']);
                return;
            }
            // Prepare HTML
            $fullDataArray = [];
            foreach ($data as $value) {
                $fullDataArray['total_sale_total'] = ($fullDataArray['total_sale_total'] ?? 0) + $value['sale_total'];
            }
    
            $invoice_html = $this->load->view('console/sale/print_mail', [
                'data' => $data,
                'fullDataArray' => $fullDataArray
            ], true);
    
    
            
            $dir = FCPATH . "uploads/invoices/";
            if(!is_dir($dir)){
                mkdir($dir, 0777, true);
            }
            $customer = $data[0];
            $filename ="invoice_". $customer['sale_customer'] . ".pdf";
            $path = $dir . $filename;
    
            file_put_contents($path, $pdf_content);
            $this->pdf->generate($invoice_html, $filename, false);
        }


}
