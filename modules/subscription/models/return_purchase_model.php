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
class Return_purchase_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'return_purchases';
        $this->joiningArray[1]['table'] = 'suppliers';
        $this->joiningArray[1]['condition'] = 'return_purchase_supplier = supplier_id';
        $this->check();
    }
    public function install() {
         $query = $this->db->query("CREATE TABLE `return_purchases` (
 `return_purchase_ID` int(11) NOT NULL,
  `return_purchase_entry_number` int(11) NOT NULL,
  `return_purchase_date` date NOT NULL,
  `return_purchase_supplier` varchar(100) NOT NULL,
  `return_purchase_product` varchar(50) NOT NULL,
  `return_purchase_expire_month` int(2) NOT NULL,
  `return_purchase_expire_year` int(2) NOT NULL,
  `return_purchase_mrp` decimal(10,2) NOT NULL,
  `return_purchase_strip` int(11) NOT NULL,
  `return_purchase_total` decimal(10,2) NOT NULL,
  `return_purchase_ref` text NOT NULL,
  `return_purchase_HSN` int(20) NOT NULL,
  `return_purchase_Batch` varchar(10) NOT NULL,
           PRIMARY KEY (`return_purchase_ID`)
                 ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
                 ");
    }
}