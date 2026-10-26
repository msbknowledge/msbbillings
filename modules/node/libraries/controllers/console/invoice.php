<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of home
 *
 * @author Kallol
 */
class Invoice extends MY_Controller {
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->moduleMeta = array('cables' => 'Invoice');
        $this->targetModel = 'invoices_model';
        $this->load->model($this->targetModel);
        $this->page_config['use_dropdown_columns'] = 'invoice_customer,customer_agent';
        $this->page_config['use_dropdown_columns_options']['invoice_customer'] = $this->customer_list();
        if ($this->current_user_session['user_type_super'] == 1)
            $this->allowed_action = array('delete', 'view_detail');


        $this->page_config['tablePrimaryKey'] = $this->invoices_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Invoice Bills'; //search title bar
        $this->page_config['searchFields'] = 'invoice_ID,'
                . 'invoice_date,'
                . 'customer_address,customer_code,'
                . 'customer_name'; //search box,
        //$this->page_config['default_search_value']['invoice_for'] = date('-');
        $this->page_config['list_columns'] = 'invoice_ID,invoice_for,customer_name,invoice_date,invoice_billed_amount,invoice_tax_amount';
        /*         * end page_config* */
    }
     public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
       
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function customer_list() {
        $data = $this->customers_model->get_list_for_dropdown();
        $returndata = null;
        foreach ($data as $key => $value) {
            if ($value['customer_is_free'] == 1 || $value['customer_status'] != 1)
                continue;
            $returndata[$key] = $value['customer_name'] . '(' . $value['customer_code'] . ')';
        }
        return $returndata;
    }

    /**
     * add detail
     */
    public function add_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config, 'add_edit_tpl');
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

    /**
     * edit detail
     */
    public function edit_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
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
            if (empty($statement_for)) {
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
           // $invoice['invoice_for'] = $statement_for;
            $invoice['invoice_meta'] = json_encode($invoice_meta);
            $this->invoices_model->insert_data($invoice);

            $collection['collection_collected_by'] = $data['invoice_collected_by'];
            $collection['collection_customer'] = $invoice['invoice_customer'];
            $collection['collection_note'] = 'Migrated Data';
            $collection['collection_amount'] = $data['invoice_paid_amount'];
            $collection['collection_date'] = $data['invoice_collection_date'];
            $collection['collection_for'] = $invoice['invoice_for'];
            if ($collection['collection_amount'] != 0) {
                $this->collections_model->insert_data($collection);
            }
        }
        redirect('/console/inventory/migrate/');
    }
    public function print_bill() {
       $postedData = $this->input->post();
  //pr($postedData,1);
    $data= $postedData['selectedItem'];
       //$data=array(566,568);
        $string= implode(',', $data);
       $output=$this->db->query("select * from invoices where invoice_ID in ($string)")->result_array();
       //pr($data,1); 
       foreach ($output as $key =>$value){
        $invoice_data = $this->invoices_model->get_list(array('invoice_date' => $value['invoice_date'], 'invoice_customer' =>$value['invoice_customer'] ));
        $data = $this->customers_model->account_statement($value['invoice_customer'], $value['invoice_date']);
        $this->load->view('console/customer/print_template_invoice_tpl', array('invoice' => $value, 'data' => $data, 'date' => $value['invoice_date']));
       }
    }

}

?>
