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
class Purchase extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        ini_set('post_max_size', "8M");
        $this->targetModel = 'purchases_model';
        $this->page_config['tablePrimaryKey'] = $this->purchases_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Purchase'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,edit_detail';
        //$this->page_config['allowed_action'] = 'add_detail,print,view_detail,edit_detail,purchase_return';
        //$this->page_config['allowed_action'] = 'add_detail,print,view_detail,edit_detail,delete';
        $this->page_config['searchFields'] = 'purchase_mrp,medicine_name,medicine_hsn,purchase_date,medicine_manufacturer,purchase_invoice,purchase_entry_number,purchase_batch,purchase_supplier'; //search box,
        $this->page_config['list_columns'] = 'medicine_name,medicine_hsn,purchase_quantity,purchase_free_quantity,purchased_total,purchase_date,purchase_invoice,purchase_supplier,purchase_batch,purchase_mrp,purchase_expire_month,purchase_expire_year';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        $this->page_config['autocomplete']['medicine_manufacturer'] = array('medicines' => 'medicine_manufacturer');
         $this->page_config['autocomplete']['purchase_batch'] = array('purchases' => 'purchase_batch');
       // $this->page_config['autocomplete']['medicine_schedule'] = array('medicines' => 'medicine_schedule');
        $this->page_config['autocomplete']['medicine_category'] = array('medicine_categories' => 'medicine_category_name');
       // $this->page_config['autocomplete']['medicine_storage'] = array('medicines' => 'medicine_storage');
        //$this->page_config['autocomplete']['medicine_hsn'] = array('medicines' => 'medicine_hsn');
        //medicine_hsn,	medicine_storage,medicine_category,medicine_schedule
        $this->page_config['use_dropdown_columns'] = 'purchase_supplier';
        $this->page_config['use_dropdown_columns_options']['purchase_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }
     /**
     * index show list
     */
    public function index() {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        // $likeCondition = null;
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'purchase_entry_number');
        foreach ($allData['current_paged_list'] as $key => $value) {
            $totalSum = $this->db->query('select sum(purchase_total) as sum_total from purchases where purchase_entry_number = "' . $value['purchase_entry_number'] . '"')->result_array();
            $allData['current_paged_list'][$key]['purchased_total'] = round($totalSum[0]['sum_total']);
        }
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }
      public function report_gstin_wise_export() {
            $period_start =$this->input->get('start');
            $period_end = $this->input->get('end');
            $supplier_name = $this->input->get('supplier_name');
            $supplier_gst =$this->input->get('supplier_gst');
            $sql = "SELECT suppliers.*,purchases.purchase_date,purchases.purchase_return,purchases.purchase_return_date,purchases.purchase_invoice,"
                    . "sum(purchase_taxable) as purchase_taxable,sum(purchase_discount_percent) as purchase_discount_percent,"
                    . "sum(purchase_cgst) as purchase_cgst,sum(purchase_sgst) as purchase_sgst,sum(purchase_total) as purchase_total  "
                    . "FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id  WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= "AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= "AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= "GROUP BY supplier_gst";
            #echo $sql;
            # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
            $purchase = $this->db->query($sql)->result_array();
            #pr($purchase);
            $customer_data = null;
            foreach ($purchase as $key => $invoice) {
                #$customer_data[$key] = json_decode($invoice['invoice_meta'], true);
                $customer_data[$key]['supplier_name'] = $invoice['supplier_name'];
                $customer_data[$key]['supplier_gst'] = $invoice['supplier_gst'];
                $customer_data[$key]['purchase_invoice'] = $invoice['purchase_invoice'];
                $customer_data[$key]['purchase_date'] = $invoice['purchase_date'];
                $customer_data[$key]['purchase_quantity'] = $invoice['purchase_quantity'];
                $customer_data[$key]['purchase_batch'] = $invoice['purchase_batch'];
                $customer_data[$key]['purchase_taxable'] = $invoice['purchase_taxable'];
                $customer_data[$key]['purchase_discount_percent'] = $invoice['purchase_discount_percent'];
                $original_price = (100 * $invoice['purchase_taxable']) / (100 - $invoice['purchase_discount_percent']);
                $customer_data[$key]['purchase_discount'] = $original_price - $invoice['purchase_taxable'];
                $customer_data[$key]['purchase_cgst'] = $invoice['purchase_cgst'];
                $customer_data[$key]['purchase_sgst'] = $invoice['purchase_sgst'];
                $customer_data[$key]['purchase_total'] = $invoice['purchase_total'];
                $customer_data[$key]['purchase_return'] = $invoice['purchase_return'];
                $customer_data[$key]['purchase_return_date'] = $invoice['purchase_return_date'];
            }
            #pr($customer_data,1);
            #$package=$this->packages_model->get_list();
            $sql = "SELECT sum(purchase_cgst),purchase_cgst_percent FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id WHERE 1=1";

            if (!empty($period_start)) {
                $sql .= " AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= " AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= " GROUP BY purchase_cgst_percent";

            $data = $this->db->query($sql)->result_array();
            $gst_data = null;

            foreach ($data as $key => $val) {
                //pr($data,1);
                $gst_data[$key]['purchase_cgst'] = $val['sum(purchase_cgst)'];
                $gst_data[$key]['purchase_cgst_percent'] = $val['purchase_cgst_percent'];
            }
            //pr($gst_data,1);
            $sql = "SELECT medicines.medicine_hsn,sum(purchases.purchase_sgst) as sgst, sum(purchases.purchase_cgst) as cgst FROM `purchases` "
                    . "INNER JOIN medicines ON medicines.medicine_id = purchases.purchase_medicine_id "
                    . "JOIN suppliers ON suppliers.supplier_id = purchases.purchase_supplier "
                    . "WHERE 1=1";

            if (!empty($period_start)) {
                $sql .= " AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= " AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= " GROUP BY medicines.medicine_hsn";
            // pr($sql);
            $hsndata = $this->db->query($sql)->result_array();
            $hsn_daily_gst_data = null;

            foreach ($hsndata as $key => $val) {
                // pr($hsndata,1);
                $hsn_daily_gst_data[$key]['purchase_cgst'] = $val['cgst'];
                $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
            }
            
          // pr(array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'gst_data' => $gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
           
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
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Supplier Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Supplier GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Purchase Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Taxable');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Total');
         
      
        // set Row
        $rowCount = 2;
       // pr($gst_data);
        foreach ($customer_data as $key =>$list) {
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['supplier_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount,$list['supplier_gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$list['purchase_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['purchase_taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['purchase_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list['purchase_sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list['purchase_total']);
            $rowCount++;
        }
       
        $objPHPExcel->getActiveSheet()->SetCellValue('A'. $rowCount, 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'. $rowCount, 'Total HSN CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'. $rowCount, 'HSN NUMBER');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'. $rowCount, 'Total HSN SGST');
        
        foreach ($hsn_daily_gst_data as $key =>$list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($rowCount+1), $list['medicine_hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($rowCount+1), $list['purchase_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . ($rowCount+1), $list['medicine_hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . ($rowCount+1), $list['purchase_cgst']);
            
            $rowCount++;
        }
        
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Purchase CGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Total Purchase CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'Purchase SGST Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Total Purchase SGST');
        
       
      foreach ($gst_data as $key =>$list) {
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($rowCount+1), $list['purchase_cgst_percent']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($rowCount+1),$list['purchase_cgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . ($rowCount+1), $list['purchase_cgst_percent']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . ($rowCount+1),$list['purchase_cgst']);
            $rowCount++;
        }
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
    
    public function generate_purchse() {
		// create file name
        $fileName = 'purchse-'.time().'.xlsx';  
		// load excel library
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header//Purchase Batch
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Purchase Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Purchase Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Purchase Supplier');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Purchase Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Purchase Free Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Purchase Batch');
         $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Purchase Expire Month');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Purchase Expire Year');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purchase Mrp');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Purchased Total');
        // set Row
        $rowCount = 2;
         $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        // $likeCondition = null;
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, null, NULL, $likeCondition, $orderBy, 'purchase_entry_number');
        
        foreach ($allData['current_paged_list'] as $key =>$list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['purchase_invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['purchase_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$list['supplier_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['purchase_quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['purchase_free_quantity']);
              $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount,$list['purchase_batch']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount,$list['purchase_expire_month']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,$list['purchase_expire_year']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $list['purchase_mrp']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $list['medicine_name']);
             $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $list['purchase_total']);
            $rowCount++;
        }
      
        $filename = "tutsmake". date("Y-m-d-H-i-s").".csv";
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
		$objWriter->save('php://output'); 

    }
    
    function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}
    public function add_detail() {
        if ($this->input->post()) {
           // pr($this->input->post(),1);
            $supplier['supplier_name'] = ($this->input->post('supplier_name'));
            $supplier['supplier_address'] = ($this->input->post('supplier_address'));
            $supplier['supplier_gst'] = ($this->input->post('supplier_gst'));
            $supplier['supplier_contact'] = $this->input->post('supplier_contact');
            $supplier_id = null;
            $data = $this->suppliers_model->get_list($supplier);
            if (empty($data)) {
                $data = $this->suppliers_model->insert_data($supplier);
                $supplier_id = $data;
            } else {
                $supplier_id = $data[0]['supplier_id'];
            }
            $purchase = null;
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('medicine_name')); $i++) {
                $purchase[$i]['purchase_invoice'] = $this->input->post('purchase_invoice');
                $purchase[$i]['purchase_date'] = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                $purchase[$i]['purchase_supplier'] = $supplier_id;
                $purchase[$i]['purchase_entry_number'] = $this->input->post('purchase_entry_number');

                $purchase[$i]['purchase_quantity'] = $this->input->post('purchase_quantity')[$i];
                $purchase[$i]['purchase_free_quantity'] = $this->input->post('purchase_free_quantity')[$i];
                $purchase[$i]['purchase_unit'] = $this->input->post('medicine_unit')[$i];
                
                $medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
               
                $data = $this->medicines_model->get_list($medicine);
                
                $medicine['medicine_unit'] = ($this->input->post('medicine_unit')[$i]);
                $medicine['medicine_manufacturer'] = ($this->input->post('medicine_manufacturer')[$i]);
                $medicine['medicine_hsn'] = $this->input->post('medicine_hsn')[$i];
                $medicine['medicine_storage'] = $this->input->post('medicine_storage')[$i];
                $medicine['medicine_schedule'] = $this->input->post('medicine_schedule')[$i];
                $medicine['medicine_category'] = $this->input->post('medicine_category')[$i];
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $stock = $purchase[$i]['purchase_quantity'] + $purchase[$i]['purchase_free_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                    $medicine_id = $data;
                } else {
                    $medicine_id = $data[0]['medicine_id'];
                    $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
                    //pr($medicine);
                    $stock = (int) $purchase[$i]['purchase_quantity'] + (int) $purchase[$i]['purchase_free_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                }
                 $category = null;
                 $category['medicine_category_name'] = trim($this->input->post('medicine_category')[$i]);
                 
                 $datas = $this->medicine_categories_model->get_list($category);
                 $medicine_category_id = null;
                
                 if (empty($category)) {
                    
                    $datas = $this->medicine_categories_model->insert_data($category);
                    $medicine_category_id = $datas;
                } else {
                    
                    $medicine_category_id = $datas[0]['medicine_category_id'];
                    $this->medicine_categories_model->update_data($category, array('medicine_category_id' => $medicine_category_id));
                    
                }
                $purchase[$i]['purchase_medicine_id'] = $medicine_id;
                $purchase[$i]['purchase_batch'] = $this->input->post('purchase_batch')[$i];
                $purchase[$i]['purchase_expire_month'] = $this->input->post('purchase_expire_month')[$i];
                $purchase[$i]['purchase_expire_year'] = $this->input->post('purchase_expire_year')[$i];
                $purchase[$i]['purchase_mrp'] = $this->input->post('purchase_mrp')[$i];
                $purchase[$i]['purchase_rate'] = $this->input->post('purchase_rate')[$i];
                $purchase[$i]['purchase_discount_percent'] = $this->input->post('purchase_discount_percent')[$i];
                $purchase[$i]['purchase_bonus'] = $this->input->post('purchase_bonus')[$i];
                $purchase[$i]['purchase_taxable'] = $this->input->post('purchase_taxable')[$i];
                $purchase[$i]['purchase_sgst_percent'] = $this->input->post('purchase_sgst_percent')[$i];
                $purchase[$i]['purchase_sgst'] = $this->input->post('purchase_sgst')[$i];
                $purchase[$i]['purchase_cgst_percent'] = $this->input->post('purchase_cgst_percent')[$i];
                $purchase[$i]['purchase_cgst'] = $this->input->post('purchase_cgst')[$i];
                $purchase[$i]['purchase_total'] = $this->input->post('purchase_total')[$i];
            }
            $data = $this->purchases_model->insert_data($purchase, true);
            increase_purchase_number();
            if($this->input->get('autosave')==true){
              echo json_encode(array('status' => 'success',"entry_number"=>$this->input->post('purchase_entry_number'), 'message' => '<strong>Well done!</strong> Data Save.'));
              return 0;
            }
            $this->render(array('status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $this->render(null, 'add_detail');
        }
    }

    /**
     * view detail
     */
    public function view_detail() {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));
        $data = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));
        //pr($data);
        if ($type == 'print')
            $this->load->view('view_detail', array('data' => $data));
        else
            $this->render(array('data' => $data), 'view_detail');
    }

    /**
     * view detail
     */
    public function purchase_return() {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));
        $data = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));

        $this->render(array('data' => $data));
    }

    /**
     * view detail
     */
    public function edit_detail() {
        //$rawData = file_get_contents("php://input");
        if ($this->input->post()) {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));
            $supplier['supplier_name'] = ($this->input->post('supplier_name'));
            $supplier['supplier_address'] = ($this->input->post('supplier_address'));
            $supplier['supplier_gst'] = ($this->input->post('supplier_gst'));
            $supplier['supplier_contact'] = $this->input->post('supplier_contact');
            $supplier_id = null;
            $data = $this->suppliers_model->get_list($supplier);
            if (empty($data)) {
                $data = $this->suppliers_model->insert_data($supplier);
                $supplier_id = $data;
            } else {
                $supplier_id = $data[0]['supplier_id'];
            }
            $purchase = null;
            $stock = 0;
            $unit = 0;
            $dc = 0;
            $cd = 0;
            for ($i = 0; $i < count($this->input->post('medicine_name')); $i++) {
                $medicine = null;

                $purchase[$i]['purchase_invoice'] = $this->input->post('purchase_invoice');
                $purchase[$i]['purchase_date'] = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                $purchase[$i]['purchase_supplier'] = $supplier_id;
                $purchase[$i]['purchase_entry_number'] = $this->input->post('purchase_entry_number');
                $purchase[$i]['purchase_quantity'] = $this->input->post('purchase_quantity')[$i];
                $purchase[$i]['purchase_free_quantity'] = $this->input->post('purchase_free_quantity')[$i];
                $purchase[$i]['purchase_unit'] = $this->input->post('purchase_unit')[$i];
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $medicine_id = null;
                $data = null;
                $data = $this->medicines_model->get_list($medicine);
                if (empty($data)) {
                    $dc++;

                    $medicine['medicine_unit'] = ($this->input->post('purchase_unit')[$i]);
                    $medicine['medicine_category'] = trim($this->input->post('medicine_category')[$i]);
                    $medicine['medicine_schedule'] = $this->input->post('medicine_schedule')[$i];
                    $medicine['medicine_manufacturer'] = ($this->input->post('medicine_manufacturer')[$i]);
                    $medicine['medicine_hsn'] = $this->input->post('medicine_hsn')[$i];
                    $medicine['medicine_storage'] = $this->input->post('medicine_storage')[$i];
                    $data = $this->medicines_model->insert_data($medicine);

                    $stock = $purchase[$i]['purchase_quantity'] + $purchase[$i]['purchase_free_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                    $medicine_id = $data;
                } else {
                    $medicine['medicine_storage'] = $this->input->post('medicine_storage')[$i];
                    $medicine['medicine_unit'] = ($this->input->post('purchase_unit')[$i]);
                    $medicine['medicine_hsn'] = ($this->input->post('medicine_hsn')[$i]);
                    $medicine['medicine_category'] = trim($this->input->post('medicine_category')[$i]);
                    $medicine['medicine_schedule'] = $this->input->post('medicine_schedule')[$i];
                    $medicine['medicine_manufacturer'] = ($this->input->post('medicine_manufacturer')[$i]);
                    $medicine_id = $data[0]['medicine_id'];
                    $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
                    $stock = (int) $purchase[$i]['purchase_quantity'] + (int) $purchase[$i]['purchase_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                }
                 $category = null;
                 $medicine_category_id = null;
                 $datas=null;
                 $category['medicine_category_name'] = trim($this->input->post('medicine_category')[$i]);
                 $datas = $this->medicine_categories_model->get_list($category);
                 if (empty($category)) {
                    // $cd++;
                    $datas = $this->medicine_categories_model->insert_data($category);
                    $medicine_category_id = $datas;
                } else {
                    $medicine_category_id = $datas[0]['medicine_category_id'];
                    $this->medicine_categories_model->update_data($category, array('medicine_category_id' => $medicine_category_id));
                    
                }


                $purchase[$i]['purchase_medicine_id'] = $medicine_id;
                $purchase[$i]['purchase_batch'] = $this->input->post('purchase_batch')[$i];
                $purchase[$i]['purchase_expire_month'] = $this->input->post('purchase_expire_month')[$i];
                $purchase[$i]['purchase_expire_year'] = $this->input->post('purchase_expire_year')[$i];
                $purchase[$i]['purchase_mrp'] = $this->input->post('purchase_mrp')[$i];
                $purchase[$i]['purchase_rate'] = $this->input->post('purchase_rate')[$i];
                $purchase[$i]['purchase_discount_percent'] = $this->input->post('purchase_discount_percent')[$i];
                $purchase[$i]['purchase_bonus'] = $this->input->post('purchase_bonus')[$i];
                $purchase[$i]['purchase_taxable'] = $this->input->post('purchase_taxable')[$i];
                $purchase[$i]['purchase_sgst_percent'] = $this->input->post('purchase_sgst_percent')[$i];
                $purchase[$i]['purchase_sgst'] = $this->input->post('purchase_sgst')[$i];
                $purchase[$i]['purchase_cgst_percent'] = $this->input->post('purchase_cgst_percent')[$i];
                $purchase[$i]['purchase_cgst'] = $this->input->post('purchase_cgst')[$i];
                $purchase[$i]['purchase_total'] = $this->input->post('purchase_total')[$i];
            }
            $breakIt = false;
            foreach ($purchase as $key => $value) {
                foreach ($value as $keyx => $valuex) {
                    if (($valuex) == "") {
                        $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));

                        //pr($_POST, 1);
                        // pr($purchase[$key], 1);
                    }
                }
            }
            $this->medical_stock_update($dataFull, $purchase);
            $this->purchases_model->delete(array('purchase_entry_number' => $this->input->post('purchase_entry_number')));
            $data = $this->purchases_model->insert_data($purchase, true);
            $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));
            //$dataFull = $purchase;
           $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'));
        } else {
            // pr($purchase,1);
            //pr($this->input->post()); die('golpo');
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice, 'purchase_return' => 0));

            $this->render(array('data' => $dataFull));
        }
    }

    /**
     * delete
     */
    public function delete() {
        $postedData = $this->input->post();
        if (isset($postedData['selectedItem'])) {
            foreach ($postedData['selectedItem'] as $k => $value) {
                $postedData['selectedItem'][$k] = base64_decode($value);
            }
            $this->medical_stock_rollback($postedData['selectedItem']);

            $this->{$this->targetModel}->delete(array('purchase_entry_number' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('purchase_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function purchase_returnx() {

        if ($this->input->post()) {
            $invoice = base64_decode($this->uri->segment(4));
            $dataReturn = $this->{$this->targetModel}->get_list(array('purchase_invoice' => $invoice, 'purchase_return' => TRUE));
            $supplier['supplier_name'] = ($this->input->post('supplier_name'));
            $supplier['supplier_address'] = ($this->input->post('supplier_address'));
            $supplier['supplier_gst'] = ($this->input->post('supplier_gst'));
            $supplier['supplier_contact'] = $this->input->post('supplier_contact');
            $data = $this->suppliers_model->get_list($supplier);
            $supplier_id = $data[0]['supplier_id'];

            if (empty($this->input->post('medicine_hsn'))) {
                foreach ($dataReturn as $value) {
                    $this->db->query('delete from purchases where purchase_return = true and purchase_ID  = ' . $value['purchase_ID']);
                }
            } else {
                for ($i = 0; $i < count($this->input->post('purchase_total')); $i++) {
                    if ($this->input->post('purchase_returned')[$i] == 'true') {
                        continue;
                    }
                    $purchase[$i]['purchase_entry_number'] = $this->input->post('purchase_entry_number');
                    $purchase[$i]['purchase_return_date'] = date('Y-m-d', strtotime($this->input->post('purchase_return_date')));
                    $purchase[$i]['purchase_date'] = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                    $purchase[$i]['purchase_supplier'] = $supplier_id;
                    $purchase[$i]['purchase_quantity'] = $this->input->post('purchase_quantity')[$i];
                    $purchase[$i]['purchase_free_quantity'] = $this->input->post('purchase_free_quantity')[$i];
                    $purchase[$i]['purchase_unit'] = $this->input->post('purchase_unit')[$i];
                    $medicine['medicine_name'] = ($this->input->post('medicine_name')[$i]);
                    $medicine['medicine_manufacturer'] = ($this->input->post('medicine_manufacturer')[$i]);
                    $medicine['medicine_hsn'] = $this->input->post('medicine_hsn')[$i];
                    $data = $this->medicines_model->get_list($medicine);
                    $medicine_id = $data[0]['medicine_id'];
                    $purchase[$i]['purchase_medicine_id'] = $medicine_id;
                    $purchase[$i]['purchase_batch'] = $this->input->post('purchase_batch')[$i];
                    $purchase[$i]['purchase_expire_month'] = $this->input->post('purchase_expire_month')[$i];
                    $purchase[$i]['purchase_expire_year'] = $this->input->post('purchase_expire_year')[$i];
                    $purchase[$i]['purchase_mrp'] = $this->input->post('purchase_mrp')[$i];
                    $purchase[$i]['purchase_rate'] = $this->input->post('purchase_rate')[$i];
                    $purchase[$i]['purchase_discount_percent'] = $this->input->post('purchase_discount_percent')[$i];
                    $purchase[$i]['purchase_taxable'] = $this->input->post('purchase_taxable')[$i];
                    $purchase[$i]['purchase_sgst_percent'] = $this->input->post('purchase_sgst_percent')[$i];
                    $purchase[$i]['purchase_sgst'] = $this->input->post('purchase_sgst')[$i];
                    $purchase[$i]['purchase_cgst_percent'] = $this->input->post('purchase_cgst_percent')[$i];
                    $purchase[$i]['purchase_cgst'] = $this->input->post('purchase_cgst')[$i];
                    $purchase[$i]['purchase_total'] = $this->input->post('purchase_total')[$i];
                    $purchase[$i]['purchase_return'] = true;
                    
                }
                if (!empty($purchase)) {
                    $data = $this->purchases_model->insert_data($purchase, true);
                }
            }
            $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));
            $onlypurchase = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice, 'purchase_return' => false));
            $dataReturn = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice, 'purchase_return' => TRUE));
            $dataFinal = $this->purchase_return_stocks($dataFull, $dataReturn);
            $this->render(array('status' => 'success', 'data' => $dataFinal, 'message' => '<strong>Well done!</strong> Data Save.'), 'return');
        } else {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));
            $dataReturn = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice, 'purchase_return' => TRUE));
            $dataFinal = $this->purchase_return_stocks($dataFull, $dataReturn);
            $this->render(array('data' => $dataFinal), 'return');
        }
    }

    private function purchase_return_stocks($dataFull, $return) {
        foreach ($dataFull as $dfk => $df) {
            foreach ($return as $rk => $r) {
                if ($df['purchase_medicine_id'] == $r['purchase_medicine_id'] && $df['purchase_return'] == false) {
                    $dataFull[$dfk]['purchase_quantity'] = $dataFull[$dfk]['purchase_quantity'] - $r['purchase_quantity'];
                }
            }
        }
        return $dataFull;
    }

    public function report_gstin_wise() {
        $post_data = $this->input->post();
		if ($this->input->post('key')) {
            $period_start = $this->input->post('start');
            $period_end = $this->input->post('end');
            $supplier_name = $this->input->post('supplier_name');
            $supplier_gst = $this->input->post('supplier_gst');
            #echo $package_name;
            // pr($post_data);
            $sql = "SELECT suppliers.*,purchases.purchase_date,purchases.purchase_return,purchases.purchase_return_date,purchases.purchase_invoice,"
                    . "sum(purchase_taxable) as purchase_taxable,sum(purchase_discount_percent) as purchase_discount_percent,"
                    . "sum(purchase_cgst) as purchase_cgst,sum(purchase_sgst) as purchase_sgst,sum(purchase_total) as purchase_total  "
                    . "FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id  WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= "AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= "AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= "AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= "GROUP BY supplier_gst";
            #echo $sql;
            # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
            $purchase = $this->db->query($sql)->result_array();
            #pr($purchase);
            $customer_data = null;
            foreach ($purchase as $key => $invoice) {
                #$customer_data[$key] = json_decode($invoice['invoice_meta'], true);
                $customer_data[$key]['supplier_name'] = $invoice['supplier_name'];
                $customer_data[$key]['supplier_gst'] = $invoice['supplier_gst'];
                $customer_data[$key]['purchase_invoice'] = $invoice['purchase_invoice'];
                $customer_data[$key]['purchase_date'] = $invoice['purchase_date'];
                $customer_data[$key]['purchase_quantity'] = $invoice['purchase_quantity'];
                $customer_data[$key]['purchase_batch'] = $invoice['purchase_batch'];
                $customer_data[$key]['purchase_taxable'] = $invoice['purchase_taxable'];
                $customer_data[$key]['purchase_discount_percent'] = $invoice['purchase_discount_percent'];
                $original_price = (100 * $invoice['purchase_taxable']) / (100 - $invoice['purchase_discount_percent']);
                $customer_data[$key]['purchase_discount'] = $original_price - $invoice['purchase_taxable'];
                $customer_data[$key]['purchase_cgst'] = $invoice['purchase_cgst'];
                $customer_data[$key]['purchase_sgst'] = $invoice['purchase_sgst'];
                $customer_data[$key]['purchase_total'] = $invoice['purchase_total'];
                $customer_data[$key]['purchase_return'] = $invoice['purchase_return'];
                $customer_data[$key]['purchase_return_date'] = $invoice['purchase_return_date'];
            }
            #pr($customer_data,1);
            #$package=$this->packages_model->get_list();
            $sql = "SELECT sum(purchase_cgst),purchase_cgst_percent FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id WHERE 1=1";

            if (!empty($period_start)) {
                $sql .= " AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= " AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= " GROUP BY purchase_cgst_percent";

            $data = $this->db->query($sql)->result_array();
            $gst_data = null;

            foreach ($data as $key => $val) {
                //pr($data,1);
                $gst_data[$key]['purchase_cgst'] = $val['sum(purchase_cgst)'];
                $gst_data[$key]['purchase_cgst_percent'] = $val['purchase_cgst_percent'];
            }
            //pr($gst_data,1);
            $sql = "SELECT medicines.medicine_hsn,sum(purchases.purchase_sgst) as sgst, sum(purchases.purchase_cgst) as cgst FROM `purchases` "
                    . "INNER JOIN medicines ON medicines.medicine_id = purchases.purchase_medicine_id "
                    . "JOIN suppliers ON suppliers.supplier_id = purchases.purchase_supplier "
                    . "WHERE 1=1";

            if (!empty($period_start)) {
                $sql .= " AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= " AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= " GROUP BY medicines.medicine_hsn";
            // pr($sql);
            $hsndata = $this->db->query($sql)->result_array();
            $hsn_daily_gst_data = null;

            foreach ($hsndata as $key => $val) {
                // pr($hsndata,1);
                $hsn_daily_gst_data[$key]['purchase_cgst'] = $val['cgst'];
                $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
            }
            $this->load->view('console/purchase/report_gstin_wise_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'gst_data' => $gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {
            $this->load->view('console/purchase/gst_record_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'gst_data' => $gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    public function daily_purchase_medicine() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $purchase_invoice = $this->input->post('purchase_invoice');
        $medicine_name = $this->input->post('medicine_name');

        $sql = "SELECT medicines.medicine_name,purchases.purchase_date,purchases.purchase_batch,purchases.purchase_quantity,purchases.purchase_invoice FROM `purchases` join `medicines` on purchases.purchase_medicine_id=medicines.medicine_id  WHERE 1 = 1";

        if (!empty($period_start)) {
            $sql .= " AND purchase_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND purchase_date<='" . $period_end . "'";
        }

        if (!empty($purchase_invoice)) {
            $sql .= " AND purchase_invoice like '%" . $purchase_invoice . "%'";
        }
        if (!empty($medicine_name)) {
            $sql .= " AND medicine_name like '" . $medicine_name . "%'";
        }
        // $sql .= "GROUP BY purchase_invoice";
//print_r($sql);
        $purchase = $this->db->query($sql)->result_array();

        $medicine_data = null;
        foreach ($purchase as $key => $invoice) {
            // pr($invoice);
            $medicine_data[$key]['purchase_invoice'] = $invoice['purchase_invoice'];
            $medicine_data[$key]['purchase_date'] = $invoice['purchase_date'];
            $medicine_data[$key]['purchase_quantity'] = $invoice['purchase_quantity'];
            $medicine_data[$key]['medicine_name'] = $invoice['medicine_name'];
            $medicine_data[$key]['purchase_batch'] = $invoice['purchase_batch'];
        }

        if ($this->input->post('key')) {
            $this->load->view('console/purchase/purchase_daily_medicine', array('medicine_data' => $medicine_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/purchase/purchase_daily_medicine_tpl', array('medicine_data' => $medicine_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    public function report_daily_wise() {
        $post_data = $this->input->post();


        if ($this->input->post('key')) {
            $period_start = $this->input->post('start');
            $period_end = $this->input->post('end');
            $supplier_name = $this->input->post('supplier_name');
            $supplier_gst = $this->input->post('supplier_gst');
            #echo $package_name;
          //  pr($post_data);
            $sql = "SELECT suppliers.*,purchases.purchase_date,purchases.purchase_return,purchases.purchase_return_date,purchases.purchase_invoice,"
                    . "sum(purchase_taxable) as purchase_taxable,sum(purchase_discount_percent) as purchase_discount_percent,"
                    . "sum(purchase_cgst) as purchase_cgst,sum(purchase_sgst) as purchase_sgst,sum(purchase_total) as purchase_total  "
                    . "FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id  WHERE 1 = 1 ";

            
            if (!empty($period_start)) {
                $sql .= "AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= "AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= "AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= "AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= "GROUP BY purchase_entry_number";
            #echo $sql;
            # $invoices = $this->db->query("SELECT * FROM `invoices` WHERE invoice_date >='" . $period_start . "' AND invoice_date<='" . $period_end . "'")->result_array();
            $purchase = $this->db->query($sql)->result_array();
            #pr($purchase);
            $customer_data = null;
            foreach ($purchase as $key => $invoice) {
                #$customer_data[$key] = json_decode($invoice['invoice_meta'], true);
                $customer_data[$key]['supplier_name'] = $invoice['supplier_name'];
                $customer_data[$key]['supplier_gst'] = $invoice['supplier_gst'];
                $customer_data[$key]['purchase_invoice'] = $invoice['purchase_invoice'];
                $customer_data[$key]['purchase_date'] = $invoice['purchase_date'];
                $customer_data[$key]['purchase_quantity'] = $invoice['purchase_quantity'];
                $customer_data[$key]['purchase_batch'] = $invoice['purchase_batch'];
                $customer_data[$key]['purchase_taxable'] = $invoice['purchase_taxable'];
                $customer_data[$key]['purchase_discount_percent'] = $invoice['purchase_discount_percent'];
                $original_price = (100 * $invoice['purchase_taxable']) / (100 - $invoice['purchase_discount_percent']);
                $customer_data[$key]['purchase_discount'] = $original_price - $invoice['purchase_taxable'];
                $customer_data[$key]['purchase_cgst'] = $invoice['purchase_cgst'];
                $customer_data[$key]['purchase_sgst'] = $invoice['purchase_sgst'];
                $customer_data[$key]['purchase_total'] = $invoice['purchase_total'];
                $customer_data[$key]['purchase_return'] = $invoice['purchase_return'];
                $customer_data[$key]['purchase_return_date'] = $invoice['purchase_return_date'];
            }
            $sql = "SELECT sum(purchase_cgst),purchase_cgst_percent FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id WHERE 1=1";

            if (!empty($period_start)) {
                $sql .= " AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= " AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= " GROUP BY purchase_cgst_percent";
            // pr($sql);
            $data = $this->db->query($sql)->result_array();
            $daily_gst_data = null;

            foreach ($data as $key => $val) {
                //pr($data,1);
                $daily_gst_data[$key]['purchase_cgst'] = $val['sum(purchase_cgst)'];
                $daily_gst_data[$key]['purchase_cgst_percent'] = $val['purchase_cgst_percent'];
            }

             $sql = "SELECT medicines.medicine_hsn,sum(purchases.purchase_sgst) as sgst, sum(purchases.purchase_cgst) as cgst FROM `purchases` "
                    . "INNER JOIN medicines ON medicines.medicine_id = purchases.purchase_medicine_id "
                    . "JOIN suppliers ON suppliers.supplier_id = purchases.purchase_supplier "
                    . "WHERE 1=1";

            if (!empty($period_start)) {
                $sql .= " AND purchase_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND purchase_date<='" . $period_end . "'";
            }

            if (!empty($supplier_name)) {
                $sql .= " AND supplier_name like '%" . $supplier_name . "%'";
            }
            if (!empty($supplier_gst)) {
                $sql .= " AND supplier_gst like '" . $supplier_gst . "%'";
            }
            $sql .= " GROUP BY medicines.medicine_hsn";
            // pr($sql);
            $hsndata = $this->db->query($sql)->result_array();
            $hsn_daily_gst_data = null;

            foreach ($hsndata as $key => $val) {
                // pr($hsndata,1);
                $hsn_daily_gst_data[$key]['purchase_cgst'] = $val['cgst'];
                $hsn_daily_gst_data[$key]['medicine_hsn'] = $val['medicine_hsn'];
            }
            $this->load->view('console/purchase/report_daily_wise_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {
            $this->load->view('console/purchase/gst_record_tpl', array('hsn_daily_gst_data' => $hsn_daily_gst_data, 'daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    /*     * *******correction needed*********** */

    private function medical_stock_update($old, $new) {
        $toupdate = null;
        $updatewith = null;
        foreach ($old as $key => $value) {
            $toupdate[$value['purchase_medicine_id']] = $value['purchase_quantity'];
            $stockrollback = $value['purchase_quantity'] + $value['purchase_free_quantity'];
        }
        foreach ($new as $key => $value) {
            $updatewith[$value['purchase_medicine_id']] = $value['purchase_quantity'];
            $stockupdate = $value['purchase_quantity'] + $value['purchase_free_quantity'];
        }
    }

    private function medical_stock_rollback($items) {
        if (is_array($items)) {
            foreach ($items as $value) {
                $dataFull = $this->purchases_model->get_list(array('purchase_entry_number' => $value));
                $this->medical_stock_update($dataFull, null);
            }
        } else {
            $dataFull = $this->purchases_model->get_list(array('purchase_entry_number' => $items));
            $this->medical_stock_update($dataFull, null);
        }
    }

    public function med_test() {
        $datas['medicine_name'] = ' PAN 40MG 15S ';
        $data = $this->medicines_model->get_list($datas);
        if (empty($data)) {
            echo 'not duplicate';
        } else {
            echo count($data) . '-' . 'duplicate';
        }
    }

    public function entry_number_fix() {
        $data = $this->db->query('select distinct(purchase_invoice) from purchases order by purchase_ID ')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("UPDATE `purchases` SET `purchase_entry_number` = '" . ($key + 1) . "' WHERE `purchases`.`purchase_invoice` ='" . $value['purchase_invoice'] . "'");
        }
        //pr($data);
    }

    public function check_duplicate_invoice() {
        $purchase_invoice = $this->input->post('purchase_invoice');
        $supplier['supplier_name'] = $this->input->post('supplier_name');
      
        $data = $this->suppliers_model->get_list($supplier);
        $datax = $this->{$this->targetModel}->get_list(
                array(
                    'supplier_id' => $data[0]['supplier_id'],
                    'purchase_invoice' => $purchase_invoice
        ));
         $response['invoice_count'] = count($datax);
        header('Content-Type: application/json');
        echo json_encode($response); 
    }
public function check_duplicate_medicine() {
        $data = $this->input->post();
        $datas['medicine_name'] =trim($data['medicine']);
        $data_r = $this->medicines_model->get_list($datas);
        $response['medicine_count'] = count($data_r);
        header('Content-Type: application/json');
        echo json_encode($response); 
    }

    public function find_the_error() {
        $data = $this->db->query('select distinct purchase_entry_number,purchase_medicine_id,purchase_batch,purchase_mrp from purchases where purchase_medicine_id not in (select medicine_ID from medicines)')->result_array();
        // pr($data);
    }

    public function purchase_history() {
        //pp(11);
        $data = $this->input->post();
        $datay = $this->db->query('select medicine_id from medicines where medicine_name like "' . trim($data['medicine']) . '"')->result_array();
        $datax = $this->db->query('select purchase_date,supplier_name,purchase_invoice,purchase_batch,purchase_quantity,purchase_mrp,purchase_rate from purchases join suppliers on supplier_ID = purchase_supplier where purchase_medicine_id ="' . $datay[0]['medicine_id'] . '" order by purchase_date desc limit 0,5')->result_array();
        $this->load->view('console/purchase/purchase_history_tpl', array('data' => $datax, 'medicine' => $data['medicine']));
    }
 public function purchase_reminder() {
        
        $data = $this->input->post();
        //pp($data['medicine'],1 );
        $datay = $this->db->query('select medicine_id from medicines where medicine_name like "' . trim($data['medicine']) . '"')->result_array();
        $datax = $this->db->query('select purchase_date,supplier_name,purchase_invoice,purchase_batch,purchase_quantity,purchase_mrp,purchase_rate from purchases join suppliers on supplier_ID = purchase_supplier where purchase_medicine_id ="' . $datay[0]['medicine_id'] . '" order by purchase_date desc limit 0,5')->result_array();
         $response['data'] = $datax;
         $response['medicine'] =  $data['medicine'];
        echo json_encode($response); 
       // $this->load->view('console/purchase/purchase_history_tpl', array('data' => $datax, 'medicine' => $data['medicine']));
    }

}

?>
