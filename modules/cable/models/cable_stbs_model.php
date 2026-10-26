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
class Cable_stbs_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='cable_stbs';
		$this->check();
    }
     public function install() {
         
       $query = $this->db->query("CREATE TABLE `cable_stbs` (
  `stb_ID` int(10) NOT NULL AUTO_INCREMENT ,
  `stb_vc` varchar(100) NOT NULL,
  `stb_no` varchar(100) NOT NULL,
  `stb_mso` varchar(100) NOT NULL,
  `stb_type` varchar(50) NOT NULL,
  PRIMARY KEY (`stb_ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");
    }
    
}

?>
