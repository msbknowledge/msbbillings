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
        $this->page_config['searchFields'] = 'purchase_mrp,product_name,purchase_date,product_manufacturer,purchase_invoice,purchase_entry_number,purchase_batch,purchase_supplier'; //search box,
        $this->page_config['list_columns'] = 'product_name,purchased_total,purchase_entry_number,purchase_date,purchase_invoice,purchase_supplier';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['autocomplete']['product_name'] = array('products' => 'product_name');
        $this->page_config['use_dropdown_columns'] = 'purchase_supplier';
        $this->page_config['use_dropdown_columns_options']['purchase_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }

    public function add_detail() {
        if ($this->input->post()) {
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
            for ($i = 0; $i < count($this->input->post('product_name')); $i++) {
                $purchase[$i]['purchase_invoice'] = $this->input->post('purchase_invoice');
                $purchase[$i]['purchase_date'] = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                $purchase[$i]['purchase_supplier'] = $supplier_id;
                $purchase[$i]['purchase_entry_number'] = $this->input->post('purchase_entry_number');

                $purchase[$i]['purchase_quantity'] = $this->input->post('purchase_quantity')[$i];
                $purchase[$i]['purchase_free_quantity'] = $this->input->post('purchase_free_quantity')[$i];
                $purchase[$i]['purchase_unit'] = $this->input->post('purchase_unit')[$i];
                $product = null;
                $product['product_name'] = trim($this->input->post('product_name')[$i]);
                $data = $this->products_model->get_list($product);
                $product['product_unit'] = ($this->input->post('purchase_unit')[$i]);
                $product['product_manufacturer'] = ($this->input->post('product_manufacturer')[$i]);
                $product['product_hsn'] = $this->input->post('product_hsn')[$i];
                $product['product_storage'] = $this->input->post('product_storage')[$i];
                $product_id = null;
                if (empty($data)) {
                    $data = $this->products_model->insert_data($product);
                    $stock = $purchase[$i]['purchase_quantity'] + $purchase[$i]['purchase_free_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                    $product_id = $data;
                } else {
                    $product_id = $data[0]['product_id'];
                    $this->products_model->update_data($product, array('product_id' => $product_id));
                    $stock = (int) $purchase[$i]['purchase_quantity'] + (int) $purchase[$i]['purchase_free_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                }
                $purchase[$i]['purchase_product_id'] = $product_id;
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
                product_stock_update($purchase[$i]['purchase_batch'], $product_id, $stock, 0, '+', $purchase[$i]['purchase_mrp'], $purchase[$i]['purchase_expire_month'], $purchase[$i]['purchase_expire_year']);
                //  pr($purchase,1);
            }
            // pr($purchase,1);
            $data = $this->purchases_model->insert_data($purchase, true);
            increase_purchase_number();

            $this->render(array('status' => 'success', 'message' => '<strong>Well done!</strong> Data Save.'), 'add_detail');
        } else {
            $this->render(null, 'add_detail');
        }
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
            for ($i = 0; $i < count($this->input->post('product_name')); $i++) {
                $product = null;

                $purchase[$i]['purchase_invoice'] = $this->input->post('purchase_invoice');
                $purchase[$i]['purchase_date'] = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                $purchase[$i]['purchase_supplier'] = $supplier_id;
                $purchase[$i]['purchase_entry_number'] = $this->input->post('purchase_entry_number');
                $purchase[$i]['purchase_quantity'] = $this->input->post('purchase_quantity')[$i];
                $purchase[$i]['purchase_free_quantity'] = $this->input->post('purchase_free_quantity')[$i];
                $purchase[$i]['purchase_unit'] = $this->input->post('purchase_unit')[$i];
                $product['product_name'] = trim($this->input->post('product_name')[$i]);
                $product_id = null;
                $data = null;
                $data = $this->products_model->get_list($product);
                if (empty($data)) {
                    $dc++;

                    $product['product_unit'] = ($this->input->post('purchase_unit')[$i]);
                    $product['product_manufacturer'] = ($this->input->post('product_manufacturer')[$i]);
                    $product['product_hsn'] = $this->input->post('product_hsn')[$i];
                    $product['product_storage'] = $this->input->post('product_storage')[$i];
                    $data = $this->products_model->insert_data($product);

                    $stock = $purchase[$i]['purchase_quantity'] + $purchase[$i]['purchase_free_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                    $product_id = $data;
                } else {
                    $product['product_storage'] = $this->input->post('product_storage')[$i];
                    $product['product_unit'] = ($this->input->post('purchase_unit')[$i]);
                    $product['product_hsn'] = ($this->input->post('product_hsn')[$i]);
                    $product['product_manufacturer'] = ($this->input->post('product_manufacturer')[$i]);
                    $product_id = $data[0]['product_id'];
                    $this->products_model->update_data($product, array('product_id' => $product_id));
                    $stock = (int) $purchase[$i]['purchase_quantity'] + (int) $purchase[$i]['purchase_quantity'];
                    $unit = $purchase[$i]['purchase_unit'];
                }



                $purchase[$i]['purchase_product_id'] = $product_id;
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
            }
            $breakIt = false;
            foreach ($purchase as $key => $value) {
                foreach ($value as $keyx => $valuex) {
                    if (($valuex) == "") {
                        $dataFull = $this->{$this->targetModel}->get_list(array('purchase_entry_number' => $invoice));

                        pr($_POST, 1);
                        pr($purchase[$key], 1);
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

            if (empty($this->input->post('product_hsn'))) {
                foreach ($dataReturn as $value) {
                    product_stock_update($value['purchase_batch'], $value['purchase_product_id'], $value['purchase_free_quantity'] + $value['purchase_quantity'], 0);
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
                    $product['product_name'] = ($this->input->post('product_name')[$i]);
                    $product['product_manufacturer'] = ($this->input->post('product_manufacturer')[$i]);
                    $product['product_hsn'] = $this->input->post('product_hsn')[$i];
                    $data = $this->products_model->get_list($product);
                    $product_id = $data[0]['product_id'];
                    $purchase[$i]['purchase_product_id'] = $product_id;
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
                    if (!empty($purchase)) {
                        product_stock_update($purchase[$i]['purchase_batch'], $product_id, $purchase[$i]['purchase_free_quantity'] + $purchase[$i]['purchase_quantity'], 0, '-');
                    }
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
                if ($df['purchase_product_id'] == $r['purchase_product_id'] && $df['purchase_return'] == false) {
                    $dataFull[$dfk]['purchase_quantity'] = $dataFull[$dfk]['purchase_quantity'] - $r['purchase_quantity'];
                }
            }
        }
        return $dataFull;
    }

    public function report_gstin_wise() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $customer_gst = $this->input->post('customer_gst');
        #echo $package_name;
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

        if (!empty($customer_name)) {
            $sql .= "AND supplier_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= "AND supplier_gst like '" . $customer_gst . "%'";
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

        if (!empty($customer_name)) {
            $sql .= " AND supplier_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND supplier_gst like '" . $customer_gst . "%'";
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
        if ($this->input->post('key')) {
            $this->load->view('console/purchase/report_gstin_wise_tpl', array('gst_data' => $gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {
            $this->load->view('console/purchase/gst_record_tpl', array('gst_data' => $gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    public function daily_purchase_product() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $purchase_invoice = $this->input->post('purchase_invoice');
        $product_name = $this->input->post('product_name');

        $sql = "SELECT products.product_name,purchases.purchase_date,purchases.purchase_batch,purchases.purchase_quantity,purchases.purchase_invoice FROM `purchases` join `products` on purchases.purchase_product_id=products.product_id  WHERE 1 = 1";

        if (!empty($period_start)) {
            $sql .= " AND purchase_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= " AND purchase_date<='" . $period_end . "'";
        }

        if (!empty($purchase_invoice)) {
            $sql .= " AND purchase_invoice like '%" . $purchase_invoice . "%'";
        }
        if (!empty($product_name)) {
            $sql .= " AND product_name like '" . $product_name . "%'";
        }
        // $sql .= "GROUP BY purchase_invoice";

        $purchase = $this->db->query($sql)->result_array();
        $product_data = null;
        foreach ($purchase as $key => $invoice) {
            // pr($invoice);
            $product_data[$key]['purchase_invoice'] = $invoice['purchase_invoice'];
            $product_data[$key]['purchase_date'] = $invoice['purchase_date'];
            $product_data[$key]['purchase_quantity'] = $invoice['purchase_quantity'];
            $product_data[$key]['product_name'] = $invoice['product_name'];
            $product_data[$key]['purchase_batch'] = $invoice['purchase_batch'];
        }
        //pr($product_data,1);
        if ($this->input->post('key')) {
            $this->load->view('console/purchase/purchase_daily_product', array('product_data' => $product_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/purchase/purchase_daily_product_tpl', array('product_data' => $product_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    public function report_daily_wise() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $customer_gst = $this->input->post('customer_gst');
        #echo $package_name;
        $sql = "SELECT suppliers.*,purchases.purchase_date,purchases.purchase_return,purchases.purchase_return_date,purchases.purchase_invoice,sum(purchase_taxable) as purchase_taxable,sum(purchase_discount_percent) as purchase_discount_percent,sum(purchase_cgst) as purchase_cgst,sum(purchase_sgst) as purchase_sgst,sum(purchase_total) as purchase_total  FROM `purchases` join `suppliers` on purchases.purchase_supplier=suppliers.supplier_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND purchase_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND purchase_date<='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= "AND supplier_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= "AND supplier_gst like '" . $customer_gst . "%'";
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

        if (!empty($customer_name)) {
            $sql .= " AND supplier_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= " AND supplier_gst like '" . $customer_gst . "%'";
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
        if ($this->input->post('key')) {
            $this->load->view('console/purchase/report_daily_wise_tpl', array('daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {
            $this->load->view('console/purchase/gst_record_tpl', array('daily_gst_data' => $daily_gst_data, 'customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    /*     * *******correction needed*********** */

    private function medical_stock_update($old, $new) {
        $toupdate = null;
        $updatewith = null;
        foreach ($old as $key => $value) {
            $toupdate[$value['purchase_product_id']] = $value['purchase_quantity'];
            $stockrollback = $value['purchase_quantity'] + $value['purchase_free_quantity'];
            product_stock_update($value['purchase_batch'], $value['purchase_product_id'], $stockrollback, 0, '-');
        }
        foreach ($new as $key => $value) {
            $updatewith[$value['purchase_product_id']] = $value['purchase_quantity'];
            $stockupdate = $value['purchase_quantity'] + $value['purchase_free_quantity'];
            product_stock_update($value['purchase_batch'], $value['purchase_product_id'], $stockupdate, 0, '+', $value['purchase_mrp'], $value['purchase_expire_month'], $value['purchase_expire_year']);
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
        $datas['product_name'] = ' PAN 40MG 15S ';
        $data = $this->products_model->get_list($datas);
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
        pr($data);
    }

    public function check_duplicate_invoice() {
        $purchase_invoice = $this->input->post('purchase_invoice');
        $supplier['supplier_name'] = ($this->input->post('supplier_name'));
        $data = $this->suppliers_model->get_list($supplier);
        $datax = $this->{$this->targetModel}->get_list(
                array(
                    'supplier_id' => $data[0]['supplier_id'],
                    'purchase_invoice' => $purchase_invoice
        ));

        echo count($datax);
    }

    public function find_the_error() {
        $data = $this->db->query('select distinct purchase_entry_number,purchase_product_id,purchase_batch,purchase_mrp from purchases where purchase_product_id not in (select product_ID from products)')->result_array();
        pr($data);
    }

    public function purchase_history() {
        $data = $this->input->post();
        $datay = $this->db->query('select product_id from products where product_name like "' . trim($data['product']) . '"')->result_array();
        $datax = $this->db->query('select purchase_date,supplier_name,purchase_invoice,purchase_quantity,purchase_mrp,purchase_rate from purchases join suppliers on supplier_ID = purchase_supplier where purchase_product_id ="' . $datay[0]['product_id'] . '" order by purchase_date desc limit 0,5')->result_array();
        $this->load->view('console/purchase/purchase_history_tpl', array('data' => $datax, 'product' => $data['product']));
    }

}

?>
