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
class Expiry_return_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'expiry_returns';
        $this->joiningArray[1]['table'] = 'suppliers';
        $this->joiningArray[1]['condition'] = 'expiry_return_supplier = supplier_id';
        $this->check();
    }
        public function install() {
        $query = $this->db->query("CREATE TABLE `expiry_returns` (
        `expiry_return_ID` int(11) NOT NULL,
        `expiry_return_entry_number` int(11) NOT NULL,
        `expiry_return_date` date NOT NULL,
        `expiry_return_supplier` varchar(100) NOT NULL,
        `expiry_return_medicine` varchar(50) NOT NULL,
        `expiry_return_expire_month` int(2) NOT NULL,
        `expiry_return_expire_year` int(2) NOT NULL,
        `expiry_return_mrp` decimal(10,2) NOT NULL,
        `expiry_return_strip` int(11) NOT NULL,
        `expiry_return_total` decimal(10,2) NOT NULL,
        `expiry_return_ref` text NOT NULL,
        `expiry_return_HSN` int(20) NOT NULL,
        `expiry_return_Batch` varchar(10) NOT NULL,
        PRIMARY KEY (`expiry_return_ID`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
        ");
        }
}