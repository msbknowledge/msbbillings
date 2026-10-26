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
class Packages_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='packages';
		$this->check();
    }
     public function install() {
        $query = $this->db->query("CREATE TABLE `packages` (
 `package_ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `package_name` varchar(50) DEFAULT NULL,
  `package_rate` varchar(45) DEFAULT NULL,
  `package_channel_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
    }
    /**
     * get the list of all data in table 
     */
   
}

?>
