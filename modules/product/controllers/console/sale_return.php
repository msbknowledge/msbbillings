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
class Sale_return extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'sales_model';
        $this->moduleMeta = array('medical' => 'Sale');
        $this->page_config['tablePrimaryKey'] = $this->sales_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Sale'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,sale_return,edit_detail,delete,view_detail';

        $this->page_config['searchFields'] = 'product_name,customer_contact,sale_date,sale_invoice,customer_name,doctor_name,sale_batch,sale_mrp'; //search box,
        $this->page_config['list_columns'] = 'sale_date,sale_invoice,customer_name,sale_timestamp,sale_total_paid';
        $this->page_config['autocomplete']['customer_name'] = array('customers' => 'customer_name');
        $this->page_config['autocomplete']['customer_contact'] = array('customers' => 'customer_contact');
        $this->page_config['autocomplete']['doctor_name'] = array('doctors_model' => 'doctor_name');
        $this->page_config['autocomplete']['product_name'] = array('products' => 'product_name');

        /*         * end page_config* */
    }

    public function add_detail() {


        if ($this->input->post()) {
            $customer['customer_name'] = strtoupper($this->input->post('customer_name'));
            $customer['customer_address'] = strtoupper($this->input->post('customer_address'));
            $customer['customer_gst'] = strtoupper($this->input->post('customer_gst'));
            $customer['customer_contact'] = $this->input->post('customer_contact');
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
            $sale = '';
            $stock = 0;
            $unit = 0;
            for ($i = 0; $i < count($this->input->post('sale_total')); $i++) {
                $product = null;
                $sale[$i]['sale_invoice'] = $this->input->post('sale_invoice');
                $sale[$i]['sale_date'] = date('Y-m-d', strtotime($this->input->post('sale_date')));
                $sale[$i]['sale_customer'] = $customer_ID;
                $sale[$i]['sale_doctor'] = $doctor_ID;

                $sale[$i]['sale_loose_quantity'] = $this->input->post('sale_loose_quantity')[$i];
                $sale[$i]['sale_strip_quantity'] = $this->input->post('sale_strip_quantity')[$i];

                $product['product_name'] = strtoupper($this->input->post('product_name')[$i]);
                $data = $this->products_model->get_list($product);

                $sale[$i]['sale_batch'] = $this->input->post('sale_batch')[$i];
                $sale[$i]['sale_expire_month'] = $this->input->post('sale_expire_month')[$i];
                $sale[$i]['sale_expire_year'] = $this->input->post('sale_expire_year')[$i];
                $sale[$i]['sale_mrp'] = $this->input->post('sale_mrp')[$i];
                $sale[$i]['sale_rate'] = $this->input->post('sale_rate')[$i];
                if (empty($data)) {
                    $product['product_unit'] = $this->input->post('product_unit')[$i];
                    $data = $this->products_model->insert_data($product);
                    $product_id = $data;
                    $strip = (int) $sale[$i]['sale_strip_quantity'];
                    $loose = (int) $sale[$i]['sale_loose_quantity'];
                    product_stock_update(
                            $sale[$i]['sale_batch'], $product_id, $strip, $loose, '+', $sale[$i]['sale_mrp'], $sale[$i]['sale_expire_month'], $sale[$i]['sale_expire_year']);
                } else {
                    $product_id = $data[0]['product_id'];
                }

                $sale[$i]['sale_product_id'] = $product_id;
                $sale[$i]['sale_discount_percent'] = $this->input->post('sale_discount_percent')[$i];
                $sale[$i]['sale_taxable'] = $this->input->post('sale_taxable')[$i];
                $sale[$i]['sale_sgst_percent'] = $this->input->post('sale_sgst_percent')[$i];
                $sale[$i]['sale_sgst'] = $this->input->post('sale_sgst')[$i];
                $sale[$i]['sale_cgst_percent'] = $this->input->post('sale_cgst_percent')[$i];
                $sale[$i]['sale_cgst'] = $this->input->post('sale_cgst')[$i];
                $sale[$i]['sale_total'] = $this->input->post('sale_total')[$i];
                $sale[$i]['sale_total_previous_due'] = $this->input->post('sale_total_previous_due');
                $sale[$i]['sale_total_paid'] = $this->input->post('sale_total_paid');
                $sale[$i]['sale_total_current_due'] = $this->input->post('sale_total_current_due');
                $sale[$i]['sale_paid_by'] = $this->input->post('sale_paid_by');
                $sale[$i]['sale_note'] = $this->input->post('sale_note');
                product_stock_update($sale[$i]['sale_batch'], $product_id, $sale[$i]['sale_strip_quantity'], $sale[$i]['sale_loose_quantity'], '-');
            }
            $this->db->query("UPDATE `options` SET `option_value`=(option_value+1) WHERE option_key='invoice_last_count'");
            $data = $this->sales_model->insert_data($sale, true);
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
    public function index() {
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

    /**
     *  view detail old not in use
     */
    public function old_view_detail() {
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
    public function view_detail() {
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
    public function edit_detail() {

        if ($this->input->post()) {
            //pr($this->input->post(),1);
            /*             * **************************rolling back all sale************************ */
            $invoice = $this->input->post('sale_invoice');
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => 0));
            $postedData = $this->input->post();

            //$result=array_intersect($postedData['product_name'],$dataFull['product_name']);
            //pr($postedData);
           pr(end(array_keys($dataFull)));
            foreach ($postedData as $key => $value) {
                foreach ($dataFull as $keys => $entry) {
                  if (is_array($postedData[$key])){
                      
                      $result['product_name']=array_intersect($postedData['product_name'],array($entry['product_name']));
                      //$result[$key][]=end($postedData[$key]);
                  }else{
                      $result[$key]=$entry[$key];
                  }
                   
                }
            }
            pr($result);
            pr($dataFull, 1);
            foreach ($dataFull as $key => $entry) {
                product_stock_update(
                        $entry['sale_batch'], $entry['sale_product_id'], $entry['sale_strip_quantity'], $entry['sale_loose_quantity'], '+', $entry['sale_mrp'], $entry['sale_expire_month'], $entry['sale_expire_year']
                );
            }

            /**             * *************************************************** */
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
            $sale = '';
            $stock = 0;
            $unit = 0;

            for ($i = 0; $i < count($this->input->post('sale_total')); $i++) {
                $product = null;
                $product_id;
                $sale[$i]['sale_invoice'] = $this->input->post('sale_invoice');
                $sale[$i]['sale_date'] = date('Y-m-d', strtotime($this->input->post('sale_date')));
                $sale[$i]['sale_customer'] = $customer_ID;
                $sale[$i]['sale_doctor'] = $doctor_ID;
                $sale[$i]['sale_loose_quantity'] = $this->input->post('sale_loose_quantity')[$i];
                $sale[$i]['sale_strip_quantity'] = $this->input->post('sale_strip_quantity')[$i];

                $product['product_name'] = strtoupper($this->input->post('product_name')[$i]);
                $data = $this->products_model->get_list($product);

                if (empty($data)) {
                    $product['product_unit'] = $this->input->post('product_unit')[$i];
                    $data = $this->products_model->insert_data($product);
                    $product_id = $data;
                    $strip = (int) $sale[$i]['sale_strip_quantity'];
                    $loose = (int) $sale[$i]['sale_loose_quantity'];
                    product_stock_update(
                            $sale[$i]['sale_batch'], $product_id, $strip, $loose, '+', $sale[$i]['sale_mrp'], $sale[$i]['sale_expire_month'], $sale[$i]['sale_expire_year']
                    );
                } else {
                    $product_id = $data[0]['product_id'];
                }

                $sale[$i]['sale_product_id'] = $product_id;
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
                $sale[$i]['sale_total_paid'] = $this->input->post('sale_total_paid');
                $sale[$i]['sale_total_current_due'] = $this->input->post('sale_total_current_due');
                $sale[$i]['sale_paid_by'] = $this->input->post('sale_paid_by');
                $sale[$i]['sale_note'] = $this->input->post('sale_note');
                product_stock_update($sale[$i]['sale_batch'], $product_id, $sale[$i]['sale_strip_quantity'], $sale[$i]['sale_loose_quantity'], '-');
            }

            $this->sales_model->delete(array('sale_invoice' => $this->input->post('invoice_number')));
            $data = $this->sales_model->insert_data($sale, true);
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
            $this->render(array('status' => 'success', 'data' => $dataFull, 'message' => '<strong>Well done!</strong> Data Save.'));
        } else {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => 0));
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

            $this->{$this->targetModel}->delete(array('sale_invoice' => $postedData['selectedItem']), TRUE);
        }

        if (isset($postedData['entry'])) {
            $this->medical_stock_rollback(base64_decode($postedData['entry']));
            $this->{$this->targetModel}->delete(array('sale_invoice' => base64_decode($postedData['entry'])));
        }
        echo json_encode(array('status' => 'success'));
    }

    /*     * **********stock update is hold************ */

    private function medical_stock_update($old, $new) {
        $toupdate = null;
        $updatewith = null;
        foreach ($old as $key => $value) {
            product_stock_update($value['sale_batch'], $value['sale_product_id'], $value['sale_strip_quantity'], $value['sale_loose_quantity'], '+');
        }
        foreach ($new as $key => $value) {
            product_stock_update($value['sale_batch'], $value['sale_product_id'], $value['sale_strip_quantity'], $value['sale_loose_quantity'], '-');
        }
    }

    /*     * **********stock update is hold************ */

    private function medical_stock_rollback($items) {
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

    public function sale_return() {

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
            if (empty($this->input->post('product_hsn'))) {
                foreach ($dataReturn as $value) {
                    product_stock_update($value['sale_batch'], $value['sale_product_id'], $value['sale_strip_quantity'], $value['sale_loose_quantity'], '-');
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
                    $product['product_name'] = strtoupper($this->input->post('product_name')[$i]);
                    $product['product_manufacturer'] = strtoupper($this->input->post('product_manufacturer')[$i]);
                    $product['product_hsn'] = $this->input->post('product_hsn')[$i];


                    $product_id = null;
                    $data = $this->products_model->get_list($product);

                    $product_id = $data[0]['product_id'];
                    $stock = (int) $data[0]['product_stock'] + (int) $sale[$i]['sale_quantity'];
                    $sale[$i]['sale_product_id'] = $product_id;
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
                        product_stock_update($sale[$i]['sale_batch'], $product_id, $sale[$i]['sale_strip_quantity'], $sale[$i]['sale_loose_quantity'], '+');
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
            $this->render(array('status' => 'success', 'data' => $dataFinal,
                'message' => '<strong>Well done!</strong> Data Save.'));
        } else {
            $invoice = base64_decode($this->uri->segment(4));
            $dataFull = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice));
            $dataReturn = $this->{$this->targetModel}->get_list(array('sale_invoice' => $invoice, 'sale_return' => TRUE));
            $dataFinal = $this->sale_return_stocks($dataFull, $dataReturn);
            // pr($dataFinal);
            $this->render(array('data' => $dataFinal));
        }
    }

    private function sale_return_stocks($dataFull, $return) {
        foreach ($dataFull as $dfk => $df) {
            foreach ($return as $rk => $r) {
                if ($df['sale_product_id'] == $r['sale_product_id'] && $df['sale_return'] == false) {
                    $dataFull[$dfk]['sale_quantity'] = $dataFull[$dfk]['sale_quantity'] - $r['sale_quantity'];
                }
            }
        }
        return $dataFull;
    }

///// batchnumber bug
    public function autocomplete() {
        $field = $this->uri->segment(5);
        $model = $this->uri->segment(4);
        $search = $this->input->get('term');
        if ($model == "products_model") {
            $data = $this->db->query('select '
                            . 'products.*, '
                            . 'purchase_batch as sale_batch,'
                            . 'purchase_expire_month as sale_expire_month,'
                            . 'purchase_expire_year as sale_expire_year,'
                            . 'purchase_unit as sale_quantity,'
                            . 'purchase_mrp/purchase_unit as sale_mrp,'
                            . 'purchase_sgst_percent as sale_sgst_percent,'
                            . 'purchase_cgst_percent as sale_cgst_percent'
                            . '  from products'
                            . ' join purchases on product_id=purchase_product_id '
                            . ' join product_stocks on product_id=product_stock_product '
                            . 'where product_id in('
                            . 'select distinct(purchase_product_id) from purchases order by purchase_date) and product_name like "%' . $search . '%" and '
                            . 'product_stock_count >0 group by product_id order by product_stock_batch desc')->result_array();
        } else {
            $data = ($this->{$model}->get_list_for_dropdown(null, NULL, NULL, 10, NULL, array($field => $search)));
        }
        $responce = null;
        foreach ($data as $id => $value) {
            $responce[] = array('id' => $id, 'label' => $value[$field], 'value' => $value[$field], 'complete' => $value);
        }
        echo json_encode($responce);
    }

    public function daily_sale_product() {
        $this->db->query('select * from sales')->result_array();
    }

    public function report_daily_wise() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $customer_gst = $this->input->post('customer_gst');
        #echo $package_name;
        $sql = "SELECT customers.*,sales.sale_date,sales.sale_return,sales.sale_return_date,sales.sale_invoice,sum(sale_taxable) as sale_taxable,sum(sale_discount_percent) as sale_discount_percent,sum(sale_cgst) as sale_cgst,sum(sale_sgst) as sale_sgst,sum(sale_total) as sale_total  FROM `sales` join `customers` on sales.sale_customer=customers.customer_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND sale_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND sale_date<='" . $period_end . "'";
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
            $customer_data[$key]['sale_total'] = $invoice['sale_total'];
            $customer_data[$key]['sale_return'] = $invoice['sale_return'];
            $customer_data[$key]['sale_return_date'] = $invoice['sale_return_date'];
        }
        #pr($customer_data,1);
        #$package=$this->packages_model->get_list();

        if ($this->input->post('key')) {
            $this->load->view('console/sale/report_day_wise_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/sale/gst_record_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

    public function report_gstin_wise() {
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $customer_name = $this->input->post('customer_name');
        $customer_gst = $this->input->post('customer_gst');
        #echo $package_name;
        $sql = "SELECT customers.*,sales.sale_date,sales.sale_return,sales.sale_return_date,sales.sale_invoice,sum(sale_taxable) as sale_taxable,sum(sale_discount_percent) as sale_discount_percent,sum(sale_cgst) as sale_cgst,sum(sale_sgst) as sale_sgst,sum(sale_total) as sale_total  FROM `sales` join `customers` on sales.sale_customer=customers.customer_id  WHERE 1 = 1 ";

        if (!empty($period_start)) {
            $sql .= "AND sale_date >='" . $period_start . "'";
        }
        if (!empty($period_end)) {
            $sql .= "AND sale_date<='" . $period_end . "'";
        }

        if (!empty($customer_name)) {
            $sql .= "AND customer_name like '%" . $customer_name . "%'";
        }
        if (!empty($customer_gst)) {
            $sql .= "AND customer_gst like '" . $customer_gst . "%'";
        }
        $sql .= "GROUP BY customer_gst";
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
            $customer_data[$key]['sale_total'] = $invoice['sale_total'];
            $customer_data[$key]['sale_return'] = $invoice['sale_return'];
            $customer_data[$key]['sale_return_date'] = $invoice['sale_return_date'];
        }
        #pr($customer_data,1);
        #$package=$this->packages_model->get_list();

        if ($this->input->post('key')) {
            $this->load->view('console/sale/report_gst_wise_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end));
        } else {

            $this->load->view('console/sale/gst_record_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end,));
        }
    }

}

?>