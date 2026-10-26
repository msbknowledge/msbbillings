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
class Invoices_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'invoices';
        $this->joiningArray[0]['table'] = 'lcos';
        $this->joiningArray[0]['condition'] = 'invoice_lco = lco_id';
        $this->joiningArray[0]['type'] = 'left';
        $this->check();
    }
    public function install() {
        $query = $this->db->query(" CREATE TABLE `invoices` (
        `invoice_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `invoice_lco` varchar(255) NOT NULL,
        `invoice_date` date NOT NULL,
        `invoice_period` varchar(20) DEFAULT NULL,
        `invoice_billed_amount` decimal(10,2) DEFAULT NULL DEFAULT '0.00',
        `invoice_meta` text default null
       )ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    }
   
}

?>
