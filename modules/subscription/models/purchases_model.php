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
class Purchases_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'purchases';
        $this->joiningArray[0]['table'] = 'products';
        $this->joiningArray[1]['table'] = 'suppliers';
        $this->joiningArray[0]['condition'] = 'purchase_product_id = product_id';
        $this->joiningArray[1]['condition'] = 'purchase_supplier = supplier_id';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `purchases` (
   `purchase_ID` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_entry_number` int(11) NOT NULL,
  `purchase_invoice` varchar(20) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_supplier` varchar(100) NOT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `purchase_free_quantity` int(11) NOT NULL,
  `purchase_product_id` int(11) NOT NULL,
  `purchase_batch` varchar(20) NOT NULL,
  `purchase_unit` varchar(10) NOT NULL,
  `purchase_expire_month` int(2) NOT NULL,
  `purchase_expire_year` int(2) NOT NULL,
  `purchase_mrp` decimal(10,2) NOT NULL,
  `purchase_rate` decimal(10,2) NOT NULL,
  `purchase_discount_percent` decimal(10,2) NOT NULL,
  `purchase_taxable` decimal(10,2) NOT NULL,
  `purchase_cgst_percent` decimal(10,2) NOT NULL,
  `purchase_cgst` decimal(10,2) NOT NULL,
  `purchase_sgst_percent` decimal(10,2) NOT NULL,
  `purchase_sgst` decimal(10,2) NOT NULL,
  `purchase_total` decimal(10,2) NOT NULL,
  `purchase_return` tinyint(1) NOT NULL DEFAULT '0',
  `purchase_return_date` date NOT NULL,
  PRIMARY KEY (`purchase_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
       $this->db->query("INSERT INTO `purchases` (`purchase_ID`, `purchase_invoice`, `purchase_date`, `purchase_supplier`, `purchase_quantity`, `purchase_free_quantity`, `purchase_product_id`, `purchase_batch`, `purchase_unit`, `purchase_expire_month`, `purchase_expire_year`, `purchase_mrp`, `purchase_rate`, `purchase_discount_percent`, `purchase_taxable`, `purchase_cgst_percent`, `purchase_cgst`, `purchase_sgst_percent`, `purchase_sgst`, `purchase_total`, `purchase_return`, `purchase_return_date`) VALUES
(136, 'AAA0001', '2017-08-17', '5', 20, 5, 5, 'aaa01', '10', 8, 18, 150, '140.00', '2.00', '2744.00', '6.00', '164.64', '6.00', '164.64', '3073.28', 0, '0000-00-00');");
      
    }

}

?>
