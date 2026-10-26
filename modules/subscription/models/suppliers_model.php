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
class Suppliers_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'suppliers';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(200) NOT NULL,
  `supplier_contact` varchar(200) NOT NULL,
  `supplier_gst` varchar(50) NOT NULL,
 PRIMARY KEY (`supplier_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
        $this->db->query("INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`, `supplier_gst`) VALUES
(5, '3A SOLUTION', 'Lake Town', '9874563210', '5514'),
(6, 'LOGICMYSTERY', 'Syamnagar', '0123456789', '5524');");
        
    }

        public function insert_data($dataToInsert, $isMulti = FALSE) {
        foreach ($dataToInsert as $key => $value) {
            $dataToInsert[$key] = strtoupper($value);
        }
        $this->db->cache_delete_all();
        if ($isMulti) {
            return $this->db->insert_batch($this->table_name, $dataToInsert);
        } else {
            $this->db->insert($this->table_name, $dataToInsert);
            return $this->db->insert_id();
        }
    }
}

?>
