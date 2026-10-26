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
class Payments_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'payments';
        $this->check();
    }

    public function install() {
      $this->db->query("CREATE TABLE `payments` (
  `payment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `payment_suppliers` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_paid_amount` decimal(10,2) NOT NULL,
  `payment_note` text NOT NULL,
  `payment_invoice` int(11) NOT NULL,
 PRIMARY KEY (`payment_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
");
   
    }

}

?>
