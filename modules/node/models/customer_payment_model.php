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
class Customer_payment_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'customer_payments';
        $this->joiningArray[0]['table'] = 'customers';
        $this->joiningArray[0]['condition'] = 'customer_payment_customer = customer_ID';
        $this->check();
    }

     public function install() {
      $this->db->query("CREATE TABLE `customer_payments` (
              `customer_payment_ID` int(11) NOT NULL AUTO_INCREMENT,
              `customer_payment_customer` int(11) NOT NULL,
              `customer_payment_date` date NOT NULL,
              `customer_payment_paid_amount` decimal(10,2) NOT NULL,
              `customer_payment_note` text NOT NULL,
              `customer_payment_invoice` int(11) NOT NULL,
             PRIMARY KEY (`customer_payment_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
        ");
   
    }
     public function insert_data($dataToInsert, $isMulti = FALSE) {
        foreach ($dataToInsert as $key => $value) {
            $dataToInsert[$key] = strtoupper($value);
        }
        $this->db->cache_delete_all();
        if ($isMulti) {
            return $this->db->insert_batch($this->table_name, $dataToInsert);
        } else {
            $this->db->insert($this->table_name, $dataToInsert);
            return $this->db->insert_id();
        }
    }

}
