<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_settings_model
 *
 * @author kALLOL
 * 
 * 
 */
class Customers_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'customers';
        $this->joiningArray[0]['table'] = 'customer_payments';
        $this->joiningArray[0]['condition'] = 'customer_payment_customer = customer_ID';
        $this->check();
    }

 public function account_statement($customer_id, $invoice_date) {
    
    
        $customer = $this->get_list(array('customer_ID' =>$customer_id ));
        $data['total_invoice_amount_till_date'] = $this->db->query("SELECT sum(invoice_billed_amount)as invoice_bill FROM `invoices` WHERE invoice_date <='" . $invoice_date . "' AND invoice_customer=" . $customer[0]['customer_ID'])->result_array();
       
        $data['total_collection_amount_till_date'] = $this->db->query("SELECT sum(collection_amount)as collected_bill FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer=" . $customer[0]['customer_ID'])->result_array();
        
        $data['last_collection_data'] = $this->db->query("SELECT * FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer=" . $customer[0]['customer_ID'] . " ORDER BY collection_date limit 0,3")->result_array();
      

        $data['customerData'] = $customer[0];
       
        return $data;
    }
    
}

?>
