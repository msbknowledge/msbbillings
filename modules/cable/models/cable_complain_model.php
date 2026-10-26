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
class Cable_complain_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'cable_complains';
        $this->check();
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `cable_complains` (
  `complain_ID` int(11) NOT NULL AUTO_INCREMENT,
  `complain_date` date NOT NULL,
  `complain_service` varchar(100) NOT NULL,
  `complain_type` varchar(100) NOT NULL,
  `complain_from_customer` varchar(100) NOT NULL,
  `complain_status` varchar(100) NOT NULL,
  `complain_assign_to` varchar(100) NOT NULL,
  `complain_note` text NOT NULL,
  `complain_description` text NOT NULL,
   PRIMARY KEY (`complain_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");

}

}

?>
