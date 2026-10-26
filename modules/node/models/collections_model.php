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
class Collections_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'collections';
        $this->joiningArray[0]['table'] = 'customers';
        $this->joiningArray[0]['condition'] = 'collection_customer = customer_ID ';
        $this->check();
    }

    public function install() {
        $query = $this->db->query(" CREATE TABLE `collections` (
        `collection_ID` int(11) NOT NULL AUTO_INCREMENT,
      `collection_collected_by` varchar(100) DEFAULT NULL,
      `collection_for` varchar(100) NOT NULL,
      `collection_customer` varchar(255) NOT NULL,
      `collection_date` date DEFAULT NULL,
      `collection_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
      `collection_note` text NOT NULL,
      `collection_entry_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`collection_ID`)
       )ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");
    }

}

?>
