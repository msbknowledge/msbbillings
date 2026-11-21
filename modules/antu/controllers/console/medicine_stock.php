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
class medicine_stock extends MY_Controller
{

    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->targetModel = 'medicine_stocks_model';
        $this->moduleMeta = array('medical' => 'medicine_stock');
        $this->page_config['tablePrimaryKey'] = $this->medicine_stocks_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Medicine Stock'; //search title bar
        $this->page_config['searchFields'] = 'medicine_stock_loose,medicine_stock_batch,medicine_mrp,medicine_expire_month,medicine_expire_year,medicine_strip_stock,medicine_loose_stock,medicine_name'; //search box,
        $this->page_config['list_columns'] = $this->page_config['searchFields'];
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        //$this->page_config['use_dropdown_columns'] = 'medicine_stock_medicine';
        //$this->page_config['use_dropdown_columns_options']['medicine_stock_medicine'] = $this->medicines_model->get_list_for_dropdown('medicine_name'); //pk
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }

    public function fast_update()
    {
        $data = $this->input->post();

        if (!empty($data)) {
            $current_date = date('Y-m-d H:i:s');
            $medicine_id = $data['medicine_id'];
            $medicine['medicine_name'] = strtoupper($data['medicine_name']);
            $medicine['medicine_manufacturer'] = strtoupper($data['medicine_manufacturer']);
            $medicine['medicine_category'] = strtoupper($data['medicine_category']);
            $medicine['medicine_hsn'] = $data['medicine_hsn'];
            $medicine['medicine_unit'] = $data['medicine_unit'];
            $medicine['medicine_storage'] = strtoupper($data['medicine_storage']);

            if (empty($medicine_id)) {
                $medicine_id = $this->medicines_model->insert_data($medicine);
            } else {
                $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
            }

            $formatedData = null;
            $keyCount = 0;
            foreach ($data['medicine_stock_batch'] as $key => $value) {
                if (empty($data['medicine_strip_stock'][$key]) && empty($data['medicine_loose_stock'][$key])) {
                    continue;
                }

                // date('Y-m-d', strtotime($this->input->post('expiry_date')))
                $formatedData[$keyCount]['medicine_stock_batch'] = $data['medicine_stock_batch'][$key];
                $formatedData[$keyCount]['medicine_strip_stock'] = $data['medicine_strip_stock'][$key];
                $formatedData[$keyCount]['medicine_loose_stock'] = $data['medicine_loose_stock'][$key];
                $formatedData[$keyCount]['medicine_stock_date'] = $current_date;
                $formatedData[$keyCount]['medicine_expire_month'] = $data['medicine_expire_month'][$key];
                $formatedData[$keyCount]['medicine_expire_year'] = $data['medicine_expire_year'][$key];
                $formatedData[$keyCount]['medicine_mrp'] = $data['medicine_mrp'][$key];
                $formatedData[$keyCount]['medicine_stock_medicine'] = $medicine_id;
                $keyCount++;
            }
            //$this->db->query('delete from medicine_stocks where medicine_stock_medicine = ' . $medicine_id);

            if (!empty($formatedData[0]['medicine_stock_batch'])) {
                $this->{$this->targetModel}->insert_data($formatedData, true);
                $this->render(array('status' => 'success', 'data' => null, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
            }
        } else {
            $medicine_id = $this->uri->segment(4);
            $data = $this->medicines_model->get_list(array("medicine_id" => $medicine_id));
            $this->render($data[0], 'fast_update_tpl');
        }
    }
    public function medicine_history()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");
        $this->output->cache(0);

        $data = $this->input->post();

        if (!empty($data)) {
            $medicine_id = $data['medicine_id'];
            $medicine['medicine_name'] = strtoupper($data['medicine_name']);
            $medicine['medicine_manufacturer'] = strtoupper($data['medicine_manufacturer']);
            $medicine['medicine_category'] = strtoupper($data['medicine_category']);
            $medicine['medicine_hsn'] = $data['medicine_hsn'];
            $medicine['medicine_unit'] = $data['medicine_unit'];
            $medicine['medicine_storage'] = $data['medicine_storage'];

            $formatedData = null;
            if (!empty($data['medicine_stock_batch'])) {
                foreach ($data['medicine_stock_batch'] as $key => $value) {
                    $formatedData[$key]['medicine_stock_batch'] = $data['medicine_stock_batch'][$key];
                    $formatedData[$key]['medicine_strip_stock'] = $data['medicine_strip_stock'][$key];
                    $formatedData[$key]['medicine_loose_stock'] = $data['medicine_loose_stock'][$key];
                    $formatedData[$key]['medicine_stock_date'] = $data['medicine_stock_date'][$key];
                    $formatedData[$key]['medicine_expire_month'] = $data['medicine_expire_month'][$key];
                    $formatedData[$key]['medicine_expire_year'] = $data['medicine_expire_year'][$key];
                    $formatedData[$key]['medicine_mrp'] = $data['medicine_mrp'][$key];
                    $formatedData[$key]['medicine_stock_medicine'] = $medicine_id;
                }
                $this->db->query('delete from medicine_stocks where medicine_stock_medicine = ' . $medicine_id);
                $this->{$this->targetModel}->insert_data($formatedData, true);
            }
            $this->render(array('status' => 'success', 'data' => null, 'message' => '<strong>Well done!</strong> Data Saved.'), 'fast_update_tpl');
        } else {
            $medicine_id = $this->uri->segment(4);
            if (empty($medicine_id)) {
                $medicine_id = $this->input->get('medicine_id');
            }

            // Fetch top 6 recently transacted medicines so user has instant one-click access
            $recent_medicines = array();
            try {
                $recent_query = $this->db->query("
                    SELECT m.medicine_id, m.medicine_name, m.medicine_unit, m.medicine_manufacturer, m.medicine_category, m.medicine_hsn, m.medicine_storage 
                    FROM (SELECT sale_medicine_id FROM sales ORDER BY sale_id DESC LIMIT 40) s 
                    JOIN medicines m ON s.sale_medicine_id = m.medicine_id 
                    GROUP BY m.medicine_id 
                    LIMIT 6
                ");
                if ($recent_query && $recent_query->num_rows() > 0) {
                    $recent_medicines = $recent_query->result_array();
                }
            } catch (Exception $e) {}

            // Auto-detect the most recent transacted medicine if none explicitly requested
            if (empty($medicine_id) && !empty($recent_medicines[0]['medicine_id'])) {
                $medicine_id = $recent_medicines[0]['medicine_id'];
            }

            $med_data = null;
            if (!empty($medicine_id)) {
                $med_list = $this->medicines_model->get_list(array("medicine_id" => $medicine_id));
                if (!empty($med_list[0])) {
                    $med_data = $med_list[0];
                }
            }

            $this->render(array(
                'preloaded_medicine' => $med_data,
                'recent_medicines'   => $recent_medicines
            ), 'medicine_history_tpl');
        }
    }

    public function shortage_view()
    {
        $medicine_name = $this->input->get_post('medicine_name', true);
        $threshold     = $this->input->get_post('threshold', true);
        $storage       = $this->input->get_post('storage', true);
        $page          = $this->input->get_post('page', true);
        $per_page      = $this->input->get_post('per_page', true);

        if ($threshold === null || $threshold === '' || !is_numeric($threshold)) {
            $threshold = 2; // Default shortage threshold <= 2 strips
        } else {
            $threshold = floatval($threshold);
        }

        $report_data = $this->_get_shortage_data($medicine_name, $threshold, $storage, $page, $per_page);

        if ($this->input->is_ajax_request() || $this->input->get_post('ajax_resp') == '1') {
            $this->load->view('console/medicine_stock/shortage_table_tpl', $report_data);
            return;
        }

        $this->render($report_data, 'shortage_tpl');
    }

    public function shortage_export()
    {
        $medicine_name = $this->input->get('medicine_name', true);
        $threshold     = $this->input->get('threshold', true);
        $storage       = $this->input->get('storage', true);

        if ($threshold === null || $threshold === '' || !is_numeric($threshold)) {
            $threshold = 2;
        } else {
            $threshold = floatval($threshold);
        }

        $rep = $this->_get_shortage_data($medicine_name, $threshold, $storage, 1, 'all');
        $alldata = !empty($rep['full_data']) ? $rep['full_data'] : $rep['alldata'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Manufacturer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Category');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Unit / Pack');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Stock Strip');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Stock Loose');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Storage / Rack');

        $rowCount = 2;
        $total_strips = 0;
        $total_loose = 0;

        if (!empty($alldata)) {
            $counter = 1;
            foreach ($alldata as $item) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $item['medicine_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $item['medicine_manufacturer']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, !empty($item['medicine_category']) ? $item['medicine_category'] : '-');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, !empty($item['medicine_unit']) ? $item['medicine_unit'] : '10');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, (float)$item['left_strip']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, (float)$item['left_loose']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $item['status_label']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, !empty($item['medicine_storage']) ? $item['medicine_storage'] : '-');

                if ($item['left_strip'] > 0) $total_strips += (float)$item['left_strip'];
                if ($item['left_loose'] > 0) $total_loose  += (float)$item['left_loose'];
                $rowCount++;
            }
        }

        // Footer total
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_strips);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $total_loose);

        $filename = "medicine_shortage_report_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    private function _get_shortage_data($medicine_name = null, $threshold = 2, $storage = null, $page = 1, $per_page = 25)
    {
        if ($threshold === null || $threshold === '' || !is_numeric($threshold)) {
            $threshold = 2;
        } else {
            $threshold = floatval($threshold);
        }

        $where_clauses = array("1=1");
        if (!empty($medicine_name)) {
            $med_esc = $this->db->escape_like_str(trim($medicine_name));
            $where_clauses[] = "(m.medicine_name LIKE '%{$med_esc}%' OR m.medicine_manufacturer LIKE '%{$med_esc}%')";
        }
        if (!empty($storage)) {
            $storage_esc = $this->db->escape_like_str(trim($storage));
            $where_clauses[] = "m.medicine_storage LIKE '%{$storage_esc}%'";
        }

        $where_sql = implode(' AND ', $where_clauses);

        // Single optimized aggregated query joining medicines with purchases, sales, initial stocks, and returns
        $sql = "SELECT 
                    m.medicine_id,
                    m.medicine_name,
                    m.medicine_manufacturer,
                    m.medicine_category,
                    m.medicine_storage,
                    m.medicine_unit,
                    m.medicine_hsn,
                    COALESCE(p.total_purchased, 0) AS total_purchased,
                    COALESCE(s.total_sold, 0) AS total_sold,
                    COALESCE(s.total_sold_loose, 0) AS total_sold_loose,
                    COALESCE(b.init_strip, 0) AS init_strip,
                    COALESCE(b.init_loose, 0) AS init_loose,
                    COALESCE(rp.ret_purchased, 0) AS ret_purchased,
                    COALESCE(rs.ret_sold, 0) AS ret_sold
                FROM medicines m
                LEFT JOIN (
                    SELECT purchase_medicine_id, SUM(purchase_quantity + purchase_free_quantity) AS total_purchased 
                    FROM purchases 
                    GROUP BY purchase_medicine_id
                ) p ON p.purchase_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT sale_medicine_id, SUM(sale_strip_quantity) AS total_sold, SUM(sale_loose_quantity) AS total_sold_loose 
                    FROM sales 
                    GROUP BY sale_medicine_id
                ) s ON s.sale_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT medicine_stock_medicine, SUM(medicine_strip_stock) AS init_strip, SUM(medicine_loose_stock) AS init_loose 
                    FROM medicine_stocks 
                    GROUP BY medicine_stock_medicine
                ) b ON b.medicine_stock_medicine = m.medicine_id
                LEFT JOIN (
                    SELECT return_purchase_medicine_id, SUM(return_purchase_strip) AS ret_purchased 
                    FROM return_purchases 
                    GROUP BY return_purchase_medicine_id
                ) rp ON rp.return_purchase_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT return_sale_medicine_id, SUM(return_sale_strip) AS ret_sold 
                    FROM returns_sales 
                    GROUP BY return_sale_medicine_id
                ) rs ON rs.return_sale_medicine_id = m.medicine_id
                WHERE {$where_sql}
                ORDER BY m.medicine_name ASC";

        $rows = $this->db->query($sql)->result_array();

        $alldata = array();
        $total_shortage_items = 0;
        $total_out_of_stock = 0;
        $total_critical_low = 0;
        $total_remaining_strips = 0;
        $total_remaining_loose = 0;

        if (!empty($rows)) {
            foreach ($rows as $row) {
                $base_left_strip = floatval($row['total_purchased']) - floatval($row['total_sold']) - floatval($row['ret_purchased']) + floatval($row['ret_sold']) + floatval($row['init_strip']);
                $balanced_loose  = floatval($row['init_loose']) - floatval($row['total_sold_loose']);

                $unit = !empty($row['medicine_unit']) ? floatval($row['medicine_unit']) : 10;
                if ($unit <= 0) $unit = 10;

                $fromStrip = 0;
                $looseLeft = 0;
                if ($balanced_loose > 0) {
                    $fromStrip = ceil($balanced_loose / $unit);
                    $looseLeft = ($fromStrip * $unit) - $balanced_loose;
                } elseif ($balanced_loose < 0) {
                    $fromStrip = floor($balanced_loose / $unit);
                    $looseLeft = $balanced_loose - ($fromStrip * $unit);
                }

                $left_strip = $base_left_strip + $fromStrip;
                $left_loose = $looseLeft;

                // Check against threshold (e.g. <= 2 strips)
                if ($left_strip <= $threshold) {
                    $row['left_strip'] = $left_strip;
                    $row['left_loose'] = $left_loose;

                    if ($left_strip <= 0) {
                        $row['stock_status'] = 'out_of_stock';
                        $row['status_label'] = 'Out of Stock';
                        $total_out_of_stock++;
                    } elseif ($left_strip <= 1) {
                        $row['stock_status'] = 'critical';
                        $row['status_label'] = 'Critical (≤1)';
                        $total_critical_low++;
                    } else {
                        $row['stock_status'] = 'low';
                        $row['status_label'] = 'Low Stock';
                        $total_critical_low++;
                    }

                    $total_shortage_items++;
                    if ($left_strip > 0) {
                        $total_remaining_strips += $left_strip;
                    }
                    if ($left_loose > 0) {
                        $total_remaining_loose += $left_loose;
                    }

                    $alldata[] = $row;
                }
            }
        }

        // Sort by left_strip ascending (most critical out-of-stock items first), then medicine_name
        usort($alldata, function ($a, $b) {
            if ($a['left_strip'] == $b['left_strip']) {
                return strcasecmp($a['medicine_name'], $b['medicine_name']);
            }
            return ($a['left_strip'] < $b['left_strip']) ? -1 : 1;
        });

        $page = (!empty($page) && is_numeric($page) && $page > 0) ? intval($page) : 1;
        if ($per_page === 'all' || $per_page === '-1' || $per_page === '0') {
            $per_page_val = 0;
        } else {
            $per_page_val = (!empty($per_page) && is_numeric($per_page) && $per_page > 0) ? intval($per_page) : 25;
        }

        $total_records = count($alldata);
        $total_pages   = ($per_page_val > 0) ? (int)ceil($total_records / $per_page_val) : 1;
        if ($total_pages < 1) $total_pages = 1;
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        $offset       = ($page - 1) * $per_page_val;
        $paged_data   = ($per_page_val > 0) ? array_slice($alldata, $offset, $per_page_val) : $alldata;
        $start_record = ($total_records > 0) ? ($offset + 1) : 0;
        $end_record   = ($per_page_val > 0) ? min($offset + $per_page_val, $total_records) : $total_records;

        return array(
            'alldata'                => $paged_data,
            'full_data'              => $alldata,
            'total_records'          => $total_records,
            'page'                   => $page,
            'per_page'               => $per_page_val,
            'total_pages'            => $total_pages,
            'start_record'           => $start_record,
            'end_record'             => $end_record,
            'total_shortage_items'   => $total_shortage_items,
            'total_out_of_stock'     => $total_out_of_stock,
            'total_critical_low'     => $total_critical_low,
            'total_remaining_strips' => $total_remaining_strips,
            'total_remaining_loose'  => $total_remaining_loose,
            'medicine_name'          => $medicine_name,
            'threshold'              => $threshold,
            'storage'                => $storage,
        );
    }
    public function shortage()
    {
        $medicine_name = $this->input->post("medicine_name");
        $per_page = 100;
        if (!empty($this->input->get("page"))) {
            $page = $this->input->get("page");
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //$start = ($start_from + 1);
        $sql = "SELECT m.* FROM `medicines` m WHERE 1=1";
        if (!empty($medicine_name)) {
            $sql .= " AND m.medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " limit " . $start_from . "," . $per_page . "";
        $data = $this->db->query($sql)->result_array();

        foreach ($data as $k => $v) {
            $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
            $data[$k]['left_strip'] = $stock['left_strip'];
            $data[$k]['left_loose'] = $stock['left_loose'];
        }
        $res_data = array();
        if (count($data) > 0) {
            $res_data["status"] = "found";
            $res_data["result"] = $data;
            header('Content-Type: application/json');
            echo json_encode($res_data);
        } else {
            $res_data["status"] = "not found";
            header('Content-Type: application/json');
            echo json_encode($res_data);
        }
        //$this->render(array('result' => $data, 'total_records' => $total_records, 'total_records_per_page' => $total_records_per_page), 'shortage_tpl');
    }

    public function stock_view()
    {
        //$this->load->view('console/medicine_stock/stock_tpl');
        $this->render(null, 'stock_tpl');
    }

    public function stock()
    {
        $medicineNname = $this->input->post("medicine_name");
        $medicine_name = isset($medicineNname) ? $medicineNname : '';
        $per_page = 50;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        $sql = "SELECT m.* FROM `medicines` m  WHERE 1=1";
        if (!empty($medicine_name)) {
            $sql .= " AND m.medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " limit " . $start_from . "," . $per_page . "";
        $data = $this->db->query($sql)->result_array();

        foreach ($data as $k => $v) {
            $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
            $data[$k]['left_strip'] = $stock['left_strip'];
            $data[$k]['left_loose'] = $stock['left_loose'];
        }
        if (count($data) > 0) {
            echo json_encode(array("status" => "found", "result" => $data));
        } else {
            echo json_encode(array("status" => "not found"));
        }
    }

    public function current_stock()
    {
        $sql = "SELECT m.medicine_id,p.purchase_mrp
        FROM medicines m 
        JOIN purchases p ON m.medicine_id = p.purchase_medicine_id 
        group by m.medicine_id, p.purchase_medicine_id";
        $medicine_data = $this->db->query($sql)->result_array();
        $total_amount = 0;
        foreach ($medicine_data as $k => $v) {
            $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
            $left_strip = $stock['left_strip'];
            if ($left_strip == 0) {
                continue;
            }
            $total_amount += $v['purchase_mrp'] * $left_strip;

            // $result = $this->db->query("SELECT SUM(purchase_mrp *  $left_strip) as totalamount FROM purchases WHERE purchase_medicine_id = '" . $v['medicine_id'] . "'")->result_array();
            // $total_amount += $result[0]['totalamount'];
        }
        echo json_encode(array("status" => "success", "result" => $total_amount));
        // $this->load->view('console/medicine_stock/current_stock amount_tpl', array('total_amount' => $total_amount));
    }

    public function stock_amount()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");
        $this->output->cache(0);

        $medicine_name         = $this->input->get_post('medicine_name', true);
        $medicine_manufacturer = $this->input->get_post('medicine_manufacturer', true);
        $storage               = $this->input->get_post('storage', true);
        $stock_filter          = $this->input->get_post('stock_filter', true);
        if (empty($stock_filter)) {
            $stock_filter = 'in_stock';
        }
        $page                  = $this->input->get_post('page', true);
        $per_page              = $this->input->get_post('per_page', true);

        $report_data = $this->_get_stock_amount_data($medicine_name, $medicine_manufacturer, $storage, $stock_filter, $page, $per_page);

        if ($this->input->is_ajax_request() || $this->input->get_post('ajax_resp') == '1') {
            $this->load->view('console/medicine_stock/stock_ajax_amount_tpl', $report_data);
            return;
        }

        $this->render($report_data, 'stock_amount_tpl');
    }

    public function stock_amount_export()
    {
        $medicine_name         = $this->input->get('medicine_name', true);
        $medicine_manufacturer = $this->input->get('medicine_manufacturer', true);
        $storage               = $this->input->get('storage', true);
        $stock_filter          = $this->input->get('stock_filter', true);
        if (empty($stock_filter)) {
            $stock_filter = 'in_stock';
        }

        $rep = $this->_get_stock_amount_data($medicine_name, $medicine_manufacturer, $storage, $stock_filter, 1, 'all');
        $alldata = !empty($rep['full_data']) ? $rep['full_data'] : $rep['alldata'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Manufacturer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Category');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Storage / Rack');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Unit / Pack');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Stock Strips');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Stock Loose');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Latest MRP (Rs)');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Purchase Rate (Rs)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Valuation MRP (Rs)');

        $rowCount = 2;
        $total_strips = 0;
        $total_loose  = 0;
        $total_val    = 0;

        if (!empty($alldata)) {
            $counter = 1;
            foreach ($alldata as $item) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $item['medicine_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $item['medicine_manufacturer']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, !empty($item['medicine_category']) ? $item['medicine_category'] : '-');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, !empty($item['medicine_storage']) ? $item['medicine_storage'] : '-');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, !empty($item['medicine_unit']) ? $item['medicine_unit'] : '10');
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, (float)$item['left_strip']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, (float)$item['left_loose']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, (float)$item['mrp']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, (float)$item['purchase_rate']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, (float)$item['valuation_amount']);

                if ($item['left_strip'] > 0) $total_strips += (float)$item['left_strip'];
                if ($item['left_loose'] > 0) $total_loose  += (float)$item['left_loose'];
                $total_val += (float)$item['valuation_amount'];
                $rowCount++;
            }
        }

        // Footer total
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $total_strips);
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_loose);
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $total_val);

        $filename = "medicine_stock_valuation_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    private function _get_stock_amount_data($medicine_name = null, $medicine_manufacturer = null, $storage = null, $stock_filter = 'in_stock', $page = 1, $per_page = 25)
    {
        $where_clauses = array("1=1");
        if (!empty($medicine_name)) {
            $med_esc = $this->db->escape_like_str(trim($medicine_name));
            if (!empty($medicine_manufacturer)) {
                $where_clauses[] = "m.medicine_name LIKE '%{$med_esc}%'";
            } else {
                $where_clauses[] = "(m.medicine_name LIKE '%{$med_esc}%' OR m.medicine_manufacturer LIKE '%{$med_esc}%')";
            }
        }
        if (!empty($medicine_manufacturer)) {
            $mfg_esc = $this->db->escape_like_str(trim($medicine_manufacturer));
            $where_clauses[] = "m.medicine_manufacturer LIKE '%{$mfg_esc}%'";
        }
        if (!empty($storage)) {
            $storage_esc = $this->db->escape_like_str(trim($storage));
            $where_clauses[] = "m.medicine_storage LIKE '%{$storage_esc}%'";
        }

        $where_sql = implode(' AND ', $where_clauses);

        // Single optimized aggregated query joining medicines with purchases, sales, initial stocks, returns, and latest purchase MRP/Rate
        $sql = "SELECT 
                    m.medicine_id,
                    m.medicine_name,
                    m.medicine_manufacturer,
                    m.medicine_category,
                    m.medicine_storage,
                    m.medicine_unit,
                    m.medicine_hsn,
                    COALESCE(p.total_purchased, 0) AS total_purchased,
                    COALESCE(s.total_sold, 0) AS total_sold,
                    COALESCE(s.total_sold_loose, 0) AS total_sold_loose,
                    COALESCE(b.init_strip, 0) AS init_strip,
                    COALESCE(b.init_loose, 0) AS init_loose,
                    COALESCE(b.init_mrp, 0) AS init_mrp,
                    COALESCE(rp.ret_purchased, 0) AS ret_purchased,
                    COALESCE(rs.ret_sold, 0) AS ret_sold,
                    latest_p.purchase_mrp AS latest_mrp,
                    latest_p.purchase_rate AS latest_purchase_rate,
                    latest_p.purchase_batch AS latest_purchase_batch,
                    latest_p.purchase_date AS latest_purchase_date
                FROM medicines m
                LEFT JOIN (
                    SELECT purchase_medicine_id, SUM(purchase_quantity + purchase_free_quantity) AS total_purchased 
                    FROM purchases 
                    GROUP BY purchase_medicine_id
                ) p ON p.purchase_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT sale_medicine_id, SUM(sale_strip_quantity) AS total_sold, SUM(sale_loose_quantity) AS total_sold_loose 
                    FROM sales 
                    GROUP BY sale_medicine_id
                ) s ON s.sale_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT medicine_stock_medicine, SUM(medicine_strip_stock) AS init_strip, SUM(medicine_loose_stock) AS init_loose, MAX(medicine_mrp) AS init_mrp 
                    FROM medicine_stocks 
                    GROUP BY medicine_stock_medicine
                ) b ON b.medicine_stock_medicine = m.medicine_id
                LEFT JOIN (
                    SELECT return_purchase_medicine_id, SUM(return_purchase_strip) AS ret_purchased 
                    FROM return_purchases 
                    GROUP BY return_purchase_medicine_id
                ) rp ON rp.return_purchase_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT return_sale_medicine_id, SUM(return_sale_strip) AS ret_sold 
                    FROM returns_sales 
                    GROUP BY return_sale_medicine_id
                ) rs ON rs.return_sale_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT p1.purchase_medicine_id, p1.purchase_mrp, p1.purchase_rate, p1.purchase_batch, p1.purchase_date
                    FROM purchases p1
                    INNER JOIN (
                        SELECT purchase_medicine_id, MAX(purchase_ID) AS max_pid
                        FROM purchases
                        GROUP BY purchase_medicine_id
                    ) p2 ON p1.purchase_ID = p2.max_pid
                ) latest_p ON latest_p.purchase_medicine_id = m.medicine_id
                WHERE {$where_sql}
                ORDER BY m.medicine_name ASC";

        $rows = $this->db->query($sql)->result_array();

        $alldata = array();
        $total_mrp_valuation = 0;
        $total_cost_valuation = 0;
        $total_in_stock_items = 0;
        $total_strips = 0;
        $total_loose = 0;

        if (!empty($rows)) {
            foreach ($rows as $row) {
                $base_left_strip = floatval($row['total_purchased']) - floatval($row['total_sold']) - floatval($row['ret_purchased']) + floatval($row['ret_sold']) + floatval($row['init_strip']);
                $diff_loose      = floatval($row['init_loose']) - floatval($row['total_sold_loose']);

                $unit = !empty($row['medicine_unit']) ? floatval($row['medicine_unit']) : 10;
                if ($unit <= 0) $unit = 10;

                $fromStrip = 0;
                $looseLeft = 0;
                if ($unit > 0) {
                    if ($diff_loose < 0) {
                        $strips_needed = (int)ceil(abs($diff_loose) / $unit);
                        $fromStrip = -$strips_needed;
                        $looseLeft = ($strips_needed * $unit) + $diff_loose;
                    } else {
                        $extra_strips = (int)floor($diff_loose / $unit);
                        $fromStrip = $extra_strips;
                        $looseLeft = fmod($diff_loose, $unit);
                    }
                } else {
                    $looseLeft = $diff_loose;
                }

                $left_strip = $base_left_strip + $fromStrip;
                $left_loose = $looseLeft;

                $mrp = floatval(!empty($row['latest_mrp']) && $row['latest_mrp'] > 0 ? $row['latest_mrp'] : (!empty($row['init_mrp']) ? $row['init_mrp'] : 0));
                $purchase_rate = floatval(!empty($row['latest_purchase_rate']) ? $row['latest_purchase_rate'] : 0);

                $row['left_strip'] = $left_strip;
                $row['left_loose'] = $left_loose;
                $row['mrp'] = $mrp;
                $row['purchase_rate'] = $purchase_rate;
                $row['medicine_unit'] = $unit;

                $is_in_stock = ($left_strip > 0 || $left_loose > 0);
                $row['is_in_stock'] = $is_in_stock;

                if ($is_in_stock) {
                    $val_strips = max(0, $left_strip);
                    $val_loose = max(0, $left_loose);
                    $val_mrp = ($val_strips * $mrp) + (($val_loose / $unit) * $mrp);
                    $val_cost = ($purchase_rate > 0) ? (($val_strips * $purchase_rate) + (($val_loose / $unit) * $purchase_rate)) : 0;
                } else {
                    $val_mrp = 0;
                    $val_cost = 0;
                }

                $row['valuation_amount'] = round($val_mrp, 2);
                $row['cost_valuation_amount'] = round($val_cost, 2);

                // Apply stock filter
                if ($stock_filter === 'in_stock') {
                    if (!$is_in_stock) {
                        continue;
                    }
                } elseif ($stock_filter === 'out_of_stock') {
                    if ($is_in_stock) {
                        continue;
                    }
                }

                $total_mrp_valuation += $row['valuation_amount'];
                $total_cost_valuation += $row['cost_valuation_amount'];

                if ($is_in_stock) {
                    $total_in_stock_items++;
                    if ($left_strip > 0) {
                        $total_strips += $left_strip;
                    }
                    if ($left_loose > 0) {
                        $total_loose += $left_loose;
                    }
                }

                $alldata[] = $row;
            }
        }

        // Sort by valuation_amount descending, then medicine_name ascending
        usort($alldata, function ($a, $b) {
            if ($a['valuation_amount'] == $b['valuation_amount']) {
                return strcasecmp($a['medicine_name'], $b['medicine_name']);
            }
            return ($a['valuation_amount'] > $b['valuation_amount']) ? -1 : 1;
        });

        $page = (!empty($page) && is_numeric($page) && $page > 0) ? intval($page) : 1;
        if ($per_page === 'all' || $per_page === '-1' || $per_page === '0') {
            $per_page_val = 0;
        } else {
            $per_page_val = (!empty($per_page) && is_numeric($per_page) && $per_page > 0) ? intval($per_page) : 25;
        }

        $total_records = count($alldata);
        $total_pages   = ($per_page_val > 0) ? (int)ceil($total_records / $per_page_val) : 1;
        if ($total_pages < 1) $total_pages = 1;
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        $offset       = ($page - 1) * $per_page_val;
        $paged_data   = ($per_page_val > 0) ? array_slice($alldata, $offset, $per_page_val) : $alldata;
        $start_record = ($total_records > 0) ? ($offset + 1) : 0;
        $end_record   = ($per_page_val > 0) ? min($offset + $per_page_val, $total_records) : $total_records;

        return array(
            'alldata'               => $paged_data,
            'full_data'             => $alldata,
            'total_records'         => $total_records,
            'total_pages'           => $total_pages,
            'page'                  => $page,
            'per_page'              => $per_page_val,
            'start_record'          => $start_record,
            'end_record'            => $end_record,
            'total_mrp_valuation'   => $total_mrp_valuation,
            'total_cost_valuation'  => $total_cost_valuation,
            'total_in_stock_items'  => $total_in_stock_items,
            'total_strips'          => $total_strips,
            'total_loose'           => $total_loose,
            'medicine_name'         => $medicine_name,
            'medicine_manufacturer' => $medicine_manufacturer,
            'storage'               => $storage,
            'stock_filter'          => $stock_filter
        );
    }

    public function stock_sales_statement()
    {
        if ($this->input->post()) {
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $purchase_sql = "SELECT purchase_quantity, medicine_name from `purchases` 
            JOIN medicines ON purchases.purchase_medicine_id = medicines.medicine_id 
            WHERE purchase_date >= '" . $start . "' AND purchase_date <= '" . $end . "'";
            $purchase_data =  $this->db->query($purchase_sql)->result_array();
            $this->load->view('console/medicine_stock/stock_sales_ajax_statement_tpl', array());
        } else {
            $this->load->view('console/medicine_stock/stock_sales_statement_tpl', array());
        }
    }

    public function stock_by_batch()
    {
        $medicine_id = $this->input->get("medicine_id");
        $medicine_batch = $this->input->get("term");
        $isdebug = !empty($this->input->get("debug"));
        if (empty($medicine_id)) {
            header('Content-Type: application/json');
            echo json_encode(array());
            return;
        }
        $medicine =  $this->db->query("select distinct purchase_batch as batch,purchase_expire_month as expire_month,purchase_expire_year as expire_year,purchase_cgst_percent as cgst_percent,purchase_mrp as mrp,medicine_category,medicine_schedule from medicines join `purchases` on medicines.medicine_id=purchases.purchase_medicine_id where purchases.purchase_medicine_id=" . $medicine_id)->result_array();

        $purchased_batch =  $this->db->query("select distinct purchase_batch as batch,purchase_expire_month as expire_month,purchase_expire_year as expire_year,purchase_cgst_percent as cgst_percent,purchase_mrp as mrp from purchases where purchase_medicine_id=" . $medicine_id)->result_array();

        $purcased_return =  $this->db->query("select distinct return_purchase_batch as batch,return_purchase_expire_month as expire_month,return_purchase_expire_year as expire_year,return_purchase_mrp as mrp from  return_purchases where return_purchase_medicine_id=" . $medicine_id)->result_array();

        $sold_return =  $this->db->query("select distinct return_sale_batch as batch,return_sale_expire_month as expire_month,return_sale_expire_year as expire_year,return_sale_mrp as mrp from  returns_sales where return_sale_medicine_id=" . $medicine_id)->result_array();

        $stock =  $this->db->query("select distinct medicine_stock_batch as batch,medicine_expire_month as expire_month,medicine_expire_year as expire_year,medicine_mrp as mrp from  medicine_stocks where medicine_stock_medicine=" . $medicine_id)->result_array();

        $sale_batch =  $this->db->query("select distinct sale_batch as batch,sale_expire_month as expire_month,sale_expire_year as expire_year,sale_cgst_percent as cgst_percent,sale_mrp as mrp from sales where sale_medicine_id=" . $medicine_id)->result_array();

        $merged = array_merge($sale_batch, $purcased_return, $sold_return, $stock, $medicine);

        $unique = array();
        foreach ($merged as $mr) {
            if (!empty($mr['batch'])) {
                $unique[$mr['batch']] = $mr;
            }
        }
        $batches = null;

        $responce = array();
        foreach ($unique as $k => $v) {
            if (!(empty($medicine_batch)) && $v['batch'] != $medicine_batch) {
                continue;
            }
            $stock = $this->{$this->targetModel}->stock_of_medicine($medicine_id, $v['batch']);

            // ✅ Compute New MRP and Rate
            $oldMrp = floatval($v['mrp']);
            $oldGst = floatval($v['cgst_percent']) * 2;
            $newMrp = $oldMrp;

            if ($oldGst == 12) {
                $newMrp = round($oldMrp * 0.9375, 2);
            } elseif ($oldGst == 18) {
                $newMrp = round($oldMrp * 0.8898, 2);
            }

            // ✅ Calculate Rate (MRP × 0.7619)
            $rate = round($newMrp * 0.7619, 2);

            $data[$v['batch']]['medicine_id'] = $medicine_id;
            $data[$v['batch']]['stock'] = $stock['stock'];
            $data[$v['batch']]['return_stock'] = $stock['return_stock'];
            $data[$v['batch']]['sold_stock'] = $stock['sold_stock'];
            $data[$v['batch']]['sold_return_stock'] = $stock['sold_return_stock'];
            $data[$v['batch']]['left_strip'] = $stock['left_strip'];
            $data[$v['batch']]['left_loose'] = $stock['left_loose'];
            $data[$v['batch']]['balance_stock'] = $stock['balance_stock'];
            $data[$v['batch']]['medicine_category'] = $v['medicine_category'];
            $data[$v['batch']]['medicine_schedule'] = $v['medicine_schedule'];
            $data[$v['batch']]['medicine_mrp'] = $v['mrp'];
            $data[$v['batch']]['medicine_mrp'] = $v['mrp'];
            $data[$v['batch']]['sale_mrp'] = $v['mrp'];
            $data[$v['batch']]['sale_new_mrp'] = $newMrp;
            $data[$v['batch']]['sale_rate'] = $rate;
            $data[$v['batch']]['sale_expire_month'] = $v['expire_month'];
            $data[$v['batch']]['sale_expire_year'] = $v['expire_year'];
            $data[$v['batch']]['sale_cgst_percent'] = 2.5; //$v['cgst_percent'];

            if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                if (!$isdebug)
                    continue;
            }
            $responce[] = array('id' => '', 'label' => $v['batch'] . ' [S:' . $stock['left_strip'] . '|L:' . $stock['left_loose'] . '](' . $v['expire_month'] . '/' . $v['expire_year'] . ') |' . $v['mrp'], 'value' => $v['batch'], 'complete' => $data[$v['batch']]);
        }
        //  pr( $responce,1);
        header('Content-Type: application/json');
        echo json_encode($responce);
    }

    public function stock_by_batch_old()
    {
        $medicine_id = $this->input->get("medicine_id");
        $medicine_batch = $this->input->get("term");
        $isdebug = !empty($this->input->get("debug"));

        $purchased_batch =  $this->db->query("select distinct purchase_batch,purchase_expire_month,purchase_expire_year,purchase_cgst_percent,purchase_mrp from purchases where purchase_medicine_id=" . $medicine_id)->result_array();
        $responce = null;
        foreach ($purchased_batch as $k => $v) {
            if (!(empty($medicine_batch)) && $v['purchase_batch'] != $medicine_batch) {
                continue;
            }
            $stock = $this->{$this->targetModel}->stock_of_medicine($medicine_id, $v['purchase_batch']);
            $data[$v['purchase_batch']]['medicine_id'] = $medicine_id;
            $data[$v['purchase_batch']]['purchase_stock'] = $stock['purchase_stock'];
            $data[$v['purchase_batch']]['purchase_return_stock'] = $stock['purchase_return_stock'];
            $data[$v['purchase_batch']]['sold_stock'] = $stock['sold_stock'];
            $data[$v['purchase_batch']]['sold_return_stock'] = $stock['sold_return_stock'];
            $data[$v['purchase_batch']]['left_strip'] = $stock['left_strip'];
            $data[$v['purchase_batch']]['left_loose'] = $stock['left_loose'];
            $data[$v['purchase_batch']]['balance_stock'] = $stock['balance_stock'];

            $data[$v['purchase_batch']]['medicine_mrp'] = $v['purchase_mrp'];
            $data[$v['purchase_batch']]['medicine_mrp'] = $v['purchase_mrp'];
            $data[$v['purchase_batch']]['sale_mrp'] = $v['purchase_mrp'];
            $data[$v['purchase_batch']]['sale_expire_month'] = $v['purchase_expire_month'];
            $data[$v['purchase_batch']]['sale_expire_year'] = $v['purchase_expire_year'];
            $data[$v['purchase_batch']]['sale_cgst_percent'] = $v['purchase_cgst_percent'];

            if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                if (!$isdebug)
                    continue;
            }
            $responce[] = array('id' => '', 'label' => $v['purchase_batch'] . ' [S:' . $stock['left_strip'] . '|L:' . $stock['left_loose'] . '](' . $v['purchase_expire_month'] . '/' . $v['purchase_expire_year'] . ') |' . $v['purchase_mrp'], 'value' => $v['purchase_batch'], 'complete' => $data[$v['purchase_batch']]);
        }
        header('Content-Type: application/json');
        echo json_encode($responce);
    }

    public function get_info()
    {
        $medicine = $this->medicines_model->get_list(array("medicine_name" => $this->input->post('medicine')));
        $stock =  $this->{$this->targetModel}->stock_of_medicine($medicine[0]['medicine_id']);
        $this->load->view('console/medicine_stock/get_info_tpl', array('stock' => $stock, 'medicine' => $medicine[0]));
    }

    public function get_infox()
    {
        $medicine = $this->medicines_model->get_list(array("medicine_name" => $this->input->post('medicine')));
        $purchased_batch =  $this->db->query("select distinct purchase_batch from purchases where purchase_medicine_id=" . $medicine[0]['medicine_id'])->result_array();
        $responce = null;
        foreach ($purchased_batch as $k => $v) {
            $stock =  $this->{$this->targetModel}->stock_of_medicine($medicine[0]['medicine_id'], $v['purchase_batch']);
            if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {

                continue;
            }
            $data[$v['purchase_batch']] = $stock;
        }

        $this->load->view('console/medicine_stock/get_info_tpl', array('stock' => $data, 'medicine' => $medicine[0]));
    }
    public function expiring_view()
    {
        $medicine_name = $this->input->get_post('medicine_name', true);
        $months        = $this->input->get_post('months', true);
        $batch         = $this->input->get_post('batch', true);
        $storage       = $this->input->get_post('storage', true);
        $page          = $this->input->get_post('page', true);
        $per_page      = $this->input->get_post('per_page', true);

        if (empty($months) || !is_numeric($months)) {
            $months = 4;
        }

        $report_data = $this->_get_expiring_data($medicine_name, $months, $batch, $storage, $page, $per_page);

        if ($this->input->is_ajax_request() || $this->input->get_post('ajax_resp') == '1') {
            $this->load->view('console/medicine_stock/expiring_table_tpl', $report_data);
            return;
        }

        $this->render($report_data, 'upcomming_expire_tpl');
    }

    public function expiring_export()
    {
        $medicine_name = $this->input->get('medicine_name', true);
        $months        = $this->input->get('months', true);
        $batch         = $this->input->get('batch', true);
        $storage       = $this->input->get('storage', true);

        if (empty($months) || !is_numeric($months)) {
            $months = 4;
        }

        $rep = $this->_get_expiring_data($medicine_name, $months, $batch, $storage, 1, 'all');
        $alldata = !empty($rep['full_data']) ? $rep['full_data'] : $rep['alldata'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Manufacturer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Batch');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Purchase Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Expiry (Month/Year)');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Status / Time Left');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Stock Strip');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Stock Loose');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'MRP (Rs)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Value at Risk (Rs)');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Storage / Rack');

        $rowCount = 2;
        $total_strips = 0;
        $total_loose  = 0;
        $total_val    = 0;

        if (!empty($alldata)) {
            $counter = 1;
            foreach ($alldata as $item) {
                $status_text = ($item['months_left'] <= 0) ? 'Expiring this month' : 'In ' . $item['months_left'] . ' month(s)';
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $item['medicine_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $item['medicine_manufacturer']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $item['purchase_batch']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, !empty($item['purchase_date']) ? date('d-m-Y', strtotime($item['purchase_date'])) : '-');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $item['formatted_expiry']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status_text);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, (float)$item['left_strip']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, (float)$item['left_loose']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, (float)$item['purchase_mrp']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, (float)$item['at_risk_value']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, !empty($item['medicine_storage']) ? $item['medicine_storage'] : '-');

                $total_strips += (float)$item['left_strip'];
                $total_loose  += (float)$item['left_loose'];
                $total_val    += (float)$item['at_risk_value'];
                $rowCount++;
            }
        }

        // Footer total
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_strips);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $total_loose);
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $total_val);

        $filename = "upcoming_expiring_medicines_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    private function _get_expiring_data($medicine_name = null, $months = 4, $batch = null, $storage = null, $page = 1, $per_page = 25)
    {
        $months = (!empty($months) && is_numeric($months) && $months > 0) ? intval($months) : 4;

        $start_ym = date('Ym'); // Current month YYYYMM, e.g. 202611
        $end_ym   = date('Ym', strtotime("+$months months"));

        $where_clauses = array();
        $where_clauses[] = "p.purchase_expire_year IS NOT NULL";
        $where_clauses[] = "p.purchase_expire_year != ''";
        $where_clauses[] = "p.purchase_expire_year != '0'";
        $where_clauses[] = "p.purchase_expire_month IS NOT NULL";
        $where_clauses[] = "p.purchase_expire_month > 0";

        if (!empty($medicine_name)) {
            $med_esc = $this->db->escape_like_str(trim($medicine_name));
            $where_clauses[] = "(m.medicine_name LIKE '%{$med_esc}%' OR m.medicine_manufacturer LIKE '%{$med_esc}%')";
        }

        if (!empty($batch)) {
            $batch_esc = $this->db->escape_like_str(trim($batch));
            $where_clauses[] = "p.purchase_batch LIKE '%{$batch_esc}%'";
        }

        if (!empty($storage)) {
            $storage_esc = $this->db->escape_like_str(trim($storage));
            $where_clauses[] = "m.medicine_storage LIKE '%{$storage_esc}%'";
        }

        $where_sql = implode(' AND ', $where_clauses);

        // High-performance single aggregated query: finds only expiring batches that currently hold active stock
        $sql = "SELECT 
                    p_exp.purchase_medicine_id,
                    p_exp.purchase_batch,
                    p_exp.purchase_expire_month,
                    p_exp.purchase_expire_year,
                    p_exp.purchase_date,
                    p_exp.purchase_mrp,
                    p_exp.up_expdate,
                    m.medicine_id,
                    m.medicine_name,
                    m.medicine_manufacturer,
                    m.medicine_category,
                    m.medicine_storage,
                    m.medicine_unit,
                    COALESCE(p_tot.total_purchased, 0) AS total_purchased,
                    COALESCE(s_tot.total_sold, 0) AS total_sold,
                    COALESCE(s_tot.total_sold_loose, 0) AS total_sold_loose,
                    COALESCE(b_tot.init_strip, 0) AS init_strip,
                    COALESCE(b_tot.init_loose, 0) AS init_loose,
                    COALESCE(rp_tot.ret_purchased, 0) AS ret_purchased,
                    COALESCE(rs_tot.ret_sold, 0) AS ret_sold
                FROM (
                    SELECT 
                        p.purchase_medicine_id,
                        p.purchase_batch,
                        p.purchase_expire_month,
                        p.purchase_expire_year,
                        MAX(p.purchase_date) AS purchase_date,
                        MAX(p.purchase_mrp) AS purchase_mrp,
                        CONCAT(
                            CASE 
                                WHEN LENGTH(TRIM(p.purchase_expire_year)) = 2 THEN CONCAT('20', LPAD(TRIM(p.purchase_expire_year), 2, '0'))
                                WHEN LENGTH(TRIM(p.purchase_expire_year)) = 4 THEN TRIM(p.purchase_expire_year)
                                ELSE LPAD(TRIM(p.purchase_expire_year), 4, '0')
                            END,
                            LPAD(TRIM(p.purchase_expire_month), 2, '0')
                        ) AS up_expdate
                    FROM purchases p
                    JOIN medicines m ON p.purchase_medicine_id = m.medicine_id
                    WHERE {$where_sql}
                    GROUP BY p.purchase_medicine_id, p.purchase_batch, p.purchase_expire_year, p.purchase_expire_month
                    HAVING up_expdate >= '{$start_ym}' AND up_expdate <= '{$end_ym}'
                ) p_exp
                JOIN medicines m ON p_exp.purchase_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT purchase_medicine_id, purchase_batch, SUM(purchase_quantity + purchase_free_quantity) AS total_purchased
                    FROM purchases
                    GROUP BY purchase_medicine_id, purchase_batch
                ) p_tot ON p_tot.purchase_medicine_id = p_exp.purchase_medicine_id AND p_tot.purchase_batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT sale_medicine_id, sale_batch, SUM(sale_strip_quantity) AS total_sold, SUM(sale_loose_quantity) AS total_sold_loose
                    FROM sales
                    GROUP BY sale_medicine_id, sale_batch
                ) s_tot ON s_tot.sale_medicine_id = p_exp.purchase_medicine_id AND s_tot.sale_batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT medicine_stock_medicine, medicine_stock_batch, SUM(medicine_strip_stock) AS init_strip, SUM(medicine_loose_stock) AS init_loose
                    FROM medicine_stocks
                    GROUP BY medicine_stock_medicine, medicine_stock_batch
                ) b_tot ON b_tot.medicine_stock_medicine = p_exp.purchase_medicine_id AND b_tot.medicine_stock_batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT return_purchase_medicine_id, return_purchase_Batch, SUM(return_purchase_strip) AS ret_purchased
                    FROM return_purchases
                    GROUP BY return_purchase_medicine_id, return_purchase_Batch
                ) rp_tot ON rp_tot.return_purchase_medicine_id = p_exp.purchase_medicine_id AND rp_tot.return_purchase_Batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT return_sale_medicine_id, return_sale_Batch, SUM(return_sale_strip) AS ret_sold
                    FROM returns_sales
                    GROUP BY return_sale_medicine_id, return_sale_Batch
                ) rs_tot ON rs_tot.return_sale_medicine_id = p_exp.purchase_medicine_id AND rs_tot.return_sale_Batch = p_exp.purchase_batch
                WHERE (
                    (COALESCE(p_tot.total_purchased, 0) - COALESCE(s_tot.total_sold, 0) - COALESCE(rp_tot.ret_purchased, 0) + COALESCE(rs_tot.ret_sold, 0) + COALESCE(b_tot.init_strip, 0)) > 0
                    OR
                    (COALESCE(b_tot.init_loose, 0) - COALESCE(s_tot.total_sold_loose, 0)) > 0
                )
                ORDER BY p_exp.up_expdate ASC, m.medicine_name ASC";

        $rows = $this->db->query($sql)->result_array();

        $alldata = array();
        $total_batches = 0;
        $total_strips = 0;
        $total_loose = 0;
        $total_at_risk_value = 0;
        $distinct_med_map = array();

        $current_year_int  = intval(date('Y'));
        $current_month_int = intval(date('n'));

        $month_names = array(
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        );

        if (!empty($rows)) {
            foreach ($rows as $row) {
                $base_left_strip = floatval($row['total_purchased']) - floatval($row['total_sold']) - floatval($row['ret_purchased']) + floatval($row['ret_sold']) + floatval($row['init_strip']);
                $balanced_loose  = floatval($row['init_loose']) - floatval($row['total_sold_loose']);

                $unit = !empty($row['medicine_unit']) ? floatval($row['medicine_unit']) : 10;
                if ($unit <= 0) $unit = 10;

                $fromStrip = 0;
                $looseLeft = 0;
                if ($balanced_loose > 0) {
                    $fromStrip = ceil($balanced_loose / $unit);
                    $looseLeft = ($fromStrip * $unit) - $balanced_loose;
                } elseif ($balanced_loose < 0) {
                    $fromStrip = floor($balanced_loose / $unit);
                    $looseLeft = $balanced_loose - ($fromStrip * $unit);
                }

                $left_strip = $base_left_strip + $fromStrip;
                $left_loose = $looseLeft;

                // Filter out non-stocked or zero/negative items
                if ($left_strip <= 0 && $left_loose <= 0) {
                    continue;
                }

                $exp_year_raw  = trim($row['purchase_expire_year']);
                $exp_year_full = (strlen($exp_year_raw) == 2) ? intval('20' . $exp_year_raw) : intval($exp_year_raw);
                $exp_month_int = intval($row['purchase_expire_month']);

                $months_left = (($exp_year_full - $current_year_int) * 12) + ($exp_month_int - $current_month_int);

                $month_label = isset($month_names[$exp_month_int]) ? $month_names[$exp_month_int] : str_pad($exp_month_int, 2, '0', STR_PAD_LEFT);
                $formatted_expiry = $month_label . ' ' . $exp_year_full;

                $mrp = floatval(!empty($row['purchase_mrp']) ? $row['purchase_mrp'] : 0);
                $at_risk_value = max(0, ($left_strip * $mrp) + (($left_loose / $unit) * $mrp));

                $row['left_strip']        = $left_strip;
                $row['left_loose']        = $left_loose;
                $row['purchase_mrp']      = $mrp;
                $row['at_risk_value']     = round($at_risk_value, 2);
                $row['exp_year_full']     = $exp_year_full;
                $row['exp_month_int']     = $exp_month_int;
                $row['formatted_expiry']  = $formatted_expiry;
                $row['months_left']       = $months_left;

                $alldata[] = $row;
                $total_batches++;
                $total_strips += $left_strip;
                $total_loose  += $left_loose;
                $total_at_risk_value += $row['at_risk_value'];
                $distinct_med_map[$row['medicine_id']] = true;
            }
        }

        $page = (!empty($page) && is_numeric($page) && $page > 0) ? intval($page) : 1;
        if ($per_page === 'all' || $per_page === '-1' || $per_page === '0') {
            $per_page_val = 0;
        } else {
            $per_page_val = (!empty($per_page) && is_numeric($per_page) && $per_page > 0) ? intval($per_page) : 25;
        }

        $total_records = count($alldata);
        $total_pages   = ($per_page_val > 0) ? (int)ceil($total_records / $per_page_val) : 1;
        if ($total_pages < 1) $total_pages = 1;
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        $offset       = ($page - 1) * $per_page_val;
        $paged_data   = ($per_page_val > 0) ? array_slice($alldata, $offset, $per_page_val) : $alldata;
        $start_record = ($total_records > 0) ? ($offset + 1) : 0;
        $end_record   = ($per_page_val > 0) ? min($offset + $per_page_val, $total_records) : $total_records;

        return array(
            'alldata'                  => $paged_data,
            'full_data'                => $alldata,
            'total_records'            => $total_records,
            'page'                     => $page,
            'per_page'                 => $per_page_val,
            'total_pages'              => $total_pages,
            'start_record'             => $start_record,
            'end_record'               => $end_record,
            'total_batches'            => $total_batches,
            'total_strips'             => $total_strips,
            'total_loose'              => $total_loose,
            'total_at_risk_value'      => $total_at_risk_value,
            'total_distinct_medicines' => count($distinct_med_map),
            'medicine_name'            => $medicine_name,
            'months'                   => $months,
            'batch'                    => $batch,
            'storage'                  => $storage,
            'start_ym'                 => $start_ym,
            'end_ym'                   => $end_ym,
        );
    }

    public function expiring()
    {
        $medicine_name = $this->input->post("medicine_name");
        $per_page = 500;
        $page = $this->input->get("page");
        if ($page == 0) {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        $current_ym = date('ym');
        $current_ym_plus = date('ym', strtotime('+4 months'));
        $plus_m = date('ym', strtotime('+4 months'));
        $sql = "select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) as up_expdate, medicines.*, purchases.* from purchases 
        join medicines on purchase_medicine_id = medicine_id) as vtable where up_expdate between $current_ym and $plus_m";
        if (!empty($medicine_name)) {
            $sql .= " and medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " order by purchase_expire_year, purchase_expire_month limit $start_from,$per_page";

        $medicine_data = $this->db->query($sql)->result_array();
        $data = array();
        if (count($medicine_data) > 0) {
            foreach ($medicine_data as $k => $medicine) {
                $stock = $this->{$this->targetModel}->stock_of_medicine($medicine['medicine_id'], $medicine['purchase_batch']);
                $medicine_data[$k]['left_strip'] = $stock['left_strip'];
                $medicine_data[$k]['left_loose'] = $stock['left_loose'];
                if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                    unset($medicine_data[$k]);
                }
            }
            // $result = $this->{$this->targetModel}->expire();
            // $this->render(array('uri'=>'expiring','result' => $result), 'expire_tpl');
            $data["status"] = "found";
            $data["result"] = $medicine_data;
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            $data["status"] = "not found";
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
    public function expired_view()
    {
        $medicine_name = $this->input->get_post('medicine_name', true);
        $batch         = $this->input->get_post('batch', true);
        $storage       = $this->input->get_post('storage', true);
        $page          = $this->input->get_post('page', true);
        $per_page      = $this->input->get_post('per_page', true);

        $report_data = $this->_get_expired_data($medicine_name, $batch, $storage, $page, $per_page);

        if ($this->input->is_ajax_request() || $this->input->get_post('ajax_resp') == '1') {
            $this->load->view('console/medicine_stock/expired_table_tpl', $report_data);
            return;
        }

        $this->render($report_data, 'expired_tpl');
    }

    public function expired_export()
    {
        $medicine_name = $this->input->get('medicine_name', true);
        $batch         = $this->input->get('batch', true);
        $storage       = $this->input->get('storage', true);

        $rep = $this->_get_expired_data($medicine_name, $batch, $storage, 1, 'all');
        $alldata = !empty($rep['full_data']) ? $rep['full_data'] : $rep['alldata'];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Header row
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Medicine Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Manufacturer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Batch');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Purchase Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Expiry (Month/Year)');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Expired Time Ago');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Stock Strip');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Stock Loose');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'MRP (Rs)');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Expired Value (Rs)');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Storage / Rack');

        $rowCount = 2;
        $total_strips = 0;
        $total_loose  = 0;
        $total_value  = 0;

        if (!empty($alldata)) {
            $counter = 1;
            foreach ($alldata as $item) {
                $status_text = ($item['months_ago'] <= 0) ? 'Expired this month' : $item['months_ago'] . ' month(s) ago';
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $item['medicine_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $item['medicine_manufacturer']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $item['purchase_batch']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, !empty($item['purchase_date']) ? date('d-m-Y', strtotime($item['purchase_date'])) : '-');
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $item['formatted_expiry']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status_text);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, (float)$item['left_strip']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, (float)$item['left_loose']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, (float)$item['purchase_mrp']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, (float)$item['expired_value']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, !empty($item['medicine_storage']) ? $item['medicine_storage'] : '-');

                $total_strips += (float)$item['left_strip'];
                $total_loose  += (float)$item['left_loose'];
                $total_value  += (float)$item['expired_value'];
                $rowCount++;
            }
        }

        // Footer total
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'TOTAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_strips);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $total_loose);
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $total_value);

        $filename = "expired_medicines_report_" . date("Y-m-d_H-i-s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    private function _get_expired_data($medicine_name = null, $batch = null, $storage = null, $page = 1, $per_page = 25)
    {
        $current_ym = date('Ym'); // Current month YYYYMM, e.g. 202611

        $where_clauses = array();
        $where_clauses[] = "p.purchase_expire_year IS NOT NULL";
        $where_clauses[] = "p.purchase_expire_year != ''";
        $where_clauses[] = "p.purchase_expire_year != '0'";
        $where_clauses[] = "p.purchase_expire_month IS NOT NULL";
        $where_clauses[] = "p.purchase_expire_month > 0";

        if (!empty($medicine_name)) {
            $med_esc = $this->db->escape_like_str(trim($medicine_name));
            $where_clauses[] = "(m.medicine_name LIKE '%{$med_esc}%' OR m.medicine_manufacturer LIKE '%{$med_esc}%')";
        }

        if (!empty($batch)) {
            $batch_esc = $this->db->escape_like_str(trim($batch));
            $where_clauses[] = "p.purchase_batch LIKE '%{$batch_esc}%'";
        }

        if (!empty($storage)) {
            $storage_esc = $this->db->escape_like_str(trim($storage));
            $where_clauses[] = "m.medicine_storage LIKE '%{$storage_esc}%'";
        }

        $where_sql = implode(' AND ', $where_clauses);

        // High-performance single aggregated query: finds only expired batches that currently hold active stock
        $sql = "SELECT 
                    p_exp.purchase_medicine_id,
                    p_exp.purchase_batch,
                    p_exp.purchase_expire_month,
                    p_exp.purchase_expire_year,
                    p_exp.purchase_date,
                    p_exp.purchase_mrp,
                    p_exp.expdate,
                    m.medicine_id,
                    m.medicine_name,
                    m.medicine_manufacturer,
                    m.medicine_category,
                    m.medicine_storage,
                    m.medicine_unit,
                    COALESCE(p_tot.total_purchased, 0) AS total_purchased,
                    COALESCE(s_tot.total_sold, 0) AS total_sold,
                    COALESCE(s_tot.total_sold_loose, 0) AS total_sold_loose,
                    COALESCE(b_tot.init_strip, 0) AS init_strip,
                    COALESCE(b_tot.init_loose, 0) AS init_loose,
                    COALESCE(rp_tot.ret_purchased, 0) AS ret_purchased,
                    COALESCE(rs_tot.ret_sold, 0) AS ret_sold
                FROM (
                    SELECT 
                        p.purchase_medicine_id,
                        p.purchase_batch,
                        p.purchase_expire_month,
                        p.purchase_expire_year,
                        MAX(p.purchase_date) AS purchase_date,
                        MAX(p.purchase_mrp) AS purchase_mrp,
                        CONCAT(
                            CASE 
                                WHEN LENGTH(TRIM(p.purchase_expire_year)) = 2 THEN CONCAT('20', LPAD(TRIM(p.purchase_expire_year), 2, '0'))
                                WHEN LENGTH(TRIM(p.purchase_expire_year)) = 4 THEN TRIM(p.purchase_expire_year)
                                ELSE LPAD(TRIM(p.purchase_expire_year), 4, '0')
                            END,
                            LPAD(TRIM(p.purchase_expire_month), 2, '0')
                        ) AS expdate
                    FROM purchases p
                    JOIN medicines m ON p.purchase_medicine_id = m.medicine_id
                    WHERE {$where_sql}
                    GROUP BY p.purchase_medicine_id, p.purchase_batch, p.purchase_expire_year, p.purchase_expire_month
                    HAVING expdate <= '{$current_ym}'
                ) p_exp
                JOIN medicines m ON p_exp.purchase_medicine_id = m.medicine_id
                LEFT JOIN (
                    SELECT purchase_medicine_id, purchase_batch, SUM(purchase_quantity + purchase_free_quantity) AS total_purchased
                    FROM purchases
                    GROUP BY purchase_medicine_id, purchase_batch
                ) p_tot ON p_tot.purchase_medicine_id = p_exp.purchase_medicine_id AND p_tot.purchase_batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT sale_medicine_id, sale_batch, SUM(sale_strip_quantity) AS total_sold, SUM(sale_loose_quantity) AS total_sold_loose
                    FROM sales
                    GROUP BY sale_medicine_id, sale_batch
                ) s_tot ON s_tot.sale_medicine_id = p_exp.purchase_medicine_id AND s_tot.sale_batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT medicine_stock_medicine, medicine_stock_batch, SUM(medicine_strip_stock) AS init_strip, SUM(medicine_loose_stock) AS init_loose
                    FROM medicine_stocks
                    GROUP BY medicine_stock_medicine, medicine_stock_batch
                ) b_tot ON b_tot.medicine_stock_medicine = p_exp.purchase_medicine_id AND b_tot.medicine_stock_batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT return_purchase_medicine_id, return_purchase_Batch, SUM(return_purchase_strip) AS ret_purchased
                    FROM return_purchases
                    GROUP BY return_purchase_medicine_id, return_purchase_Batch
                ) rp_tot ON rp_tot.return_purchase_medicine_id = p_exp.purchase_medicine_id AND rp_tot.return_purchase_Batch = p_exp.purchase_batch
                LEFT JOIN (
                    SELECT return_sale_medicine_id, return_sale_Batch, SUM(return_sale_strip) AS ret_sold
                    FROM returns_sales
                    GROUP BY return_sale_medicine_id, return_sale_Batch
                ) rs_tot ON rs_tot.return_sale_medicine_id = p_exp.purchase_medicine_id AND rs_tot.return_sale_Batch = p_exp.purchase_batch
                WHERE (
                    (COALESCE(p_tot.total_purchased, 0) - COALESCE(s_tot.total_sold, 0) - COALESCE(rp_tot.ret_purchased, 0) + COALESCE(rs_tot.ret_sold, 0) + COALESCE(b_tot.init_strip, 0)) > 0
                    OR
                    (COALESCE(b_tot.init_loose, 0) - COALESCE(s_tot.total_sold_loose, 0)) > 0
                )
                ORDER BY p_exp.expdate DESC, m.medicine_name ASC";

        $rows = $this->db->query($sql)->result_array();

        $alldata = array();
        $total_batches = 0;
        $total_strips = 0;
        $total_loose = 0;
        $total_expired_value = 0;
        $distinct_med_map = array();

        $current_year_int  = intval(date('Y'));
        $current_month_int = intval(date('n'));

        $month_names = array(
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        );

        if (!empty($rows)) {
            foreach ($rows as $row) {
                $base_left_strip = floatval($row['total_purchased']) - floatval($row['total_sold']) - floatval($row['ret_purchased']) + floatval($row['ret_sold']) + floatval($row['init_strip']);
                $balanced_loose  = floatval($row['init_loose']) - floatval($row['total_sold_loose']);

                $unit = !empty($row['medicine_unit']) ? floatval($row['medicine_unit']) : 10;
                if ($unit <= 0) $unit = 10;

                $fromStrip = 0;
                $looseLeft = 0;
                if ($balanced_loose > 0) {
                    $fromStrip = ceil($balanced_loose / $unit);
                    $looseLeft = ($fromStrip * $unit) - $balanced_loose;
                } elseif ($balanced_loose < 0) {
                    $fromStrip = floor($balanced_loose / $unit);
                    $looseLeft = $balanced_loose - ($fromStrip * $unit);
                }

                $left_strip = $base_left_strip + $fromStrip;
                $left_loose = $looseLeft;

                // Filter out batches with zero or negative remaining stock
                if ($left_strip <= 0 && $left_loose <= 0) {
                    continue;
                }

                $exp_year_raw  = trim($row['purchase_expire_year']);
                $exp_year_full = (strlen($exp_year_raw) == 2) ? intval('20' . $exp_year_raw) : intval($exp_year_raw);
                $exp_month_int = intval($row['purchase_expire_month']);

                $months_ago = (($current_year_int - $exp_year_full) * 12) + ($current_month_int - $exp_month_int);

                $month_label = isset($month_names[$exp_month_int]) ? $month_names[$exp_month_int] : str_pad($exp_month_int, 2, '0', STR_PAD_LEFT);
                $formatted_expiry = $month_label . ' ' . $exp_year_full;

                $mrp = floatval(!empty($row['purchase_mrp']) ? $row['purchase_mrp'] : 0);
                $expired_value = max(0, ($left_strip * $mrp) + (($left_loose / $unit) * $mrp));

                $row['left_strip']        = $left_strip;
                $row['left_loose']        = $left_loose;
                $row['purchase_mrp']      = $mrp;
                $row['expired_value']     = round($expired_value, 2);
                $row['exp_year_full']     = $exp_year_full;
                $row['exp_month_int']     = $exp_month_int;
                $row['formatted_expiry']  = $formatted_expiry;
                $row['months_ago']        = $months_ago;

                $alldata[] = $row;
                $total_batches++;
                $total_strips += $left_strip;
                $total_loose  += $left_loose;
                $total_expired_value += $row['expired_value'];
                $distinct_med_map[$row['medicine_id']] = true;
            }
        }

        $page = (!empty($page) && is_numeric($page) && $page > 0) ? intval($page) : 1;
        if ($per_page === 'all' || $per_page === '-1' || $per_page === '0') {
            $per_page_val = 0;
        } else {
            $per_page_val = (!empty($per_page) && is_numeric($per_page) && $per_page > 0) ? intval($per_page) : 25;
        }

        $total_records = count($alldata);
        $total_pages   = ($per_page_val > 0) ? (int)ceil($total_records / $per_page_val) : 1;
        if ($total_pages < 1) $total_pages = 1;
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        $offset       = ($page - 1) * $per_page_val;
        $paged_data   = ($per_page_val > 0) ? array_slice($alldata, $offset, $per_page_val) : $alldata;
        $start_record = ($total_records > 0) ? ($offset + 1) : 0;
        $end_record   = ($per_page_val > 0) ? min($offset + $per_page_val, $total_records) : $total_records;

        return array(
            'alldata'                  => $paged_data,
            'full_data'                => $alldata,
            'total_records'            => $total_records,
            'page'                     => $page,
            'per_page'                 => $per_page_val,
            'total_pages'              => $total_pages,
            'start_record'             => $start_record,
            'end_record'               => $end_record,
            'total_batches'            => $total_batches,
            'total_strips'             => $total_strips,
            'total_loose'              => $total_loose,
            'total_expired_value'      => $total_expired_value,
            'total_distinct_medicines' => count($distinct_med_map),
            'medicine_name'            => $medicine_name,
            'batch'                    => $batch,
            'storage'                  => $storage,
            'current_ym'               => $current_ym,
        );
    }
    public function expired()
    {
        $medicine_name = $this->input->post("medicine_name");
        $per_page = 500;
        $page = $this->input->get("page");
        if ($page == 0) {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //$start = ($start_from + 1);

        $current_y = date('y');
        $current_m = date('m');
        $sql = "select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) 
            as expdate, medicines.*, purchases.* 
                from purchases join medicines on purchase_medicine_id = medicine_id) as vtable where expdate <= $current_y$current_m";
        if (!empty($medicine_name)) {
            $sql .= " and medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " order by purchase_expire_year desc,purchase_expire_month desc limit $start_from,$per_page";
        $medicine_data = $this->db->query($sql)->result_array();
        $data = array();
        if (count($medicine_data) > 0) {
            foreach ($medicine_data as $k => $medicine) {
                $stock = $this->{$this->targetModel}->stock_of_medicine($medicine['medicine_id'], $medicine['purchase_batch']);
                $medicine_data[$k]['left_strip'] = $stock['left_strip'];
                $medicine_data[$k]['left_loose'] = $stock['left_loose'];
                if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                    unset($medicine_data[$k]);
                }
            }
            $data["status"] = "found";
            $data["result"] = $medicine_data;
            // $result = $this->{$this->targetModel}->expire(true);
            // $this->render(array('uri'=>'expired','result' => $result), 'expire_tpl');

            // echo json_encode(array("status"=>"found","result"=>$medicine_data));
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            $data["status"] = "not found";
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    public function zeronegetive()
    {
        pr("work in progress", 1);
        $result = $this->{$this->targetModel}->zeronegetive(true);
        $this->render(array('result' => $result), 'zeronegetive_tpl');
    }

    public function reconsile()
    {
        $data = json_decode(file_get_contents("https://www.medicea.in/rest/med/drug/all/Digene"), true);
        foreach ($data as $k => $d) {
            $mapped[$k]['medicine_name'] = $d['name'];
            $mapped[$k]['medicine_manufacturer'] = $d['companyName'];
            $mapped[$k]['medicine_category'] = $d['type'];
            $mapped[$k]['medicine_hsn'] = $d['hsnCode'];
            $mapped[$k]['medicine_unit'] = @$d['packing'];
        }
        pr(($mapped));
    }
}
