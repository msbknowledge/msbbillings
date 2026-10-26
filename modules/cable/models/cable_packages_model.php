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
class Cable_packages_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='cable_packages';
		$this->check();
    }
     public function install() {
        $query = $this->db->query("CREATE TABLE `cable_packages` (
		  `package_ID` int(11) NOT NULL AUTO_INCREMENT,
		 `package_name` varchar(50) DEFAULT NULL,
  `package_rate` decimal(10,2) DEFAULT NULL,
  `package_cost_inclusive_tax` decimal(10,2) NOT NULL,
		  PRIMARY KEY (`package_ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
		");
    }
   
}

?>
