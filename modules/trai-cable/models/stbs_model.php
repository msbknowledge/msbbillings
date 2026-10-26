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
class Stbs_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'stbs';
        $this->check();
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `stbs` (
             `stb_ID` int(11) NOT NULL AUTO_INCREMENT,
  `stb_vc` varchar(50) NOT NULL,
  `stb_no` varchar(50) NOT NULL,
  `stb_mso` varchar(50) NOT NULL,
  `stb_type` varchar(50) NOT NULL,
		  PRIMARY KEY (`stb_ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
		");
    }

    /**
     * get the list of all data in table 
     */
}

?>
