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
class Return_sale_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'returns_sales';
        $this->joiningArray[1]['table'] = 'customers';
        $this->joiningArray[1]['condition'] = 'return_sale_customer = customer_id';
        $this->check();
    }
    public function install() {
        $query = $this->db->query("CREATE TABLE `returns_sales` (
        `return_sale_ID` int(11) NOT NULL,
        `return_sale_invoice` varchar(20) NOT NULL,
        `return_sale_entry_number` int(11) NOT NULL,
        `return_sale_date` date NOT NULL,
        `return_sale_customer` varchar(100) NOT NULL,
        `return_sale_medicine` varchar(50) NOT NULL,
        `return_sale_expire_month` int(2) NOT NULL,
        `return_sale_expire_year` int(2) NOT NULL,
        `return_sale_mrp` decimal(10,0) NOT NULL,
        `return_sale_strip` int(11) NOT NULL,
        `return_sale_total` decimal(10,0) NOT NULL,
        `return_sale_ref` text NOT NULL,
        `return_sale_HSN` int(20) NOT NULL,
        `return_sale_Batch` varchar(10) NOT NULL,
        PRIMARY KEY (`return_sale_ID`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
        ");
    }
}