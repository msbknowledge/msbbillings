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
class Network_capacity_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='network_capacity';
		$this->check();
    }
     public function install() {
        $query = $this->db->query("CREATE TABLE `network_capacity` (
 `network_capacity_ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `network_capacity_name` varchar(50) DEFAULT NULL,
  `network_capacity_rate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
    }
    /**
     * get the list of all data in table 
     */
   
}

?>
