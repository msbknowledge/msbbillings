<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profit_loss extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");
        $this->output->cache(0);
    }

    public function index() {
        $period_start = $this->input->get_post('start', true);
        $period_end   = $this->input->get_post('end', true);
        $page         = $this->input->get_post('page', true);
        $per_page     = $this->input->get_post('per_page', true);

        // Default date range: current financial year (April 1 to today) or fallback to current month
        if (empty($period_start)) {
            $current_month = (int)date('m');
            $fy_start_year = ($current_month >= 4) ? date('Y') : (date('Y') - 1);
            $period_start  = $fy_start_year . '-04-01';
        }
        if (empty($period_end)) {
            $period_end = date('Y-m-d');
        }

        $report_data = $this->_get_profit_loss_data($period_start, $period_end, $page, $per_page);

        if ($this->input->is_ajax_request() || $this->input->get_post('ajax_resp') == '1' || $this->input->get_post('key') == 'ajax_resp') {
            $this->load->view('console/profit_loss_table_tpl', $report_data);
            return;
        }

        $this->render($report_data, 'profit_loss_tpl');
    }

    public function export_excel() {
        $period_start = $this->input->get('start', true);
        $period_end   = $this->input->get('end', true);
        if (empty($period_start)) $period_start = date('Y-04-01');
        if (empty($period_end))   $period_end   = date('Y-m-d');

        $rep = $this->_get_profit_loss_data($period_start, $period_end, 1, 'all');
        $daily = !empty($rep['daily_records']) ? $rep['daily_records'] : array();

        $filename = "profit_loss_statement_" . $period_start . "_to_" . $period_end . ".csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('PROFIT & LOSS FINANCIAL STATEMENT (' . $period_start . ' to ' . $period_end . ')'));
        fputcsv($output, array(
            'Date', 
            'Purchase Taxable (Rs)', 
            'Purchase GST (Rs)', 
            'Purchase Total (Rs)', 
            'Sales Taxable (Rs)', 
            'Sales GST (Rs)', 
            'Sales Discount (Rs)', 
            'Net Sales Total (Rs)', 
            'Govt GST Payable (Rs)', 
            'Daily Net Profit/Loss (Rs)',
            'Margin (%)'
        ));

        foreach ($daily as $row) {
            fputcsv($output, array(
                $row['report_date'],
                number_format($row['purchase_taxable'], 2, '.', ''),
                number_format($row['purchase_gst'], 2, '.', ''),
                number_format($row['purchase_total'], 2, '.', ''),
                number_format($row['sale_taxable'], 2, '.', ''),
                number_format($row['sale_gst'], 2, '.', ''),
                number_format($row['sale_grand_discount'], 2, '.', ''),
                number_format($row['net_sale_total'], 2, '.', ''),
                number_format($row['govt_gst_payable'], 2, '.', ''),
                number_format($row['daily_net_profit'], 2, '.', ''),
                number_format($row['margin_pct'], 2, '.', '') . '%'
            ));
        }

        // Summary Totals row
        fputcsv($output, array(
            'GRAND TOTAL',
            number_format($rep['total_purchase_taxable'], 2, '.', ''),
            number_format($rep['total_purchase_gst'], 2, '.', ''),
            number_format($rep['total_purchase_total'], 2, '.', ''),
            number_format($rep['total_sale_taxable'], 2, '.', ''),
            number_format($rep['total_sale_gst'], 2, '.', ''),
            number_format($rep['total_sale_discount'], 2, '.', ''),
            number_format($rep['total_sale_net'], 2, '.', ''),
            number_format($rep['total_govt_gst_payable'], 2, '.', ''),
            number_format($rep['net_profit_loss'], 2, '.', ''),
            number_format($rep['overall_margin_pct'], 2, '.', '') . '%'
        ));

        fclose($output);
        exit;
    }

    private function _get_profit_loss_data($period_start, $period_end, $page = 1, $per_page = 25) {
        $p_start = $this->db->escape(trim($period_start));
        $p_end   = $this->db->escape(trim($period_end));

        // 1. Overall aggregated totals
        $sql_totals = "
            SELECT 
                COALESCE(p.pur_taxable, 0) AS total_purchase_taxable,
                COALESCE(p.pur_total, 0) AS total_purchase_total,
                COALESCE(s.sale_taxable, 0) AS total_sale_taxable,
                COALESCE(s.sale_total, 0) AS total_sale_total,
                COALESCE(s.sale_dis, 0) AS total_sale_discount
            FROM (SELECT 1) dummy
            LEFT JOIN (
                SELECT SUM(purchase_taxable) AS pur_taxable, SUM(purchase_total) AS pur_total
                FROM purchases
                WHERE purchase_date BETWEEN {$p_start} AND {$p_end}
            ) p ON 1=1
            LEFT JOIN (
                SELECT SUM(sale_taxable) AS sale_taxable, SUM(sale_total) AS sale_total, SUM(sale_total * sale_grand_discount / 100) AS sale_dis
                FROM sales
                WHERE sale_date BETWEEN {$p_start} AND {$p_end}
            ) s ON 1=1
        ";
        $totals_row = $this->db->query($sql_totals)->row_array();

        $total_purchase_taxable = floatval($totals_row['total_purchase_taxable']);
        $total_purchase_total   = floatval($totals_row['total_purchase_total']);
        $total_purchase_gst     = $total_purchase_total - $total_purchase_taxable;

        $total_sale_taxable     = floatval($totals_row['total_sale_taxable']);
        $total_sale_total       = floatval($totals_row['total_sale_total']);
        $total_sale_gst         = $total_sale_total - $total_sale_taxable;
        $total_sale_discount    = floatval($totals_row['total_sale_discount']);
        $total_sale_net         = $total_sale_total - $total_sale_discount;

        $total_govt_gst_payable = $total_sale_gst - $total_purchase_gst;
        
        $gst_liability = ($total_govt_gst_payable > 0) ? $total_govt_gst_payable : 0;
        $net_profit_loss = $total_sale_net - ($total_purchase_total + $gst_liability);
        $overall_margin_pct = ($total_sale_net > 0) ? ($net_profit_loss / $total_sale_net) * 100 : 0;

        // 2. Daily breakdown
        $sql_daily = "
            SELECT 
                d.dt AS report_date,
                COALESCE(p.pur_taxable, 0) AS purchase_taxable,
                COALESCE(p.pur_total, 0) AS purchase_total,
                COALESCE(p.pur_gst, 0) AS purchase_gst,
                COALESCE(s.sale_taxable, 0) AS sale_taxable,
                COALESCE(s.sale_total, 0) AS sale_total,
                COALESCE(s.sale_gst, 0) AS sale_gst,
                COALESCE(s.sale_dis, 0) AS sale_grand_discount
            FROM (
                SELECT DISTINCT purchase_date AS dt FROM purchases WHERE purchase_date BETWEEN {$p_start} AND {$p_end}
                UNION 
                SELECT DISTINCT sale_date AS dt FROM sales WHERE sale_date BETWEEN {$p_start} AND {$p_end}
            ) d
            LEFT JOIN (
                SELECT purchase_date, SUM(purchase_taxable) AS pur_taxable, SUM(purchase_total) AS pur_total, SUM(purchase_total - purchase_taxable) AS pur_gst
                FROM purchases
                WHERE purchase_date BETWEEN {$p_start} AND {$p_end}
                GROUP BY purchase_date
            ) p ON p.purchase_date = d.dt
            LEFT JOIN (
                SELECT sale_date, SUM(sale_taxable) AS sale_taxable, SUM(sale_total) AS sale_total, SUM(sale_total - sale_taxable) AS sale_gst, SUM(sale_total * sale_grand_discount / 100) AS sale_dis
                FROM sales
                WHERE sale_date BETWEEN {$p_start} AND {$p_end}
                GROUP BY sale_date
            ) s ON s.sale_date = d.dt
            ORDER BY d.dt DESC
        ";
        $daily_rows = $this->db->query($sql_daily)->result_array();

        $processed_daily = array();
        foreach ($daily_rows as $row) {
            $pur_taxable = floatval($row['purchase_taxable']);
            $pur_total   = floatval($row['purchase_total']);
            $pur_gst     = floatval($row['purchase_gst']);

            $sale_taxable = floatval($row['sale_taxable']);
            $sale_total   = floatval($row['sale_total']);
            $sale_gst     = floatval($row['sale_gst']);
            $sale_dis     = floatval($row['sale_grand_discount']);
            $net_sale     = $sale_total - $sale_dis;

            $govt_gst = $sale_gst - $pur_gst;
            $daily_profit = $net_sale - ($pur_total + ($govt_gst > 0 ? $govt_gst : 0));
            $margin = ($net_sale > 0) ? ($daily_profit / $net_sale) * 100 : 0;

            $processed_daily[] = array(
                'report_date'           => $row['report_date'],
                'purchase_taxable'      => $pur_taxable,
                'purchase_gst'          => $pur_gst,
                'purchase_total'        => $pur_total,
                'sale_taxable'          => $sale_taxable,
                'sale_gst'              => $sale_gst,
                'sale_grand_discount'   => $sale_dis,
                'net_sale_total'        => $net_sale,
                'govt_gst_payable'      => $govt_gst,
                'daily_net_profit'      => $daily_profit,
                'margin_pct'            => $margin
            );
        }

        // Pagination
        $page = (!empty($page) && is_numeric($page) && $page > 0) ? intval($page) : 1;
        if ($per_page === 'all' || $per_page === '-1' || $per_page === '0') {
            $per_page_val = 0;
        } else {
            $per_page_val = (!empty($per_page) && is_numeric($per_page) && $per_page > 0) ? intval($per_page) : 25;
        }

        $total_records = count($processed_daily);
        $total_pages   = ($per_page_val > 0) ? (int)ceil($total_records / $per_page_val) : 1;
        if ($total_pages < 1) $total_pages = 1;
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        $offset       = ($page - 1) * $per_page_val;
        $paged_daily  = ($per_page_val > 0) ? array_slice($processed_daily, $offset, $per_page_val) : $processed_daily;
        $start_record = ($total_records > 0) ? ($offset + 1) : 0;
        $end_record   = ($per_page_val > 0) ? min($offset + $per_page_val, $total_records) : $total_records;

        return array(
            'period_start'              => $period_start,
            'period_end'                => $period_end,
            'total_purchase_taxable'    => $total_purchase_taxable,
            'total_purchase_gst'        => $total_purchase_gst,
            'total_purchase_total'      => $total_purchase_total,
            'total_sale_taxable'        => $total_sale_taxable,
            'total_sale_gst'            => $total_sale_gst,
            'total_sale_discount'       => $total_sale_discount,
            'total_sale_net'            => $total_sale_net,
            'total_govt_gst_payable'    => $total_govt_gst_payable,
            'net_profit_loss'           => $net_profit_loss,
            'overall_margin_pct'        => $overall_margin_pct,
            'daily_records'             => $processed_daily,
            'paged_daily'               => $paged_daily,
            'total_records'             => $total_records,
            'total_pages'               => $total_pages,
            'page'                      => $page,
            'per_page'                  => $per_page_val,
            'start_record'              => $start_record,
            'end_record'                => $end_record,
            // Backwards compatibility keys
            'purchase_data'             => array(array('purchase_taxable' => $total_purchase_taxable, 'purchase_total' => $total_purchase_total)),
            'sales_data'                => array(array('sale_taxable' => $total_sale_taxable, 'sale_total' => $total_sale_total)),
            'sale_grand_dis'            => array(array('sale_grand_discount' => $total_sale_discount)),
            'start'                     => $period_start,
            'end'                       => $period_end
        );
    }
}
?>
