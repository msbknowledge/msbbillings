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
class Return_sale extends MY_Controller
{

    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->targetModel = 'return_sale_model';
        $this->page_config['tablePrimaryKey'] = $this->return_sale_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = '  Sale Return'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,view_detail,delete,edit_detail';
        $this->page_config['searchFields'] = 'return_sale_ref,return_sale_medicine,return_sale_date,return_sale_Batch,return_sale_invoice'; //search box,
        $this->page_config['list_columns'] = 'return_sale_date,return_sale_invoice,return_sale_medicine,return_sale_customer,return_sale_sum_total,return_sale_HSN,return_sale_Batch';
        $this->page_config['autocomplete']['customer_name'] = array('customers' => 'customer_name');
        $this->page_config['autocomplete']['customer_gst'] = array('customers' => 'customer_gst');

        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');


        $this->page_config['use_dropdown_columns'] = 'medicine_name';
        // $this->page_config['use_dropdown_columns_options']['return_sale_customer'] = $this->customers_model->get_list_for_dropdown('customer_name'); //pk

        /*         * end page_config* */
    }

    public function add_detail()
    {

        if ($this->input->post()) {

            $customer = ($this->input->post());

            $customer_ID = $customer['customer_ID'];
            $return_sale = null;
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_sale_mrp')); $i++) {
                $return_sale[$i]['return_sale_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_sale[$i]['return_sale_customer'] = $customer_ID;

                $return_sale[$i]['return_sale_entry_number'] = $this->input->post('return_sale_entry_number');
                $return_sale[$i]['return_sale_strip'] = $this->input->post('return_sale_strip')[$i];

                $medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                } else {
                    $medicine_id = $data[0]['medicine_id'];
                    //$this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
                }
                $return_sale[$i]['return_sale_medicine_id'] = $medicine_id;
                $return_sale[$i]['return_sale_invoice'] = $this->input->post('return_sale_invoice');
                $return_sale[$i]['return_sale_medicine'] = trim($this->input->post('medicine_name')[$i]);
                $return_sale[$i]['return_sale_expire_month'] = $this->input->post('return_sale_expire_month')[$i];
                $return_sale[$i]['return_sale_expire_year'] = $this->input->post('return_sale_expire_year')[$i];
                $return_sale[$i]['return_sale_mrp'] = $this->input->post('return_sale_mrp')[$i];
                $return_sale[$i]['return_sale_total'] = $this->input->post('return_sale_total')[$i];
                $return_sale[$i]['return_sale_ref'] = $this->input->post('return_sale_ref');
                $return_sale[$i]['return_sale_HSN'] = $this->input->post('return_sale_HSN')[$i];
                $return_sale[$i]['return_sale_Batch'] = $this->input->post('return_sale_Batch')[$i];
                //  pr($return_sale,1);
            }
            //pr($return_sale, 1);
            $data = $this->return_sale_model->insert_data($return_sale, true);
            increase_expiry_number();
            $customer_data = $this->customers_model->get_list();
            $this->render(array('customer' => $customer_data, 'status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            //$customer_data =$this->db->query("select customer_ID,customer_name from customers ORDER BY customer_name")->result_array();
            // $customer_data = $this->customers_model->get_list();
            //pr($customer_data);
            $this->render(null, 'add_detail');
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

        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy, 'return_sale_entry_number');
        //pr($this->db->last_query());
        foreach ($allData['current_paged_list'] as $key => $value) {
            $totalSum = $this->db->query('select sum(return_sale_total) as sum_total from returns_sales where return_sale_entry_number= "' . $value['return_sale_entry_number'] . '"')->result_array();;
            $allData['current_paged_list'][$key]['return_sale_sum_total'] = round($totalSum[0]['sum_total']);
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
    public function view_detail()
    {
        $invoice = base64_decode($this->uri->segment(4));
        $type = ($this->uri->segment(5));

        $data = $this->{$this->targetModel}->get_list(array('return_sale_entry_number' => $invoice));
        if ($type == 'print')
            $this->load->view('console/return_sale/print_detail', array('data' => $data));
        else
            $this->render(array('data' => $data), 'view_detail');
    }

    /**
     * edit detail
     */
    public function edit_detail()
    {
        $invoice = base64_decode($this->uri->segment(4));
        $dataFull = $this->{$this->targetModel}->get_list(array('return_sale_entry_number' => $invoice));
    
        foreach ($dataFull as $key => $value) {
            $sale_data = $this->sales_model->get_list(array('sale_invoice' => $value['return_sale_invoice'], 'sale_medicine_id' => $value['return_sale_medicine_id'], 'sale_batch' => $value['return_sale_Batch']));
            $dataFull[$key]['max_strip_limit'] = $sale_data[0]['sale_strip_quantity'];
        }

        if ($this->input->post()) {
            $customer = ($this->input->post());

            $customer_ID = $customer['customer_ID'];
            $this->db->query('DELETE FROM `returns_sales` WHERE return_sale_entry_number =' . $this->input->post('return_sale_entry_number'));
            $return_sale = null;
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('return_sale_mrp')); $i++) {
               
                $medicine = null;
                $medicine['medicine_name'] = trim($this->input->post('medicine_name')[$i]);
                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;

                $data = $this->medicines_model->get_list($medicine);
                $medicine_id = null;
                if (empty($data)) {
                    $data = $this->medicines_model->insert_data($medicine);
                    $medicine_id = $data;
                } else {
                    $medicine_id = $data[0]['medicine_id'];
                }

                $return_sale['return_sale_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date')));
                $return_sale['return_sale_medicine_id'] = $medicine_id;
                $return_sale['return_sale_medicine'] = trim($this->input->post('medicine_name')[$i]);

                $return_sale['return_sale_customer'] = $customer_ID;
                $return_sale['return_sale_entry_number'] = $this->input->post('return_sale_entry_number');
                $return_sale['return_sale_strip'] = $this->input->post('return_sale_strip')[$i];

                $return_sale['return_sale_expire_month'] = $this->input->post('return_sale_expire_month')[$i];
                $return_sale['return_sale_expire_year'] = $this->input->post('return_sale_expire_year')[$i];
                $return_sale['return_sale_mrp'] = $this->input->post('return_sale_mrp')[$i];
                $return_sale['return_sale_total'] = $this->input->post('return_sale_total')[$i];
                $return_sale['return_sale_invoice'] = $this->input->post('return_sale_invoice');
                $return_sale['return_sale_ref'] = $this->input->post('return_sale_ref');
                $return_sale['return_sale_HSN'] = $this->input->post('return_sale_HSN')[$i];
                $return_sale['return_sale_Batch'] = $this->input->post('return_sale_Batch')[$i];

                $this->return_sale_model->insert_data($return_sale);
            }

            //increase_expiry_number();

            redirect(console_url('return_sale'));
        } else {
            $customer_data = $this->customers_model->get_list(array('customer_ID' => $dataFull[0]['return_sale_customer']));

            $this->render(array('customer' => $customer_data, 'data' => $dataFull), 'edit_detail_tpl');
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

            $this->{$this->targetModel}->delete(array('return_perche_entry_number' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            // $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('return_sale_entry_number' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    public function sale_report()
    {
        $is_ajax = $this->input->is_ajax_request() || ($this->input->post('key') == 'ajax_resp') || $this->input->get('ajax');

        $period_start             = $this->input->get_post('start');
        $period_end               = $this->input->get_post('end');
        $customer_name            = $this->input->get_post('customer_name');
        $return_sale_medicine     = $this->input->get_post('return_sale_medicine');
        $return_sale_Batch        = $this->input->get_post('return_sale_Batch');
        $return_sale_ref          = $this->input->get_post('return_sale_ref');
        $return_sale_invoice      = $this->input->get_post('return_sale_invoice');
        $return_sale_entry_number = $this->input->get_post('return_sale_entry_number');

        // Default to past 1 month if GET without dates
        if ($period_start === NULL && $period_end === NULL && !$this->input->post()) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
            $period_end   = date('Y-m-d');
        }

        $report_data = $this->_get_sale_report_data(
            $period_start,
            $period_end,
            $customer_name,
            $return_sale_medicine,
            $return_sale_Batch,
            $return_sale_ref,
            $return_sale_invoice,
            $return_sale_entry_number
        );

        $report_data['start']                    = $period_start;
        $report_data['end']                      = $period_end;
        $report_data['customer_name']            = !empty($customer_name) ? $customer_name : '';
        $report_data['return_sale_medicine']     = !empty($return_sale_medicine) ? $return_sale_medicine : '';
        $report_data['return_sale_Batch']        = !empty($return_sale_Batch) ? $return_sale_Batch : '';
        $report_data['return_sale_ref']          = !empty($return_sale_ref) ? $return_sale_ref : '';
        $report_data['return_sale_invoice']      = !empty($return_sale_invoice) ? $return_sale_invoice : '';
        $report_data['return_sale_entry_number'] = !empty($return_sale_entry_number) ? $return_sale_entry_number : '';
        $report_data['customer']                 = $this->customers_model->get_list();

        if ($is_ajax) {
            $this->load->view('console/return_sale/sale_ajax_report_tpl', $report_data);
        } else {
            $this->render($report_data, 'sale_report_tpl');
        }
    }

    private function _get_sale_report_data($start = null, $end = null, $customer_name = null, $medicine = null, $batch = null, $ref = null, $invoice = null, $entry_number = null)
    {
        $sql = "SELECT returns_sales.*, customers.customer_name, customers.customer_contact, customers.customer_address "
             . "FROM `returns_sales` "
             . "LEFT JOIN `customers` ON returns_sales.return_sale_customer = customers.customer_ID "
             . "WHERE 1 = 1 ";

        if (!empty($start) && !empty($end)) {
            $sql .= " AND returns_sales.return_sale_date BETWEEN " . $this->db->escape($start) . " AND " . $this->db->escape($end);
        } elseif (!empty($start)) {
            $sql .= " AND returns_sales.return_sale_date >= " . $this->db->escape($start);
        } elseif (!empty($end)) {
            $sql .= " AND returns_sales.return_sale_date <= " . $this->db->escape($end);
        }

        if (!empty($customer_name)) {
            $sql .= " AND customers.customer_name LIKE " . $this->db->escape('%' . $customer_name . '%');
        }
        if (!empty($medicine)) {
            $sql .= " AND returns_sales.return_sale_medicine LIKE " . $this->db->escape('%' . $medicine . '%');
        }
        if (!empty($batch)) {
            $sql .= " AND returns_sales.return_sale_Batch LIKE " . $this->db->escape('%' . $batch . '%');
        }
        if (!empty($ref)) {
            $sql .= " AND returns_sales.return_sale_ref LIKE " . $this->db->escape('%' . $ref . '%');
        }
        if (!empty($invoice)) {
            $sql .= " AND returns_sales.return_sale_invoice LIKE " . $this->db->escape('%' . $invoice . '%');
        }
        if (!empty($entry_number)) {
            $sql .= " AND returns_sales.return_sale_entry_number LIKE " . $this->db->escape('%' . $entry_number . '%');
        }

        $sql .= " ORDER BY returns_sales.return_sale_date DESC, returns_sales.return_sale_entry_number DESC, returns_sales.return_sale_ID DESC";

        $collections = $this->db->query($sql)->result_array();

        $return_sale_data = array();
        $total_amount = 0;
        $total_quantity = 0;
        $unique_customers = array();
        $unique_invoices = array();
        $unique_entries = array();

        if (!empty($collections)) {
            foreach ($collections as $key => $var) {
                $amount = (float)(isset($var['return_sale_total']) ? $var['return_sale_total'] : 0);
                $qty = (int)(isset($var['return_sale_strip']) ? $var['return_sale_strip'] : 0);

                $total_amount += $amount;
                $total_quantity += $qty;

                if (!empty($var['customer_name'])) {
                    $unique_customers[$var['customer_name']] = true;
                }
                if (!empty($var['return_sale_invoice'])) {
                    $unique_invoices[$var['return_sale_invoice']] = true;
                }
                if (!empty($var['return_sale_entry_number'])) {
                    $unique_entries[$var['return_sale_entry_number']] = true;
                }

                $return_sale_data[$key] = array(
                    'return_sale_ID'           => isset($var['return_sale_ID']) ? $var['return_sale_ID'] : '',
                    'return_sale_invoice'      => isset($var['return_sale_invoice']) ? $var['return_sale_invoice'] : '',
                    'return_sale_entry_number' => isset($var['return_sale_entry_number']) ? $var['return_sale_entry_number'] : '',
                    'customer_ID'              => isset($var['customer_ID']) ? $var['customer_ID'] : '',
                    'customer_name'            => isset($var['customer_name']) ? $var['customer_name'] : '',
                    'customer_contact'         => isset($var['customer_contact']) ? $var['customer_contact'] : '',
                    'return_sale_medicine'     => isset($var['return_sale_medicine']) ? $var['return_sale_medicine'] : '',
                    'return_sale_Batch'        => isset($var['return_sale_Batch']) ? $var['return_sale_Batch'] : '',
                    'return_sale_expire_month' => isset($var['return_sale_expire_month']) ? $var['return_sale_expire_month'] : '',
                    'return_sale_expire_year'  => isset($var['return_sale_expire_year']) ? $var['return_sale_expire_year'] : '',
                    'return_sale_mrp'          => isset($var['return_sale_mrp']) ? $var['return_sale_mrp'] : 0,
                    'return_sale_strip'        => $qty,
                    'return_sale_date'         => isset($var['return_sale_date']) ? $var['return_sale_date'] : '',
                    'return_sale_ref'          => isset($var['return_sale_ref']) ? $var['return_sale_ref'] : '',
                    'return_sale_total'        => $amount,
                    'return_sale_HSN'          => isset($var['return_sale_HSN']) ? $var['return_sale_HSN'] : '',
                );
            }
        }

        return array(
            'return_sale_data'    => $return_sale_data,
            'total_return_amount' => $total_amount,
            'total_quantity'      => $total_quantity,
            'total_items'         => count($return_sale_data),
            'total_customers'     => count($unique_customers),
            'total_invoices'      => count($unique_invoices),
            'total_entries'       => count($unique_entries),
        );
    }

    public function sale_report_export()
    {
        $period_start             = $this->input->get('start');
        $period_end               = $this->input->get('end');
        $customer_name            = $this->input->get('customer_name');
        $return_sale_medicine     = $this->input->get('return_sale_medicine');
        $return_sale_Batch        = $this->input->get('return_sale_Batch');
        $return_sale_ref          = $this->input->get('return_sale_ref');
        $return_sale_invoice      = $this->input->get('return_sale_invoice');
        $return_sale_entry_number = $this->input->get('return_sale_entry_number');

        if (empty($period_start) && empty($period_end)) {
            $period_start = date('Y-m-d', strtotime('-1 month'));
            $period_end   = date('Y-m-d');
        }

        $rep = $this->_get_sale_report_data(
            $period_start,
            $period_end,
            $customer_name,
            $return_sale_medicine,
            $return_sale_Batch,
            $return_sale_ref,
            $return_sale_invoice,
            $return_sale_entry_number
        );

        $return_sale_data = $rep['return_sale_data'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Return Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Return Entry #');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Sale Invoice #');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Customer Contact');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'HSN');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Batch');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Exp Date (MM/YY)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Quantity (Strips)');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'MRP');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Reference');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Total (INR)');

        $rowCount = 2;
        $sl = 1;
        $total_qty = 0;
        $total_amt = 0;

        if (!empty($return_sale_data)) {
            foreach ($return_sale_data as $row) {
                $exp = (!empty($row['return_sale_expire_month']) || !empty($row['return_sale_expire_year']))
                    ? sprintf('%02d/%s', (int)$row['return_sale_expire_month'], $row['return_sale_expire_year'])
                    : '';
                $qty = (int)$row['return_sale_strip'];
                $amt = (float)$row['return_sale_total'];

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sl++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, isset($row['return_sale_date']) ? $row['return_sale_date'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, isset($row['return_sale_entry_number']) ? $row['return_sale_entry_number'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, isset($row['return_sale_invoice']) ? $row['return_sale_invoice'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, isset($row['customer_name']) ? $row['customer_name'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, isset($row['customer_contact']) ? $row['customer_contact'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, isset($row['return_sale_medicine']) ? $row['return_sale_medicine'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, isset($row['return_sale_HSN']) ? $row['return_sale_HSN'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, isset($row['return_sale_Batch']) ? $row['return_sale_Batch'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $exp);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $qty);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, isset($row['return_sale_mrp']) ? $row['return_sale_mrp'] : 0);
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, isset($row['return_sale_ref']) ? $row['return_sale_ref'] : '');
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $amt);

                $total_qty += $qty;
                $total_amt += $amt;
                $rowCount++;
            }
        }

        // Summary Total Row
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Total');
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $total_qty);
        $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $total_amt);

        $filename = "sale_return_report_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }
    public function fetch_invoice_details()
    {
        $postedData = $this->input->get();
        $invoice = $postedData['term'];

        $data = $this->sales_model->get_list(array('sale_invoice' => $invoice));

        foreach ($data as $key => $value) {
            $responce[] = array('id' => $value['sale_invoice'], 'label' => $value['sale_invoice'], 'value' => $value['sale_invoice'], 'complete' => $value, 'data' => $data);
        }
        echo json_encode($responce);
    }
}
