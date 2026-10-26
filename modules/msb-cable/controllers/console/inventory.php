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
class Inventory extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'inventories_model';
        $this->load->model($this->targetModel);
        $this->load->model('taxes_model');
        $this->page_config['use_dropdown_columns'] = 'inventory_type';
        $this->page_config['use_dropdown_columns_options']['inventory_type'] = array("DIGITAL" => "Digital Product", "PHYSICAL" => "Physical Product");

        $this->page_config['tablePrimaryKey'] = $this->inventories_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Inventory'; //search title bar
        $this->page_config['searchFields'] = 'inventory_name,inventory_code,inventory_type,inventory_unit_price'; //search box,
        $this->page_config['list_columns'] = 'inventory_name,inventory_code,inventory_type,inventory_unit_price,inventory_inventory_stock';
        /*         * end page_config* */
    }

    public function inventory_search_by_name() {

        $term = $this->input->get('term');
        $inventory_data = $this->inventories_model->inventory_search_data($term);
        $data = null;
        foreach ($inventory_data as $key => $val) {
            $data[$key]['id'] = $val['inventory_id'];
            $data[$key]['label'] = $val['inventory_name'];
            $data[$key]['value'] = $val['inventory_name'];
            $data[$key]['amount'] = $val['inventory_unit_price'];
        }

        echo json_encode($data);
    }

    public function migrate() {
        /*         * *************** invoice and collections************* */
        $datax = $this->db->query('select * from simplebillings_migrate.parts_invoices')->result_array();
        foreach ($datax as $datay) {
            $data = json_decode($datay['part_invoice_meta'], true);
            $invoice['invoice_customer'] = $datay['part_customer_id'];

            $invoice['invoice_date'] = $datay['invoice_collection_date'];
            $total = 0.00;
            $billingData = null;
            $statement_for = 'Inventory-Billing';
            if (empty($statement_for))
                if ($data['customer_due_date_of_month'] == 0) {
                    $invoice['invoice_due_date'] = $invoice['invoice_date'];
                } else {
                    $invoice['invoice_due_date'] = Date('Y-m-') . $data['customer_due_date_of_month'];
                }
            foreach ($data['part_name'] as $k => $valuex) {
                $billingData[] = array(
                    'name' => $data['part_name'][$k],
                    'cost' => (float) $data['part_amount'][$k]
                );
                $total += (float) $data['part_amount'][$k];
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
            //pr($invoice,1);
            $this->invoices_model->insert_data($invoice);

            $collection['collection_collected_by'] = $data['invoice_collected_by'];
            $collection['collection_customer'] = $invoice['invoice_customer'];
            $collection['collection_note'] = 'Migrated Data';
            $collection['collection_amount'] = $data['invoice_paid_amount'];
            $collection['collection_date'] = $data['invoice_collection_date'];
            $collection['collection_for'] = $invoice['invoice_for'];
            if ($data['invoice_paid_amount'] != 0)
                $this->collections_model->insert_data($collection);
        }
        echo 'Migration Complete';
    }

}

?>
