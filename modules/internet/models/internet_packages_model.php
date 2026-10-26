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
class Internet_packages_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='internet_packages';
		$this->check();
    }
     public function install() {
        $query = $this->db->query("CREATE TABLE `internet_packages` (
  `package_ID` int(11) NOT NULL AUTO_INCREMENT,
 `package_name` varchar(50) DEFAULT NULL,
  `normal_bandwidth` varchar(20) NOT NULL,
  `streaming_and_peering_bandwidth` varchar(20) NOT NULL,
  `package_rate` varchar(45) DEFAULT NULL,
  `package_cost_inclusive_tax` decimal(10,2) NOT NULL,
  `package_subscription_days` int(11) NOT NULL,
  PRIMARY KEY (`package_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
       
       
    }
    /**
     * get the list of all data in table 
     */
   
}

?>
