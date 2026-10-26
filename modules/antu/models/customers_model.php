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
        `doctor_name` varchar(50) DEFAULT NULL,
        `email` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`customer_ID`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");

        $this->db->query("INSERT INTO `options` (`option_ID`, `option_key`, `option_value`) VALUES
            (45, 'invoice_number','TEST/[{year}]/[{number}]'),
            (46, 'provider_name',''),
            (47, 'provider_address',''),
            (48, 'provider_gst',''),
            (49, 'provider_mobile',''),
            (50, 'provider_landline',''),
            (51, 'provider_dl',''),
            (52, 'provider_bcda_no',''),
            (53, 'purchase_last_count',''),
            (54, 'expiry_last_count','');
            ");
        }

}

?>
