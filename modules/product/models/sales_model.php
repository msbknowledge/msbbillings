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
class Sales_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'sales';
        $this->joiningArray[0]['table'] = 'products';
        $this->joiningArray[1]['table'] = 'customers';
        $this->joiningArray[2]['table'] = 'doctors';
        $this->joiningArray[0]['condition'] = 'sale_product_id = product_id';
        $this->joiningArray[1]['condition'] = 'sale_customer = customer_ID';
        $this->joiningArray[2]['condition'] = 'sale_doctor = doctor_ID';
        $this->check();
    }

    public function install() {
      $this->db->query("CREATE TABLE `sales` (
  `sale_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sale_invoice` varchar(20) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_customer` varchar(100) NOT NULL,
  `sale_doctor` varchar(100) NOT NULL,
  `sale_strip_quantity` int(11) NOT NULL DEFAULT '0',
  `sale_loose_quantity` int(11) NOT NULL,
  `sale_product_id` int(11) NOT NULL,
  `sale_batch` varchar(11) NOT NULL,
  `sale_expire_month` int(11) NOT NULL,
  `sale_expire_year` int(11) NOT NULL,
  `sale_mrp` decimal(10,2) NOT NULL,
  `sale_rate` decimal(10,3) NOT NULL,
  `sale_discount_percent` decimal(10,2) NOT NULL,
  `sale_discount` decimal(10,2) NOT NULL,
  `sale_taxable` decimal(10,2) NOT NULL,
  `sale_cgst_percent` decimal(10,2) NOT NULL,
  `sale_sgst_percent` decimal(10,2) NOT NULL,
  `sale_sgst` decimal(10,2) NOT NULL,
  `sale_cgst` decimal(10,2) NOT NULL,
  `sale_total` decimal(10,2) NOT NULL,
  `sale_return` tinyint(1) NOT NULL,
  `sale_return_date` date NOT NULL,
  `sale_total_previous_due` decimal(10,2) NOT NULL,
  `sale_total_paid` decimal(10,2) NOT NULL,
  `sale_total_current_due` decimal(10,2) NOT NULL,
  `sale_paid_by` varchar(100) NOT NULL,
  `sale_note` text NOT NULL,
  `sale_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`sale_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
      
     
    }

}

?>
