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
        $this->check();
    }

    public function install() {
       # $this->db->query("");
        $this->db->query("CREATE TABLE `customers` (
  `customer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_address` varchar(200) DEFAULT NULL,
  `customer_contact` varchar(15) NOT NULL,
  `customer_gst` varchar(50) NOT NULL,
  `customer_due` decimal(10,2) NOT NULL,
   PRIMARY KEY (`customer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
        $this->db->query("INSERT INTO `customers` (`customer_ID`, `customer_name`, `customer_address`, `customer_contact`, `customer_gst`, `customer_due`) VALUES
(823, 'kallol', 'kestpur', '9903700769', '', '-10.00'),
(824, 'KALLOL', 'KESTPUR', '9903700769', '1122334', '300.00'),
(825, 'KALLOL', 'KESTPUR', '9903700769', 'BLA', '0.00'),
(826, 'AYANTICA', 'KESTOPUR', '8900642020', '', '0.00');");
       
        
     
    }

}

?>
