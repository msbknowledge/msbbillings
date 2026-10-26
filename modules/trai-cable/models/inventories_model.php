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
class Inventories_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'inventories';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `inventories` (
  `inventory_id` int(100) NOT NULL,
  `inventory_name` varchar(100) NOT NULL,
  `inventory_code` varchar(100) DEFAULT NULL,
  `inventory_inventory_stock` int(50) NOT NULL,
  `inventory_unit_price` decimal(10,2) NOT NULL,
  `inventory_type` varchar(10) NOT NULL COMMENT '" . DIGITAL . "," . PHYSICAL . "'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


        $this->db->query("INSERT INTO `inventories` (`inventory_id`, `inventory_name`, `inventory_code`, `inventory_inventory_stock`, `inventory_unit_price`, `inventory_type`) VALUES
(1, 'REMOTE', ' ', 20, '120.00', 'PHYSICAL'),
(6, 'ADAPTER', ' ', 20, '120.00', 'PHYSICAL'),
(7, 'AV CORD', ' ', 20, '40.00', 'PHYSICAL'),
(8, 'REMOTE N', '', 20, '130.00', 'PHYSICAL'),
(9, 'REMOTE N1', '', 20, '150.00', 'PHYSICAL');");
        $this->db->query("ALTER TABLE `inventories`
  ADD PRIMARY KEY (`inventory_id`);");
        $this->db->query("ALTER TABLE `inventories`
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
    }

    public function inventory_search_data($term) {
        $data = $this->db->query("SELECT * FROM `inventories` where `inventory_name` like '%" . $term . "%'")->result_array();
        return $data;
    }

}

?>
