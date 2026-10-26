<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author Kallol
 */
class Cable_invoice extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        //die('preeti');
        $this->moduleMeta = array('cable' => 'Invoice');
        $this->targetModel = 'cable_invoices_model';
        $this->load->model($this->targetModel);
                

        $this->page_config['use_dropdown_columns'] = 'invoice_customer';
        $this->page_config['use_dropdown_columns_options']['invoice_customer'] = $this->customer_list();
        if($this->current_user_session['user_type_super']==1)
        $this->allowed_action = array('delete','view_detail');
       

        $this->page_config['tablePrimaryKey'] = $this->cable_invoices_model->get_primary_key(); //pk
        
        /*         * page_config* */
        $this->page_config['title'] = 'Invoice Bills'; //search title bar
        $this->page_config['searchFields'] = 'invoice_ID,'
                . 'customer_package,'
                . 'invoice_for,'
                . 'invoice_date,'
                . 'customer_address,'
                . 'customer_code,'
                . 'customer_name,'
                . 'customer_area'; //search box,
        //$this->page_config['default_search_value']['invoice_for'] = date('-');
        $this->page_config['list_columns'] = 'invoice_ID,customer_code,customer_name,invoice_date,invoice_for,invoice_billed_amount';
        /*         * end page_config* */
    }

    public function customer_list() {
        $data = $this->cable_customers_model->get_list_for_dropdown();
        $returndata = null;
        foreach ($data as $key => $value) {
            if ($value['customer_is_free'] == 1 || $value['customer_status'] != 1)
                continue;
            $returndata[$key] = $value['customer_name'] . '(' . $value['customer_code'] . ')';
        }
        return $returndata;
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
        unset($entryData['invoice_meta']); //suggestion: giving a print button
        echo $this->generate_detail_view($entryData, $this->page_config);
    }

    public function migrate() {
        /*         * *************** invoice and collections************* */
        $datax = $this->db->query('select * from simplebillings_migrate.invoices')->result_array();
        $this->db->query('TRUNCATE invoices;');
        $this->db->query('TRUNCATE collections;');
        foreach ($datax as $datay) {
            $data = json_decode($datay['invoice_meta'], true);
            $invoice['invoice_customer'] = $datay['invoice_customer'];

            $invoice['invoice_date'] = $datay['invoice_date'];
            $total = 0.00;
            $billingData = null;
            $statement_for = $data['customer_invoice_for_month'];
            if (empty($statement_for)){
                //pr($datay, 1);
                continue;
            }
            if ($data['customer_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-') . $data['customer_due_date_of_month'];
            }

            $packages = $data['packages'];

            foreach ($packages as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['package_name'] . ' for ' . $statement_for,
                    'cost' => (float) $valuex['package_rate']
                );
                $total += (float) $valuex['package_rate'];
            }

            $adons = $data['adons'];
            foreach ($adons as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['channel_name'],
                    'cost' => (float) $valuex['channel_rate']
                );
                $total += (float) $valuex['channel_rate'];
            }

            $taxtotal = 0.00;
            /*             * ********************
              foreach ($taxes as $value) {
              if ($value['tax_type'] == 0) {
              $billingData[] = array(
              'name' => $value['tax_name'] . ' (' . $value['tax_value'] . '%)',
              'cost' => (float) $value['tax_value'] * $total / 100
              );
              $taxtotal += (float) $value['tax_value'] * $total / 100;
              } else {
              $billingData[] = array(
              'name' => $value['tax_name'] . ' (' . $value['tax_value'] . ')',
              'cost' => (float) $value['tax_value']
              );
              $taxtotal += (float) $value['package_rate'];
              }
              }
             * ************** */
            $invoice_meta['billings'] = $billingData;
            $invoice_meta['total'] = $taxtotal + $total;
            $invoice['invoice_billed_amount'] = $taxtotal + $total;
            $invoice['invoice_tax_amount'] = $taxtotal;
            $invoice['invoice_note'] = 'Migrated';
            $invoice['invoice_for'] = $statement_for;
            $invoice['invoice_meta'] = json_encode($invoice_meta);
            $this->cable_invoices_model->insert_data($invoice);

            $collection['collection_collected_by'] = $data['invoice_collected_by'];
            $collection['collection_customer'] = $invoice['invoice_customer'];
            $collection['collection_note'] = 'Migrated Data';
            $collection['collection_amount'] = $data['invoice_paid_amount'];
            $collection['collection_date'] = $data['invoice_collection_date'];
            $collection['collection_for'] = $invoice['invoice_for'];
           if($collection['collection_amount']!=0){
             $this->cable_collections_model->insert_data($collection);
           }
        }
        redirect('/console/inventory/migrate/');
    }

}

?>
