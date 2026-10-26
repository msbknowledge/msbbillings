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
class Parts_invoice extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->moduleMeta = array('parts' => 'Part Invoice');
        //$this->page_config['use_status_columns'] = 'invoice_status';
        $this->targetModel = 'parts_invoices_model';
        $this->load->model($this->targetModel);
        $this->load->model('taxes_model');
        $this->page_config['use_dropdown_columns'] = 'part_customer_id';
        $this->page_config['use_dropdown_columns_options']['part_customer_id'] = $this->customers_model->get_list_for_dropdown('customer_name');


        $this->page_config['tablePrimaryKey'] = $this->parts_invoices_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Parts_invoices'; //search title bar
        $this->page_config['searchFields'] = 'part_invoice_ID,customer_name,customer_code,part_invoice_no,invoice_collection_date'; //search box,
        $this->page_config['list_columns'] = 'part_invoice_ID,customer_code,customer_name,invoice_collection_date,invoice_billed_amount';
        /*         * end page_config* */
    }

    public function extra_bill() {
        echo "down for maintainence";
    }

    public function fast_bill() {
        error_reporting(1);
        $generated = $this->input->post();
        if ($this->input->post()) {
            $generated['invoice_collection_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $generated['invoice_collection_date'])));
            $generated['invoice_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $generated['invoice_date'])));
            $generated['part_invoice_meta'] = json_encode($generated);
            $fields = $this->parts_invoices_model->get_field_list();
            $generatedinsertedData = array_intersect_key($generated, $fields[0]);
            $part_data = json_decode($generatedinsertedData['part_invoice_meta'], true);
            $this->part_inventory_calc($part_data);
            $invoice_ID = $this->parts_invoices_model->insert_data($generatedinsertedData);
            redirect(console_url('parts_invoice/print_receipt/' . $invoice_ID));
        } else {
            $this->render(null, 'console/invoice/fast_bill_tpl');
        }
    }

    public function part_inventory_calc($part_data = array()) {
        $this->load->model('parts_model');
        foreach ($part_data['part_name'] as $key => $val):
            $inventory_data[$key]['quantity'] = $part_data['part_qty'][$key];
            $inventory_data[$key]['part'] = $part_data['part_name'][$key];
        endforeach;
        foreach ($inventory_data as $key => $value):
            $previous_stock = $this->parts_model->get_list(array('part_name' => $inventory_data[$key]['part']));
            $deducted_stock[$key] = $previous_stock[0]['part_inventory_stock'] - $inventory_data[$key]['quantity'];
            $this->db->query("update parts set `part_inventory_stock`=".$deducted_stock[$key]." where `part_name`='".$inventory_data[$key]['part']."'");
        endforeach;
    
    }

    public function index() {
        $orderBy = $this->orderby_input_process();
        $condition = null;
        $likeCondition = $this->generate_search_like_condition();

        if (!empty($likeCondition['customer_code'])) {
            $likeCondition['customer_code'] = trim($likeCondition['customer_code']);
        }

        if (empty($likeCondition['invoice_collection_date'])) {
            unset($likeCondition['invoice_collection_date']);
        }

        $allData = $this->{$this->targetModel}->get_list_for_tables($condition, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'invoice/table_tpl');
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }
 public function print_receipt() {
         $template = get_option('invoice_template');
         if($template!='template_two'){
        $this->load->view('console/invoice/print_header_tpl');
         }
        $invoices = $this->input->post('selectedItem');
        $invoice_ID = $this->uri->segment(4);
       /* $taxes = $this->taxes_model->get_list();
        foreach ($taxes as $tax) {
            $tx[$tax['tax_name']] = $tax['tax_value'];
            $tx['type'] = $tax['tax_type'];
        }*/
        if (!empty($invoice_ID)) {
            $invoices = array($invoice_ID);
        }

        if ($invoices != NULL)
            foreach ($invoices as $key => $invoice) {
                 $invoice = $this->parts_invoices_model->get_list(array('part_invoice_id' => $invoice));
                #pr($invoice,1);
                $completeData = array_merge( json_decode($invoice[0]['part_invoice_meta'], TRUE), $invoice[0]);
                /* $calc = $this->taxes_model->calulate_tax($completeData['total']);
                        foreach ($calc['taxes'] as $tax) {
                            $completeData['tax'][$tax['tax_name']] = $calc[$tax['tax_name']];
                        }
               /* if (!isset($completeData['tax']))
                    if (!isset($completeData['taxes'])) {
                        $calc = $this->taxes_model->calulate_tax($completeData['total']);
                        foreach ($calc['taxes'] as $tax) {
                            $completeData['tax'][$tax['tax_name']] = $calc[$tax['tax_name']];
                        }
                    }*/
                $completeData['customer_name'] = $invoice[0]['customer_name'];
                $completeData['invoice_paid_amount'] = $invoice[0]['invoice_paid_amount'];
                $completeData['invoice_collection_date'] = $invoice[0]['invoice_collection_date'];
                $completeData['total_with_previous_due'] = round($invoice[0]['invoice_billed_amount']);
                               #pr($completeData,1);

				#$invoice_last_data_customer= $this->db->query('SELECT * FROM `parts_invoices` WHERE part_customer_id='.$completeData['part_customer_id'].' ORDER BY part_invoice_id DESC LIMIT 1 ')->result_array();
               # $this->load->view('console/invoice/print_template_two_tpl', array('customerData' => $completeData));                
                  switch (true) {
                  case ($template=='template_one'):
                  $this->load->view('console/invoice/print_reciept_tpl', array('customerData' => $completeData));

                  break;

                  case ($template=='template_two'):
                  $this->load->view('console/invoice/print_template_two_tpl', array('customerData' => $completeData,'last_data'=>$invoice_last_data_customer));

                  break;

                  default:
                  $this->load->view('console/invoice/print_reciept_tpl', array('customerData' => $completeData));

                  break;
                  }


                 
            }
    }

    

    /**
     * edit detail
     */
    public function edit_detail() {
        $postedData = $this->input->post();
        $this->page_config['validation'] = array('required' => array('invoice_collection_date'));
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            //pr($entryData);
            echo $this->generate_form_view($entryData, $this->page_config, 'invoice/add_edit_tpl');
        } else {
            if ($postedData) {
                if (empty($postedData['invoice_collection_date'])) {
                    $postedData['invoice_collection_date'] = date('Y-m-d');
                }
                $postedData['invoice_collection_date'] = date('Y-m-d', strtotime($postedData['invoice_collection_date']));
                $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['invoice_ID'])));
                $entryData1 = $this->{$this->targetModel}->get_field_list();

                $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
                $part_invoice_meta = json_decode($entryData['part_invoice_meta'], true);

                $final = array_merge($entryData, $postedData);
                unset($final['part_invoice_meta']);
                $final_meta = array_merge($part_invoice_meta, $final);
                $final['part_invoice_meta'] = json_encode($final_meta);
                $this->{$this->targetModel}->update_data($final, array($this->page_config['tablePrimaryKey'] => $postedData[$this->page_config['tablePrimaryKey']]));
                echo translateIt(json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

}

?>
