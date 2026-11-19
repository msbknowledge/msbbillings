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
class Payments extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'payments_model';
        $this->moduleMeta = array('medical' => 'Payments');
        $this->page_config['tablePrimaryKey'] = $this->payments_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['autocomplete']['payment_suppliers'] = array('suppliers' => 'supplier_name');
        $this->page_config['title'] = 'Payments'; //search title bar
        $this->page_config['searchFields'] = 'payment_suppliers,payment_date,payment_ID'; //search box,
        $this->page_config['list_columns'] = 'payment_ID,payment_suppliers,payment_date,payment_paid_amount,payment_note';
        $this->page_config['use_dropdown_columns'] = 'payment_suppliers,';
        $this->page_config['use_dropdown_columns_options']['payment_suppliers'] = $this->suppliers_model->get_list_for_dropdown('supplier_name');
        /*         * end page_config* */
    }

    public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config);
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function add_payment_supplier() {
        $this->load->model('purchases_model');
        $postedData = $this->input->post('supplier_id');
        $pre_payment_invoice = $this->input->post('pre_payment_invoice');
        //pr($this->input->post());
        if (!empty($postedData)) {
            $alldata = $this->db->query("select payment_invoice from payments where payment_suppliers=$postedData")->result_array();
            // pr($alldata);
            $pre_payment_invoice = "";
            foreach ($alldata as $k => $v) {
                if (!empty($pre_payment_invoice) && (!empty($v['payment_invoice']))) {

                    $pre_payment_invoice .= ',' . $v['payment_invoice'];
                } else {

                    $pre_payment_invoice .= $v['payment_invoice'];
                }
            }

            $sql = "
                select sum(purchases.purchase_total) as total,purchases.purchase_entry_number,
                purchases.purchase_date,purchases.purchase_invoice,suppliers.supplier_name,suppliers.supplier_id 
                from purchases  join suppliers on 
                purchases.purchase_supplier=suppliers.supplier_id 
                WHERE supplier_id=$postedData ";
            if (!empty($pre_payment_invoice)) {
                $sql .= "AND  purchases.purchase_invoice NOT IN($pre_payment_invoice)";
            }
            $sql .= " group by purchase_invoice";
            $sql .= " ORDER BY purchase_date DESC ";
//pr($sql);
            $data = $this->db->query($sql)->result_array();

            $this->load->view('console/payment/dropdown_list_tpl', array('data' => $data));
        }
    }

    public function add_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
         $this->page_config['validation'] = array('required' => array('payment_suppliers'));
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config, 'payment/add_detail');
            //echo $this->generate_form_view($entryData[0], $this->page_config);
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

                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    public function edit_detail() {
        $postedData = $this->input->post();
         $this->page_config['validation'] = array('required' => array('payment_suppliers'));
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config, 'payment/add_detail');
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

                $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
                echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
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

    public function due_report()
    {
        $is_ajax = $this->input->is_ajax_request() || ($this->input->post('key') == 'ajax_resp') || $this->input->get('ajax');

        $start         = $this->input->get_post('start');
        $end           = $this->input->get_post('end');
        $supplier_name = $this->input->get_post('supplier_name');

        if (empty($start) && empty($end) && !$this->input->post()) {
            $start = date('Y-m-d', strtotime('-1 month'));
            $end   = date('Y-m-d');
        }

        $report_data = $this->_get_due_report_data($start, $end, $supplier_name);
        $report_data['start']         = $start;
        $report_data['end']           = $end;
        $report_data['supplier_name'] = !empty($supplier_name) ? $supplier_name : '';

        if ($is_ajax) {
            $this->load->view('console/payment/due_ajax_report_tpl', $report_data);
        } else {
            $this->render($report_data, 'due_report_tpl');
        }
    }

    private function _get_due_report_data($start = null, $end = null, $supplier_name = null)
    {
        // 1. Get purchases by supplier
        $p_sql = "SELECT suppliers.supplier_id, suppliers.supplier_name, suppliers.supplier_contact, suppliers.supplier_gst, "
               . "sum(purchases.purchase_total) as purchase_total "
               . "FROM `purchases` "
               . "JOIN `suppliers` ON suppliers.supplier_id = purchases.purchase_supplier "
               . "WHERE (purchases.purchase_return = 0 OR purchases.purchase_return IS NULL) ";

        if (!empty($start)) {
            $p_sql .= " AND DATE_FORMAT(purchases.purchase_date, '%Y-%m-%d') >= " . $this->db->escape($start);
        }
        if (!empty($end)) {
            $p_sql .= " AND DATE_FORMAT(purchases.purchase_date, '%Y-%m-%d') <= " . $this->db->escape($end);
        }
        if (!empty($supplier_name)) {
            $p_sql .= " AND suppliers.supplier_name LIKE " . $this->db->escape('%' . $supplier_name . '%');
        }
        $p_sql .= " GROUP BY suppliers.supplier_id";

        $purchases = $this->db->query($p_sql)->result_array();

        // 2. Get payments by supplier
        $pay_sql = "SELECT suppliers.supplier_id, suppliers.supplier_name, suppliers.supplier_contact, suppliers.supplier_gst, "
                 . "sum(payments.payment_paid_amount) as payment_paid_amount "
                 . "FROM `payments` "
                 . "JOIN `suppliers` ON suppliers.supplier_id = payments.payment_suppliers "
                 . "WHERE 1 = 1 ";

        if (!empty($start)) {
            $pay_sql .= " AND DATE_FORMAT(payments.payment_date, '%Y-%m-%d') >= " . $this->db->escape($start);
        }
        if (!empty($end)) {
            $pay_sql .= " AND DATE_FORMAT(payments.payment_date, '%Y-%m-%d') <= " . $this->db->escape($end);
        }
        if (!empty($supplier_name)) {
            $pay_sql .= " AND suppliers.supplier_name LIKE " . $this->db->escape('%' . $supplier_name . '%');
        }
        $pay_sql .= " GROUP BY suppliers.supplier_id";

        $payments = $this->db->query($pay_sql)->result_array();

        // Merge results keyed by supplier_id
        $alldata = array();
        $total_purchases = 0;
        $total_paid = 0;
        $total_due = 0;

        if (!empty($purchases)) {
            foreach ($purchases as $p) {
                $sid = $p['supplier_id'];
                $p_amt = (float)$p['purchase_total'];
                $alldata[$sid] = array(
                    'supplier_id'         => $sid,
                    'supplier_name'       => $p['supplier_name'],
                    'supplier_contact'    => isset($p['supplier_contact']) ? $p['supplier_contact'] : '',
                    'supplier_gst'        => isset($p['supplier_gst']) ? $p['supplier_gst'] : '',
                    'purchase_total'      => $p_amt,
                    'payment_paid_amount' => 0,
                    'due_amount'          => $p_amt,
                );
            }
        }

        if (!empty($payments)) {
            foreach ($payments as $pay) {
                $sid = $pay['supplier_id'];
                $paid_amt = (float)$pay['payment_paid_amount'];
                if (isset($alldata[$sid])) {
                    $alldata[$sid]['payment_paid_amount'] = $paid_amt;
                    $alldata[$sid]['due_amount'] = $alldata[$sid]['purchase_total'] - $paid_amt;
                } else {
                    $alldata[$sid] = array(
                        'supplier_id'         => $sid,
                        'supplier_name'       => $pay['supplier_name'],
                        'supplier_contact'    => isset($pay['supplier_contact']) ? $pay['supplier_contact'] : '',
                        'supplier_gst'        => isset($pay['supplier_gst']) ? $pay['supplier_gst'] : '',
                        'purchase_total'      => 0,
                        'payment_paid_amount' => $paid_amt,
                        'due_amount'          => 0 - $paid_amt,
                    );
                }
            }
        }

        // Calculate summary KPIs
        $due_suppliers_count = 0;
        $cleared_suppliers_count = 0;
        foreach ($alldata as $row) {
            $total_purchases += $row['purchase_total'];
            $total_paid      += $row['payment_paid_amount'];
            $total_due       += $row['due_amount'];
            if ($row['due_amount'] > 0.01) {
                $due_suppliers_count++;
            } else {
                $cleared_suppliers_count++;
            }
        }

        return array(
            'alldata'                 => $alldata,
            'total_suppliers'         => count($alldata),
            'total_purchases'         => $total_purchases,
            'total_paid'              => $total_paid,
            'total_due'               => $total_due,
            'due_suppliers_count'     => $due_suppliers_count,
            'cleared_suppliers_count' => $cleared_suppliers_count,
        );
    }

    public function due_report_export()
    {
        $start         = $this->input->get('start');
        $end           = $this->input->get('end');
        $supplier_name = $this->input->get('supplier_name');

        if (empty($start) && empty($end)) {
            $start = date('Y-m-d', strtotime('-1 month'));
            $end   = date('Y-m-d');
        }

        $rep = $this->_get_due_report_data($start, $end, $supplier_name);
        $alldata = $rep['alldata'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Supplier Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Contact');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'GSTIN');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Purchase Amount (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Paid Amount (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Due Amount (₹)');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Status');

        $rowCount = 2;
        $total_purchase = 0;
        $total_paid = 0;
        $total_due = 0;

        if (!empty($alldata)) {
            $counter = 1;
            foreach ($alldata as $list) {
                $status = ($list['due_amount'] > 0.01) ? 'Due' : (($list['due_amount'] < -0.01) ? 'Advance' : 'Cleared');
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['supplier_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['supplier_contact']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['supplier_gst']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, (float)$list['purchase_total']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, (float)$list['payment_paid_amount']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, (float)$list['due_amount']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $status);

                $total_purchase += (float)$list['purchase_total'];
                $total_paid     += (float)$list['payment_paid_amount'];
                $total_due      += (float)$list['due_amount'];
                $rowCount++;
            }
        }

        // Footer total
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $total_purchase);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_paid);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $total_due);

        $filename = "supplier_due_report_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

}

?>