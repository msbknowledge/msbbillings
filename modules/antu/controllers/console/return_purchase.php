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
class Return_purchase extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'return_purchase_model';
        $this->page_config['tablePrimaryKey'] = $this->return_purchase_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Return Purchase'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,delete,edit_detail';
        $this->page_config['searchFields'] = 'return_purchase_ref,return_purchase_type,return_purchase_medicine,return_purchase_date,return_purchase_supplier,return_purchase_Batch'; //search box,
        $this->page_config['list_columns'] = 'return_purchase_entry_number,return_purchase_type,return_purchase_date,return_purchase_supplier,return_purchase_sum_total,return_purchase_HSN,return_purchase_Batch';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['use_dropdown_columns'] = 'medicine_name,return_purchase_supplier,return_purchase_type';
        $this->page_config['use_dropdown_columns_options']['return_purchase_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk
        $this->page_config['use_dropdown_columns_options']['return_purchase_type'] = array("expiry"=>"Expiry","extra"=>"Extra","damage"=>"Damage");

        /*         * end page_config* */
    }

    public function add_detail() {
    	
        if ($this->input->post()) {

            $supplier = ($this->input->post());
           
            $supplier_ID = $supplier['suplier_id'];
            //pr($supplier_ID,1);
            $return_purchase = null;
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_purchase_mrp')); $i++) {
                $return_purchase[$i]['return_purchase_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_purchase[$i]['return_purchase_supplier'] = $supplier_ID;
                $return_purchase[$i]['return_purchase_type'] = $this->input->post('return_purchase_type');

                $return_purchase[$i]['return_purchase_entry_number'] = $this->input->post('return_purchase_entry_number');
                $return_purchase[$i]['return_purchase_strip'] = $this->input->post('return_purchase_strip')[$i];
 				$medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                     } else {
                    $medicine_id = $data[0]['medicine_id'];
                }
                $return_purchase[$i]['return_purchase_medicine_id'] = $medicine_id;

				$return_purchase[$i]['return_purchase_medicine'] = trim($this->input->post('medicine_name')[$i]);
                $return_purchase[$i]['return_purchase_expire_month'] = $this->input->post('return_purchase_expire_month')[$i];
                $return_purchase[$i]['return_purchase_expire_year'] = $this->input->post('return_purchase_expire_year')[$i];
                $return_purchase[$i]['return_purchase_mrp'] = $this->input->post('return_purchase_mrp')[$i];
                $return_purchase[$i]['return_purchase_total'] = $this->input->post('return_purchase_total')[$i];
                $return_purchase[$i]['return_purchase_ref'] = $this->input->post('return_purchase_ref');
                $return_purchase[$i]['return_purchase_HSN'] = $this->input->post('medicine_hsn')[$i];
                $return_purchase[$i]['return_purchase_Batch'] = $this->input->post('return_purchase_Batch')[$i];
                //  pr($return_purchase,1);
				}
            // print_r($return_purchase);
            // die();
            // pr($return_purchase, 1);
            $data = $this->return_purchase_model->insert_data($return_purchase, true);
            increase_expiry_number();
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('return_purchase_type'=>$this->page_config['use_dropdown_columns_options']['return_purchase_type'],'supplier' => $supplier_data, 'status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('return_purchase_type'=>$this->page_config['use_dropdown_columns_options']['return_purchase_type'],'supplier' => $supplier_data), 'add_detail');
        }
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
        $likeConditionsSql = " where 1 = 1 ";
        foreach ($likeCondition as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $likeConditionsSql .= " and $key like '%$value%'";
        }
        $paging = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        $limit = $this->current_site_settings['site_setting_record_per_page'];
        $offset = $paging;
        $sql = "SELECT return_purchases.*,SUM(return_purchase_total) as return_purchase_sum_total,"
                . "suppliers.*"
                . " from return_purchases "
                . " left JOIN suppliers ON suppliers.supplier_id=return_purchases.return_purchase_supplier "
                . " $likeConditionsSql "
                . " group BY return_purchase_entry_number "
                . " $orderBy "
                . " limit $offset,$limit";
      // pr($sql);
        $countsql = "select count(*) as totalrw from ( SELECT return_purchases.return_purchase_entry_number from return_purchases"
                . " $likeConditionsSql "
                . " group BY return_purchase_entry_number) as countData ";
        $allData['current_paged_list'] = $this->db->query($sql)->result_array();
        $totalrw = $this->db->query($countsql)->result_array();
        $allData['total_rows'] = $totalrw[0]['totalrw'];
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }
    /**
     * index show list
     */
    public function index_old() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();

        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'return_purchase_entry_number');
        //pr($this->db->last_query());
        foreach ($allData['current_paged_list'] as $key => $value) {
            $totalSum = $this->db->query('select sum(return_purchase_total) as sum_total from return_purchases where return_purchase_entry_number= "' . $value['return_purchase_entry_number'] . '"')->result_array();
            ;
            $allData['current_paged_list'][$key]['return_purchase_sum_total'] = round($totalSum[0]['sum_total']);
        }

        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data, 'index_tpl');
        }
    }

    /**
     * view detail
     */
    public function view_detail() {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));

        $data = $this->{$this->targetModel}->get_list(array('return_purchase_entry_number' => $invoice));
        if ($type == 'print')
            $this->load->view('console/return_purchase/print_detail', array('data' => $data));
        else
            $this->render(array('data' => $data), 'view_detail');
    }

    /**
     * view detail
     */

    /**
     * view detail
     */
    public function edit_detail() {
        $invoice = base64_decode($this->uri->segment(4));
        $dataFull = $this->{$this->targetModel}->get_list(array('return_purchase_entry_number' => $invoice));
        //pr($dataFull,1);
        if ($this->input->post()) {

            // pr($this->input->post(),1);

            $supplier = ($this->input->post());
            // pr($supplier,1);
            $supplier_ID = $supplier['suplier_id'];
            //pr($supplier_ID,1);
            $return_purchase = null;
            $stock = 0;
            $unit = 0;


            for ($i = 0; $i < count($this->input->post('return_purchase_mrp')); $i++) {
                $return_purchase[$i]['return_purchase_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
 				$medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                     } else {
                    $medicine_id = $data[0]['medicine_id'];
                }
                $return_purchase[$i]['return_purchase_medicine_id'] = $medicine_id;

                $return_purchase[$i]['return_purchase_supplier'] = $supplier_ID;
                $return_purchase[$i]['return_purchase_type'] = $this->input->post('return_purchase_type');

                $return_purchase[$i]['return_purchase_entry_number'] = $this->input->post('return_purchase_entry_number');
                $return_purchase[$i]['return_purchase_strip'] = $this->input->post('return_purchase_strip')[$i];
                $return_purchase[$i]['return_purchase_medicine'] = trim($this->input->post('medicine_name')[$i]);
                $return_purchase[$i]['return_purchase_expire_month'] = $this->input->post('return_purchase_expire_month')[$i];
                $return_purchase[$i]['return_purchase_expire_year'] = $this->input->post('return_purchase_expire_year')[$i];
                $return_purchase[$i]['return_purchase_mrp'] = $this->input->post('return_purchase_mrp')[$i];
                $return_purchase[$i]['return_purchase_total'] = $this->input->post('return_purchase_total')[$i];
                $return_purchase[$i]['return_purchase_ref'] = $this->input->post('return_purchase_ref');
                $return_purchase[$i]['return_purchase_HSN'] = $this->input->post('return_purchase_HSN')[$i];
                $return_purchase[$i]['return_purchase_Batch'] = $this->input->post('return_purchase_Batch')[$i];
                //  pr($return_purchase,1);
            }
            // pr($return_purchase, 1);
            $this->db->query('DELETE FROM `return_purchases` WHERE return_purchase_entry_number=' . $return_purchase[0]['return_purchase_entry_number']);

            $data = $this->return_purchase_model->insert_data($return_purchase, true);
            increase_expiry_number();

            redirect(console_url('return_purchase'));
        } else {
            $supplier_data = $this->suppliers_model->get_list();
            $this->render(array('return_purchase_type'=>$this->page_config['use_dropdown_columns_options']['return_purchase_type'],'supplier' => $supplier_data, 'data' => $dataFull), 'edit_detail_tpl');
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
            $this->{$this->targetModel}->delete(array('return_purchase_entry_number' => $postedData['selectedItem']), TRUE);
        }
        if (isset($postedData['entry'])) {
            $this->{$this->targetModel}->delete(array('return_purchase_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function purchases_report() {
        $is_ajax = $this->input->is_ajax_request() || ($this->input->post('key') == 'ajax_resp') || $this->input->get('ajax');

        $period_start                 = $this->input->get_post('start');
        $period_end                   = $this->input->get_post('end');
        $supplier_name                = $this->input->get_post('supplier_name');
        $return_purchase_type         = $this->input->get_post('return_purchase_type');
        $return_purchase_medicine     = $this->input->get_post('return_purchase_medicine');
        $return_purchase_Batch        = $this->input->get_post('return_purchase_Batch');
        $return_purchase_ref          = $this->input->get_post('return_purchase_ref');
        $return_purchase_entry_number = $this->input->get_post('return_purchase_entry_number');

        // Default to last 1 month if GET without dates
        if ($period_start === NULL && $period_end === NULL && !$this->input->post()) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
            $period_end   = date('Y-m-d');
        }

        $report_data = $this->_get_purchases_report_data(
            $period_start,
            $period_end,
            $supplier_name,
            $return_purchase_type,
            $return_purchase_medicine,
            $return_purchase_Batch,
            $return_purchase_ref,
            $return_purchase_entry_number
        );

        $report_data['start']                        = $period_start;
        $report_data['end']                          = $period_end;
        $report_data['supplier_name']                = !empty($supplier_name) ? $supplier_name : '';
        $report_data['return_purchase_type']         = !empty($return_purchase_type) ? $return_purchase_type : '';
        $report_data['return_purchase_medicine']     = !empty($return_purchase_medicine) ? $return_purchase_medicine : '';
        $report_data['return_purchase_Batch']        = !empty($return_purchase_Batch) ? $return_purchase_Batch : '';
        $report_data['return_purchase_ref']          = !empty($return_purchase_ref) ? $return_purchase_ref : '';
        $report_data['return_purchase_entry_number'] = !empty($return_purchase_entry_number) ? $return_purchase_entry_number : '';
        $report_data['supplier']                     = $this->suppliers_model->get_list();

        if ($is_ajax) {
            $this->load->view('console/return_purchase/purchase_ajax_report_tpl', $report_data);
        } else {
            $this->render($report_data, 'purchase_report_tpl');
        }
    }

    private function _get_purchases_report_data($start = null, $end = null, $supplier_name = null, $return_purchase_type = null, $return_purchase_medicine = null, $return_purchase_Batch = null, $return_purchase_ref = null, $return_purchase_entry_number = null) {
        $sql = "SELECT return_purchases.*, suppliers.supplier_name, suppliers.supplier_gst, suppliers.supplier_contact "
             . "FROM `return_purchases` "
             . "LEFT JOIN `suppliers` ON return_purchases.return_purchase_supplier = suppliers.supplier_id "
             . "WHERE 1 = 1 ";

        if (!empty($supplier_name)) {
            $sql .= " AND suppliers.supplier_name LIKE " . $this->db->escape('%' . $supplier_name . '%');
        }
        if (!empty($return_purchase_type)) {
            $sql .= " AND return_purchases.return_purchase_type LIKE " . $this->db->escape('%' . $return_purchase_type . '%');
        }
        if (!empty($start) && !empty($end)) {
            $sql .= " AND return_purchases.return_purchase_date BETWEEN " . $this->db->escape($start) . " AND " . $this->db->escape($end);
        } elseif (!empty($start)) {
            $sql .= " AND return_purchases.return_purchase_date >= " . $this->db->escape($start);
        } elseif (!empty($end)) {
            $sql .= " AND return_purchases.return_purchase_date <= " . $this->db->escape($end);
        }
        if (!empty($return_purchase_medicine)) {
            $sql .= " AND return_purchases.return_purchase_medicine LIKE " . $this->db->escape('%' . $return_purchase_medicine . '%');
        }
        if (!empty($return_purchase_Batch)) {
            $sql .= " AND return_purchases.return_purchase_Batch LIKE " . $this->db->escape('%' . $return_purchase_Batch . '%');
        }
        if (!empty($return_purchase_ref)) {
            $sql .= " AND return_purchases.return_purchase_ref LIKE " . $this->db->escape('%' . $return_purchase_ref . '%');
        }
        if (!empty($return_purchase_entry_number)) {
            $sql .= " AND return_purchases.return_purchase_entry_number LIKE " . $this->db->escape('%' . $return_purchase_entry_number . '%');
        }

        $sql .= " ORDER BY return_purchases.return_purchase_date DESC, return_purchases.return_purchase_entry_number DESC";

        $collections = $this->db->query($sql)->result_array();

        $return_purchase_data = array();
        $total_return_amount = 0;
        $total_quantity = 0;
        $unique_entries = array();
        $unique_suppliers = array();
        $type_counts = array();
        $type_amounts = array();

        if (!empty($collections)) {
            foreach ($collections as $key => $var) {
                $amount = (float)(isset($var['return_purchase_total']) ? $var['return_purchase_total'] : 0);
                $qty = (int)(isset($var['return_purchase_strip']) ? $var['return_purchase_strip'] : 0);
                $raw_type = isset($var['return_purchase_type']) ? trim($var['return_purchase_type']) : '';
                $type_label = !empty($raw_type) ? ucfirst(strtolower($raw_type)) : 'General';

                $total_return_amount += $amount;
                $total_quantity += $qty;

                if (!empty($var['return_purchase_entry_number'])) {
                    $unique_entries[$var['return_purchase_entry_number']] = true;
                }
                if (!empty($var['supplier_name'])) {
                    $unique_suppliers[$var['supplier_name']] = true;
                }

                if (!isset($type_counts[$type_label])) {
                    $type_counts[$type_label] = 0;
                    $type_amounts[$type_label] = 0;
                }
                $type_counts[$type_label]++;
                $type_amounts[$type_label] += $amount;

                $return_purchase_data[$key] = array(
                    'return_purchase_ID'           => isset($var['return_purchase_ID']) ? $var['return_purchase_ID'] : '',
                    'return_purchase_entry_number' => isset($var['return_purchase_entry_number']) ? $var['return_purchase_entry_number'] : '',
                    'supplier_id'                  => isset($var['supplier_id']) ? $var['supplier_id'] : '',
                    'supplier_name'                => isset($var['supplier_name']) ? $var['supplier_name'] : '',
                    'supplier_gst'                 => isset($var['supplier_gst']) ? $var['supplier_gst'] : '',
                    'return_purchase_strip'        => $qty,
                    'return_purchase_type'         => $raw_type,
                    'return_purchase_medicine'     => isset($var['return_purchase_medicine']) ? $var['return_purchase_medicine'] : '',
                    'return_purchase_Batch'        => isset($var['return_purchase_Batch']) ? $var['return_purchase_Batch'] : '',
                    'return_purchase_date'         => isset($var['return_purchase_date']) ? $var['return_purchase_date'] : '',
                    'return_purchase_ref'          => isset($var['return_purchase_ref']) ? $var['return_purchase_ref'] : '',
                    'return_purchase_mrp'          => isset($var['return_purchase_mrp']) ? $var['return_purchase_mrp'] : 0,
                    'return_purchase_expire_month' => isset($var['return_purchase_expire_month']) ? $var['return_purchase_expire_month'] : '',
                    'return_purchase_expire_year'  => isset($var['return_purchase_expire_year']) ? $var['return_purchase_expire_year'] : '',
                    'return_purchase_total'        => $amount,
                    'return_purchase_HSN'          => isset($var['return_purchase_HSN']) ? $var['return_purchase_HSN'] : '',
                );
            }
        }

        return array(
            'return_purchase_data' => $return_purchase_data,
            'total_return_amount'  => $total_return_amount,
            'total_quantity'       => $total_quantity,
            'total_items'          => count($return_purchase_data),
            'total_entries'        => count($unique_entries),
            'total_suppliers'      => count($unique_suppliers),
            'type_counts'          => $type_counts,
            'type_amounts'         => $type_amounts,
        );
    }

    public function purchases_report_export() {
        $period_start                 = $this->input->get('start');
        $period_end                   = $this->input->get('end');
        $supplier_name                = $this->input->get('supplier_name');
        $return_purchase_type         = $this->input->get('return_purchase_type');
        $return_purchase_medicine     = $this->input->get('return_purchase_medicine');
        $return_purchase_Batch        = $this->input->get('return_purchase_Batch');
        $return_purchase_ref          = $this->input->get('return_purchase_ref');
        $return_purchase_entry_number = $this->input->get('return_purchase_entry_number');

        if (empty($period_start) && empty($period_end)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
            $period_end   = date('Y-m-d');
        }

        $rep = $this->_get_purchases_report_data(
            $period_start,
            $period_end,
            $supplier_name,
            $return_purchase_type,
            $return_purchase_medicine,
            $return_purchase_Batch,
            $return_purchase_ref,
            $return_purchase_entry_number
        );

        $return_purchase_data = $rep['return_purchase_data'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Return Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Entry / Voucher #');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Supplier Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Supplier GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Return Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Batch');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Exp Date (MM/YY)');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Qty (Strips)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'MRP');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Reference');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Total (INR)');

        $rowCount = 2;
        $sl = 1;
        $total_qty = 0;
        $total_amt = 0;

        if (!empty($return_purchase_data)) {
            foreach ($return_purchase_data as $row) {
                $exp = (!empty($row['return_purchase_expire_month']) || !empty($row['return_purchase_expire_year']))
                    ? $row['return_purchase_expire_month'] . '/' . $row['return_purchase_expire_year']
                    : '';
                $qty = (int)$row['return_purchase_strip'];
                $amt = (float)$row['return_purchase_total'];

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sl++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, isset($row['return_purchase_date']) ? $row['return_purchase_date'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, isset($row['return_purchase_entry_number']) ? $row['return_purchase_entry_number'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, isset($row['supplier_name']) ? $row['supplier_name'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, isset($row['supplier_gst']) ? $row['supplier_gst'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, isset($row['return_purchase_medicine']) ? $row['return_purchase_medicine'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, isset($row['return_purchase_type']) ? ucfirst($row['return_purchase_type']) : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, isset($row['return_purchase_Batch']) ? $row['return_purchase_Batch'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $exp);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $qty);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, isset($row['return_purchase_mrp']) ? $row['return_purchase_mrp'] : 0);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, isset($row['return_purchase_ref']) ? $row['return_purchase_ref'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $amt);

                $total_qty += $qty;
                $total_amt += $amt;
                $rowCount++;
            }
        }

        // Summary Total Row
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Total');
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $total_qty);
        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $total_amt);

        $filename = "purchase_return_report_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }
    public function fetch_medicine_return() {
        $data = $this->input->post();
        $datas['medicine_name'] =trim($data['medicine']);
       // $datas['return_purchase_Batch'] =trim($data['purchase_Batch']);
        $data_r = $this->medicines_model->get_list($datas);
        $response['medicine_count'] = count($data_r);
        header('Content-Type: application/json');
        echo json_encode($response); 
    }
  public function fetch_invoice_details()
    {
        
        $postedData = $this->input->get();
        $invoice = $postedData['term'];

         $data = $this->purchases_model->get_list(array('purchase_batch' => $invoice));
//print_r(   $data );die();
        foreach ($data as $key => $value) {
            $responce[] = array('id' => $value['purchase_invoice'], 'label' => $value['purchase_invoice'], 'value' => $value['purchase_invoice'], 'complete' => $value, 'data' => $data);
        }
        echo json_encode($responce);
    }
}

?>
