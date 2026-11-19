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

        // Enrich sold items with purchase intelligence (cost rate, supplier, invoice, margins)
        if (!empty($data) && is_array($data)) {
            foreach ($data as $k => $val) {
                $purchase = null;
                if (!empty($val['sale_medicine_id']) && !empty($val['sale_batch'])) {
                    $purchase = $this->db->select('p.*, s.supplier_name, s.supplier_contact, s.supplier_address')
                        ->from('purchases p')
                        ->join('suppliers s', 's.supplier_ID = p.purchase_supplier', 'left')
                        ->where('p.purchase_medicine_id', $val['sale_medicine_id'])
                        ->where('p.purchase_batch', $val['sale_batch'])
                        ->order_by('p.purchase_ID', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row_array();
                }
                if (!$purchase && !empty($val['sale_medicine_id'])) {
                    $purchase = $this->db->select('p.*, s.supplier_name, s.supplier_contact, s.supplier_address')
                        ->from('purchases p')
                        ->join('suppliers s', 's.supplier_ID = p.purchase_supplier', 'left')
                        ->where('p.purchase_medicine_id', $val['sale_medicine_id'])
                        ->order_by('p.purchase_ID', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row_array();
                }
                $data[$k]['purchase'] = $purchase;
            }
        }
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
        $is_ajax = $this->input->is_ajax_request() || ($this->input->post('key') == 'ajax_resp') || $this->input->get('ajax');

        $period_start  = $this->input->get_post('start');
        $period_end    = $this->input->get_post('end');
        $sale_invoice  = $this->input->get_post('sale_invoice');
        $medicine_name = $this->input->get_post('medicine_name');
        $customer_name = $this->input->get_post('customer_name');
        $sale_batch    = $this->input->get_post('sale_batch');

        if (empty($period_start) && empty($period_end) && !$this->input->post()) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
            $period_end   = date('Y-m-d');
        }

        $report_data = $this->_get_daily_sale_medicine_data(
            $period_start,
            $period_end,
            $sale_invoice,
            $medicine_name,
            $customer_name,
            $sale_batch
        );

        $report_data['start']         = $period_start;
        $report_data['end']           = $period_end;
        $report_data['sale_invoice']  = !empty($sale_invoice) ? $sale_invoice : '';
        $report_data['medicine_name'] = !empty($medicine_name) ? $medicine_name : '';
        $report_data['customer_name'] = !empty($customer_name) ? $customer_name : '';
        $report_data['sale_batch']    = !empty($sale_batch) ? $sale_batch : '';

        if ($is_ajax) {
            $this->load->view('console/sale/report_daily_medicine', $report_data);
        } else {
            $this->render($report_data, 'report_daily_medicine_tpl');
        }
    }

    private function _get_daily_sale_medicine_data($period_start = null, $period_end = null, $sale_invoice = null, $medicine_name = null, $customer_name = null, $sale_batch = null)
    {
        $sql = "SELECT sales.*, medicines.medicine_name, medicines.medicine_hsn, medicines.medicine_manufacturer, "
             . "customers.customer_name, customers.customer_contact, customers.customer_gst "
             . "FROM `sales` "
             . "LEFT JOIN `medicines` ON sales.sale_medicine_id = medicines.medicine_id "
             . "LEFT JOIN `customers` ON sales.sale_customer = customers.customer_ID "
             . "WHERE (sales.sale_return = 0 OR sales.sale_return IS NULL) ";

        if (!empty($period_start) && !empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sales.sale_date, '%Y-%m-%d') BETWEEN " . $this->db->escape($period_start) . " AND " . $this->db->escape($period_end);
        } elseif (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sales.sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        } elseif (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sales.sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }

        if (!empty($sale_invoice)) {
            $sql .= " AND sales.sale_invoice LIKE " . $this->db->escape('%' . $sale_invoice . '%');
        }
        if (!empty($medicine_name)) {
            $sql .= " AND medicines.medicine_name LIKE " . $this->db->escape('%' . $medicine_name . '%');
        }
        if (!empty($customer_name)) {
            $sql .= " AND customers.customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($sale_batch)) {
            $sql .= " AND sales.sale_batch LIKE " . $this->db->escape('%' . $sale_batch . '%');
        }

        $sql .= " ORDER BY sales.sale_date DESC, sales.sale_invoice DESC";

        $sale = $this->db->query($sql)->result_array();

        $medicine_data = array();
        $total_amount = 0;
        $total_strip_quantity = 0;
        $total_loose_quantity = 0;
        $distinct_medicines = array();
        $distinct_invoices = array();

        if (!empty($sale)) {
            foreach ($sale as $key => $invoice) {
                $med_name = isset($invoice['medicine_name']) ? $invoice['medicine_name'] : '';
                $inv_num  = isset($invoice['sale_invoice']) ? $invoice['sale_invoice'] : '';
                $strip_q  = (float)(isset($invoice['sale_strip_quantity']) ? $invoice['sale_strip_quantity'] : 0);
                $loose_q  = (float)(isset($invoice['sale_loose_quantity']) ? $invoice['sale_loose_quantity'] : 0);
                $tot      = (float)(isset($invoice['sale_total']) ? $invoice['sale_total'] : 0);

                if (!empty($med_name)) {
                    $distinct_medicines[$med_name] = true;
                }
                if (!empty($inv_num)) {
                    $distinct_invoices[$inv_num] = true;
                }

                $total_amount += $tot;
                $total_strip_quantity += $strip_q;
                $total_loose_quantity += $loose_q;

                $medicine_data[$key] = array(
                    'sale_id'              => isset($invoice['sale_id']) ? $invoice['sale_id'] : '',
                    'sale_invoice'         => $inv_num,
                    'sale_date'            => isset($invoice['sale_date']) ? $invoice['sale_date'] : '',
                    'medicine_name'        => $med_name,
                    'medicine_hsn'         => isset($invoice['medicine_hsn']) ? $invoice['medicine_hsn'] : '',
                    'medicine_manufacturer'=> isset($invoice['medicine_manufacturer']) ? $invoice['medicine_manufacturer'] : '',
                    'customer_name'        => isset($invoice['customer_name']) ? $invoice['customer_name'] : '',
                    'customer_contact'     => isset($invoice['customer_contact']) ? $invoice['customer_contact'] : '',
                    'customer_gst'         => isset($invoice['customer_gst']) ? $invoice['customer_gst'] : '',
                    'sale_batch'           => isset($invoice['sale_batch']) ? $invoice['sale_batch'] : '',
                    'sale_expire_month'    => isset($invoice['sale_expire_month']) ? $invoice['sale_expire_month'] : '',
                    'sale_expire_year'     => isset($invoice['sale_expire_year']) ? $invoice['sale_expire_year'] : '',
                    'sale_strip_quantity'  => $strip_q,
                    'sale_loose_quantity'  => $loose_q,
                    'sale_rate'            => (float)(isset($invoice['sale_rate']) ? $invoice['sale_rate'] : 0),
                    'sale_mrp'             => (float)(isset($invoice['sale_mrp']) ? $invoice['sale_mrp'] : 0),
                    'sale_taxable'         => (float)(isset($invoice['sale_taxable']) ? $invoice['sale_taxable'] : 0),
                    'sale_cgst'            => (float)(isset($invoice['sale_cgst']) ? $invoice['sale_cgst'] : 0),
                    'sale_sgst'            => (float)(isset($invoice['sale_sgst']) ? $invoice['sale_sgst'] : 0),
                    'sale_total'           => $tot,
                );
            }
        }

        return array(
            'medicine_data'        => $medicine_data,
            'total_items'          => count($medicine_data),
            'total_amount'         => $total_amount,
            'total_strip_quantity' => $total_strip_quantity,
            'total_loose_quantity' => $total_loose_quantity,
            'total_medicines'      => count($distinct_medicines),
            'total_invoices'       => count($distinct_invoices),
        );
    }

    public function daily_sale_medicine_export()
    {
        $period_start  = $this->input->get('start');
        $period_end    = $this->input->get('end');
        $sale_invoice  = $this->input->get('sale_invoice');
        $medicine_name = $this->input->get('medicine_name');
        $customer_name = $this->input->get('customer_name');
        $sale_batch    = $this->input->get('sale_batch');

        if (empty($period_start) && empty($period_end)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
            $period_end   = date('Y-m-d');
        }

        $rep = $this->_get_daily_sale_medicine_data($period_start, $period_end, $sale_invoice, $medicine_name, $customer_name, $sale_batch);
        $medicine_data = $rep['medicine_data'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Sale Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Invoice #');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Batch');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Expiry');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Strip Qty');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Loose Qty');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Rate (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'MRP (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total (₹)');

        $rowCount = 2;
        $total_strip = 0;
        $total_loose = 0;
        $total_amount = 0;

        if (!empty($medicine_data)) {
            $counter = 1;
            foreach ($medicine_data as $list) {
                $expiry = '';
                if (!empty($list['sale_expire_month']) || !empty($list['sale_expire_year'])) {
                    $expiry = $list['sale_expire_month'] . '/' . $list['sale_expire_year'];
                }
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['sale_date']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['sale_invoice']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, isset($list['customer_name']) ? $list['customer_name'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['medicine_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['sale_batch']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $expiry);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, (float)$list['sale_strip_quantity']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, (float)$list['sale_loose_quantity']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, (float)$list['sale_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, (float)$list['sale_mrp']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, (float)$list['sale_total']);

                $total_strip  += (float)$list['sale_strip_quantity'];
                $total_loose  += (float)$list['sale_loose_quantity'];
                $total_amount += (float)$list['sale_total'];
                $rowCount++;
            }
        }

        // Footer total
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_strip);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $total_loose);
        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $total_amount);

        $filename = "daily_sale_medicine_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    public function report_daily_wise()
    {
        $is_ajax = $this->input->is_ajax_request() || ($this->input->post('key') == 'ajax_resp') || $this->input->get('ajax');

        $period_start  = $this->input->get_post('start');
        $period_end    = $this->input->get_post('end');
        $customer_name = $this->input->get_post('customer_name');
        $customer_gst  = $this->input->get_post('customer_gst') ? $this->input->get_post('customer_gst') : $this->input->get_post('gst');
        $sale_invoice  = $this->input->get_post('sale_invoice');

        if (empty($period_start)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
        }
        if (empty($period_end)) {
            $period_end = date('Y-m-d');
        }

        $report_data = $this->_get_daily_wise_data($period_start, $period_end, $customer_name, $customer_gst, $sale_invoice);
        $report_data['start']         = $period_start;
        $report_data['end']           = $period_end;
        $report_data['customer_name'] = !empty($customer_name) ? $customer_name : '';
        $report_data['customer_gst']  = !empty($customer_gst) ? $customer_gst : '';
        $report_data['sale_invoice']  = !empty($sale_invoice) ? $sale_invoice : '';

        if ($is_ajax) {
            $this->load->view('console/sale/report_day_wise_tpl', $report_data);
        } else {
            $this->render($report_data, 'report_daily_wise_tpl');
        }
    }

    private function _get_daily_wise_data($period_start, $period_end, $customer_name = null, $customer_gst = null, $sale_invoice = null)
    {
        $sql = "SELECT customers.*, sales.sale_date, sales.sale_return, sales.sale_grand_discount, sales.sale_return_date, sales.sale_invoice, "
             . "sum(sale_taxable) as sale_taxable, sum(sale_discount_percent) as sale_discount_percent, "
             . "sum(sale_cgst) as sale_cgst, sum(sale_sgst) as sale_sgst, sum(sale_total) as sale_total "
             . "FROM `sales` "
             . "LEFT JOIN `customers` ON sales.sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($period_start) && !empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') BETWEEN " . $this->db->escape($period_start) . " AND " . $this->db->escape($period_end);
        } elseif (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        } elseif (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        if (!empty($sale_invoice)) {
            $sql .= " AND sale_invoice LIKE " . $this->db->escape('%' . $sale_invoice . '%');
        }

        $sql .= " GROUP BY sales.sale_invoice ORDER BY sales.sale_date DESC, sales.sale_invoice DESC";

        $sale = $this->db->query($sql)->result_array();
        $customer_data = array();

        if (!empty($sale)) {
            foreach ($sale as $key => $invoice) {
                $taxable = (float)(isset($invoice['sale_taxable']) ? $invoice['sale_taxable'] : 0);
                $disc_pct = (float)(isset($invoice['sale_discount_percent']) ? $invoice['sale_discount_percent'] : 0);
                $orig_price = ($disc_pct < 100) ? ((100 * $taxable) / (100 - $disc_pct)) : $taxable;
                $grand_disc_pct = (float)(isset($invoice['sale_grand_discount']) ? $invoice['sale_grand_discount'] : 0);
                $sale_total = (float)(isset($invoice['sale_total']) ? $invoice['sale_total'] : 0);

                $customer_data[$key] = array(
                    'customer_name'          => isset($invoice['customer_name']) ? $invoice['customer_name'] : '',
                    'customer_contact'       => isset($invoice['customer_contact']) ? $invoice['customer_contact'] : '',
                    'customer_gst'           => isset($invoice['customer_gst']) ? $invoice['customer_gst'] : '',
                    'sale_invoice'           => isset($invoice['sale_invoice']) ? $invoice['sale_invoice'] : '',
                    'sale_date'              => isset($invoice['sale_date']) ? $invoice['sale_date'] : '',
                    'sale_loose_quantity'    => isset($invoice['sale_loose_quantity']) ? $invoice['sale_loose_quantity'] : 0,
                    'sale_strip_quantity'    => isset($invoice['sale_strip_quantity']) ? $invoice['sale_strip_quantity'] : 0,
                    'sale_quantity'          => isset($invoice['sale_quantity']) ? $invoice['sale_quantity'] : 0,
                    'sale_batch'             => isset($invoice['sale_batch']) ? $invoice['sale_batch'] : '',
                    'sale_taxable'           => $taxable,
                    'sale_discount_percent'  => $disc_pct,
                    'sale_discount'          => $orig_price - $taxable,
                    'sale_cgst'              => (float)(isset($invoice['sale_cgst']) ? $invoice['sale_cgst'] : 0),
                    'sale_sgst'              => (float)(isset($invoice['sale_sgst']) ? $invoice['sale_sgst'] : 0),
                    'sale_grand_discount'    => ($sale_total * $grand_disc_pct) / 100,
                    'sale_total'             => $sale_total,
                    'sale_return'            => isset($invoice['sale_return']) ? $invoice['sale_return'] : 0,
                    'sale_return_date'       => isset($invoice['sale_return_date']) ? $invoice['sale_return_date'] : '',
                );
            }
        }

        // GST Rate Breakdown
        $sql = "SELECT sum(sale_cgst) as cgst, sum(sale_sgst) as sgst, sum(sale_taxable) as taxable, sale_cgst_percent, sale_sgst_percent "
             . "FROM `sales` "
             . "LEFT JOIN `customers` ON sales.sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($period_start) && !empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') BETWEEN " . $this->db->escape($period_start) . " AND " . $this->db->escape($period_end);
        } elseif (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        } elseif (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        if (!empty($sale_invoice)) {
            $sql .= " AND sale_invoice LIKE " . $this->db->escape('%' . $sale_invoice . '%');
        }

        $sql .= " GROUP BY sale_cgst_percent";
        $data = $this->db->query($sql)->result_array();
        $daily_gst_data = array();

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $cg = (float)(isset($val['cgst']) ? $val['cgst'] : (isset($val['sum(sale_cgst)']) ? $val['sum(sale_cgst)'] : 0));
                $sg = (float)(isset($val['sgst']) ? $val['sgst'] : (isset($val['sum(sale_sgst)']) ? $val['sum(sale_sgst)'] : $cg));
                $daily_gst_data[$key] = array(
                    'sale_cgst'          => $cg,
                    'sale_sgst'          => $sg,
                    'sale_taxable'       => (float)(isset($val['taxable']) ? $val['taxable'] : 0),
                    'sale_cgst_percent'  => isset($val['sale_cgst_percent']) ? $val['sale_cgst_percent'] : 0,
                    'sale_sgst_percent'  => isset($val['sale_sgst_percent']) ? $val['sale_sgst_percent'] : (isset($val['sale_cgst_percent']) ? $val['sale_cgst_percent'] : 0),
                );
            }
        }

        // HSN Breakdown
        $sql = "SELECT medicines.medicine_hsn, sum(sales.sale_strip_quantity) as sale_strip_quantity, "
             . "sum(sales.sale_sgst) as sgst, sum(sales.sale_cgst) as cgst, sum(sales.sale_taxable) as taxable "
             . "FROM `sales` "
             . "INNER JOIN `medicines` ON medicines.medicine_id = sales.sale_medicine_id "
             . "LEFT JOIN `customers` ON sales.sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($period_start) && !empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') BETWEEN " . $this->db->escape($period_start) . " AND " . $this->db->escape($period_end);
        } elseif (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        } elseif (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }

        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        if (!empty($sale_invoice)) {
            $sql .= " AND sale_invoice LIKE " . $this->db->escape('%' . $sale_invoice . '%');
        }

        $sql .= " GROUP BY medicines.medicine_hsn";
        $hsndata = $this->db->query($sql)->result_array();
        $hsn_daily_gst_data = array();

        if (!empty($hsndata)) {
            foreach ($hsndata as $key => $val) {
                $cg = (float)(isset($val['cgst']) ? $val['cgst'] : 0);
                $sg = (float)(isset($val['sgst']) ? $val['sgst'] : $cg);
                $hsn_daily_gst_data[$key] = array(
                    'medicine_hsn'        => isset($val['medicine_hsn']) ? $val['medicine_hsn'] : '',
                    'sale_strip_quantity' => isset($val['sale_strip_quantity']) ? $val['sale_strip_quantity'] : 0,
                    'sale_cgst'           => $cg,
                    'sale_sgst'           => $sg,
                    'sale_taxable'        => (float)(isset($val['taxable']) ? $val['taxable'] : 0),
                );
            }
        }

        return array(
            'customer_data'      => $customer_data,
            'daily_gst_data'     => $daily_gst_data,
            'hsn_daily_gst_data' => $hsn_daily_gst_data,
        );
    }

    public function report_daily_wise_export()
    {
        $period_start  = $this->input->get('start');
        $period_end    = $this->input->get('end');
        $customer_name = $this->input->get('customer_name');
        $customer_gst  = $this->input->get('customer_gst') ? $this->input->get('customer_gst') : $this->input->get('gst');
        $sale_invoice  = $this->input->get('sale_invoice');

        if (empty($period_start)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
        }
        if (empty($period_end)) {
            $period_end = date('Y-m-d');
        }

        $rep = $this->_get_daily_wise_data($period_start, $period_end, $customer_name, $customer_gst, $sale_invoice);
        $customer_data      = $rep['customer_data'];
        $daily_gst_data     = $rep['daily_gst_data'];
        $hsn_daily_gst_data = $rep['hsn_daily_gst_data'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sale Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Customer GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Sale Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Taxable');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Total');

        $rowCount = 2;
        $total_taxable = 0;
        $total_cgst = 0;
        $total_sgst = 0;
        $total_sale = 0;

        if (!empty($customer_data)) {
            foreach ($customer_data as $key => $list) {
                $taxable = (float)(isset($list['sale_taxable']) ? $list['sale_taxable'] : 0);
                $cgst = (float)(isset($list['sale_cgst']) ? $list['sale_cgst'] : 0);
                $sgst = (float)(isset($list['sale_sgst']) ? $list['sale_sgst'] : 0);
                $total = (float)(isset($list['sale_total']) ? $list['sale_total'] : 0) - (float)(isset($list['sale_grand_discount']) ? $list['sale_grand_discount'] : 0);

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, isset($list['sale_invoice']) ? $list['sale_invoice'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, isset($list['customer_name']) ? $list['customer_name'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, isset($list['customer_contact']) ? $list['customer_contact'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, isset($list['customer_gst']) ? $list['customer_gst'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, isset($list['sale_date']) ? $list['sale_date'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $taxable);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $cgst);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $sgst);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $total);

                $total_taxable += $taxable;
                $total_cgst += $cgst;
                $total_sgst += $sgst;
                $total_sale += $total;
                $rowCount++;
            }
        }

        // Total row
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Total');
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_taxable);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $total_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $total_sale);

        // HSN Summary
        $rowCount += 2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Total HSN CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Total HSN SGST');

        if (!empty($hsn_daily_gst_data)) {
            foreach ($hsn_daily_gst_data as $key => $list) {
                $rowCount++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, isset($list['medicine_hsn']) ? $list['medicine_hsn'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, isset($list['sale_cgst']) ? $list['sale_cgst'] : 0);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, isset($list['medicine_hsn']) ? $list['medicine_hsn'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, isset($list['sale_sgst']) ? $list['sale_sgst'] : 0);
            }
        }

        // GST Rate Summary
        $rowCount += 2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Sale CGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Total Sale CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'Sale SGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Total Sale SGST');

        if (!empty($daily_gst_data)) {
            foreach ($daily_gst_data as $key => $list) {
                $rowCount++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, isset($list['sale_cgst_percent']) ? $list['sale_cgst_percent'] : 0);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, isset($list['sale_cgst']) ? $list['sale_cgst'] : 0);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, isset($list['sale_sgst_percent']) ? $list['sale_sgst_percent'] : 0);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, isset($list['sale_sgst']) ? $list['sale_sgst'] : 0);
            }
        }

        $filename = "sale_daily_report_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }
    public function report_gstin_wise_export()
    {
        $period_start  = $this->input->get('start');
        $period_end    = $this->input->get('end');
        $customer_name = $this->input->get('customer_name');
        $customer_gst  = $this->input->get('customer_gst') ? $this->input->get('customer_gst') : $this->input->get('gst');

        if (empty($period_start)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
        }
        if (empty($period_end)) {
            $period_end = date('Y-m-d');
        }

        $rep = $this->_get_gstin_wise_data($period_start, $period_end, $customer_name, $customer_gst);
        $customer_data      = $rep['customer_data'];
        $daily_gst_data     = $rep['daily_gst_data'];
        $hsn_daily_gst_data = $rep['hsn_daily_gst_data'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header for Customer GSTIN Records
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Customer GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Sale Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Taxable (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'CGST (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'SGST (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Total (₹)');

        $rowCount = 2;
        $total_sale_taxable = 0;
        $total_sale_cgst = 0;
        $total_sale_sgst = 0;
        $total_sale = 0;

        if (!empty($customer_data)) {
            foreach ($customer_data as $list) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['customer_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['customer_gst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['sale_date']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['sale_taxable']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['sale_cgst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['sale_sgst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list['sale_total']);
                $total_sale_taxable += (float)$list['sale_taxable'];
                $total_sale_cgst    += (float)$list['sale_cgst'];
                $total_sale_sgst    += (float)$list['sale_sgst'];
                $total_sale         += (float)$list['sale_total'];
                $rowCount++;
            }
        }

        // Totals Footer for Customer GSTIN
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $total_sale_taxable);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $total_sale_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_sale_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $total_sale);

        // HSN Summary Header (Cols I to N)
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Strip Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Sale Taxable (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'HSN Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total HSN CGST (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Total HSN SGST (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'GST Percent');

        $rowHsn = 2;
        $total_h_taxable = 0;
        $total_h_cgst = 0;
        $total_h_sgst = 0;
        $total_quantity = 0;

        if (!empty($hsn_daily_gst_data)) {
            foreach ($hsn_daily_gst_data as $list) {
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowHsn, $list['sale_strip_quantity']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowHsn, $list['sale_taxable']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowHsn, $list['medicine_hsn']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowHsn, $list['sale_cgst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowHsn, $list['sale_sgst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowHsn, $list['sale_cgst_percent']);
                $total_quantity  += (float)$list['sale_strip_quantity'];
                $total_h_taxable += (float)$list['sale_taxable'];
                $total_h_cgst    += (float)$list['sale_cgst'];
                $total_h_sgst    += (float)$list['sale_sgst'];
                $rowHsn++;
            }
        }

        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowHsn, $total_quantity);
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowHsn, $total_h_taxable);
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowHsn, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowHsn, $total_h_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowHsn, $total_h_sgst);

        // Rate Breakdown Header (Cols P to T)
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'CGST %');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'CGST Amount (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'SGST %');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'SGST Amount (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Taxable Amount (₹)');

        $rowRate = 2;
        $total_d_cgst = 0;
        $total_d_sgst = 0;
        $total_d_taxable = 0;

        if (!empty($daily_gst_data)) {
            foreach ($daily_gst_data as $list) {
                $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowRate, $list['sale_cgst_percent']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowRate, $list['sale_cgst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowRate, $list['sale_sgst_percent']);
                $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowRate, $list['sale_sgst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowRate, $list['sale_taxable']);
                $total_d_cgst    += (float)$list['sale_cgst'];
                $total_d_sgst    += (float)$list['sale_sgst'];
                $total_d_taxable += (float)$list['sale_taxable'];
                $rowRate++;
            }
        }

        $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowRate, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowRate, $total_d_cgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowRate, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowRate, $total_d_sgst);
        $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowRate, $total_d_taxable);

        $filename = "sale_gstin_wise_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }
    public function report_gstin_wise()
    {
        $is_ajax = $this->input->is_ajax_request() || ($this->input->post('key') == 'ajax_resp') || $this->input->get('ajax');

        $period_start  = $this->input->get_post('start');
        $period_end    = $this->input->get_post('end');
        $customer_name = $this->input->get_post('customer_name');
        $customer_gst  = $this->input->get_post('customer_gst') ? $this->input->get_post('customer_gst') : $this->input->get_post('gst');

        if (empty($period_start)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
        }
        if (empty($period_end)) {
            $period_end = date('Y-m-d');
        }

        $report_data = $this->_get_gstin_wise_data($period_start, $period_end, $customer_name, $customer_gst);
        $report_data['start']         = $period_start;
        $report_data['end']           = $period_end;
        $report_data['customer_name'] = !empty($customer_name) ? $customer_name : '';
        $report_data['customer_gst']  = !empty($customer_gst) ? $customer_gst : '';

        if ($is_ajax) {
            $this->load->view('console/sale/report_gst_wise_tpl', $report_data);
        } else {
            $this->render($report_data, 'report_gstin_wise_tpl');
        }
    }

    private function _get_gstin_wise_data($period_start, $period_end, $customer_name = null, $customer_gst = null)
    {
        $sql = "SELECT customers.*, sales.sale_date, sales.sale_return, sales.sale_return_date, sales.sale_invoice, "
             . "sum(sale_taxable) as sale_taxable, sum(sale_discount_percent) as sale_discount_percent, "
             . "sum(sale_cgst) as sale_cgst, sum(sale_sgst) as sale_sgst, sum(sale_total) as sale_total "
             . "FROM `sales` "
             . "JOIN `customers` ON sales.sale_customer = customers.customer_id "
             . "WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }
        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        $sql .= " GROUP BY customer_name";

        $sale = $this->db->query($sql)->result_array();
        $customer_data = array();
        if (!empty($sale)) {
            foreach ($sale as $key => $invoice) {
                $taxable = (float)(isset($invoice['sale_taxable']) ? $invoice['sale_taxable'] : 0);
                $disc_pct = (float)(isset($invoice['sale_discount_percent']) ? $invoice['sale_discount_percent'] : 0);
                $orig_price = ($disc_pct < 100) ? ((100 * $taxable) / (100 - $disc_pct)) : $taxable;
                $discount = $orig_price - $taxable;

                $customer_data[$key] = array(
                    'customer_name'           => isset($invoice['customer_name']) ? $invoice['customer_name'] : '',
                    'customer_gst'            => isset($invoice['customer_gst']) ? $invoice['customer_gst'] : '',
                    'sale_invoice'            => isset($invoice['sale_invoice']) ? $invoice['sale_invoice'] : '',
                    'sale_date'               => isset($invoice['sale_date']) ? $invoice['sale_date'] : '',
                    'sale_loose_quantity'     => isset($invoice['sale_loose_quantity']) ? $invoice['sale_loose_quantity'] : 0,
                    'sale_strip_quantity'     => isset($invoice['sale_strip_quantity']) ? $invoice['sale_strip_quantity'] : 0,
                    'sale_quantity'           => isset($invoice['sale_quantity']) ? $invoice['sale_quantity'] : 0,
                    'sale_batch'              => isset($invoice['sale_batch']) ? $invoice['sale_batch'] : '',
                    'sale_taxable'            => $taxable,
                    'sale_discount_percent'   => $disc_pct,
                    'sale_discount'           => $discount,
                    'sale_cgst'               => (float)(isset($invoice['sale_cgst']) ? $invoice['sale_cgst'] : 0),
                    'sale_sgst'               => (float)(isset($invoice['sale_sgst']) ? $invoice['sale_sgst'] : 0),
                    'sale_total'              => (float)(isset($invoice['sale_total']) ? $invoice['sale_total'] : 0),
                    'sale_return'             => isset($invoice['sale_return']) ? $invoice['sale_return'] : 0,
                    'sale_return_date'        => isset($invoice['sale_return_date']) ? $invoice['sale_return_date'] : '',
                );
            }
        }

        // Grand discount summary
        $sql = "SELECT sales.sale_date, customers.customer_name, customers.customer_gst, "
             . "sum(sale_total * sale_grand_discount / 100) as sale_grand_discount "
             . "FROM `sales` "
             . "JOIN `customers` ON sales.sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }
        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        $sale_grand_dis_data = $this->db->query($sql)->result_array();

        // GST Rate breakdown
        $sql = "SELECT sum(sale_cgst) as cgst, sum(sale_sgst) as sgst, sum(sales.sale_taxable) as sale_taxable, "
             . "sale_cgst_percent, sale_sgst_percent "
             . "FROM `sales` "
             . "JOIN `customers` ON sales.sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }
        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        $sql .= " GROUP BY sale_cgst_percent";
        $data = $this->db->query($sql)->result_array();
        $daily_gst_data = array();
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $daily_gst_data[$key] = array(
                    'sale_cgst'         => (float)(isset($val['cgst']) ? $val['cgst'] : (isset($val['sum(sale_cgst)']) ? $val['sum(sale_cgst)'] : 0)),
                    'sale_sgst'         => (float)(isset($val['sgst']) ? $val['sgst'] : (isset($val['sum(sale_sgst)']) ? $val['sum(sale_sgst)'] : 0)),
                    'sale_taxable'      => (float)(isset($val['sale_taxable']) ? $val['sale_taxable'] : 0),
                    'sale_cgst_percent' => isset($val['sale_cgst_percent']) ? $val['sale_cgst_percent'] : 0,
                    'sale_sgst_percent' => isset($val['sale_sgst_percent']) ? $val['sale_sgst_percent'] : (isset($val['sale_cgst_percent']) ? $val['sale_cgst_percent'] : 0),
                );
            }
        }

        // HSN breakdown
        $sql = "SELECT medicines.medicine_hsn, sales.sale_strip_quantity, "
             . "sum(sales.sale_sgst) as sgst, sum(sales.sale_cgst) as cgst, "
             . "sum(sales.sale_rate) as sale_rate, sum(sales.sale_taxable) as sale_taxable, "
             . "sales.sale_cgst_percent, sales.sale_discount_percent "
             . "FROM `sales` "
             . "INNER JOIN medicines ON medicines.medicine_id = sales.sale_medicine_id "
             . "LEFT JOIN customers ON sales.sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') >= " . $this->db->escape($period_start);
        }
        if (!empty($period_end)) {
            $sql .= " AND DATE_FORMAT(sale_date, '%Y-%m-%d') <= " . $this->db->escape($period_end);
        }
        if (!empty($customer_name)) {
            $sql .= " AND customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($customer_gst)) {
            $sql .= " AND customer_gst LIKE " . $this->db->escape($customer_gst . '%');
        }
        $sql .= " GROUP BY medicines.medicine_hsn";
        $hsndata = $this->db->query($sql)->result_array();
        $hsn_daily_gst_data = array();
        if (!empty($hsndata)) {
            foreach ($hsndata as $key => $val) {
                $hsn_daily_gst_data[$key] = array(
                    'sale_strip_quantity' => isset($val['sale_strip_quantity']) ? $val['sale_strip_quantity'] : 0,
                    'sale_cgst'           => (float)(isset($val['cgst']) ? $val['cgst'] : 0),
                    'sale_sgst'           => (float)(isset($val['sgst']) ? $val['sgst'] : 0),
                    'sale_cgst_percent'   => isset($val['sale_cgst_percent']) ? $val['sale_cgst_percent'] : 0,
                    'sale_taxable'        => (float)(isset($val['sale_taxable']) ? $val['sale_taxable'] : 0),
                    'medicine_hsn'        => isset($val['medicine_hsn']) ? $val['medicine_hsn'] : '',
                );
            }
        }

        return array(
            'customer_data'       => $customer_data,
            'sale_grand_dis_data' => $sale_grand_dis_data,
            'daily_gst_data'      => $daily_gst_data,
            'hsn_daily_gst_data'  => $hsn_daily_gst_data,
        );
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
