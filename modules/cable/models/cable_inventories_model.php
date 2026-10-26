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
class Cable_inventories_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'cable_inventories';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `cable_inventories` (
  `inventory_ID` int(100) NOT NULL AUTO_INCREMENT,
  `inventory_name` varchar(100) NOT NULL,
  `inventory_code` varchar(100) DEFAULT NULL,
  `inventory_inventory_stock` int(50) NOT NULL,
  `inventory_unit_price` decimal(10,2) NOT NULL,
  `inventory_type` varchar(10) NOT NULL COMMENT '" . DIGITAL . "," . PHYSICAL . "',
 PRIMARY KEY (`inventory_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


       
        
    }

    public function inventory_search_data($term) {
        $data = $this->db->query("SELECT * FROM `cable_inventories` where `inventory_name` like '%" . $term . "%'")->result_array();
        return $data;
    }

}

?>
