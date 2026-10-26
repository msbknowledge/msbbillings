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
class Complain_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'complains';
        $this->check();
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `complains` (
  `complain_ID` int(11) NOT NULL,
  `complain_date` date NOT NULL,
  `complain_service` varchar(100) NOT NULL,
  `complain_type` varchar(100) NOT NULL,
  `complain_from_customer` varchar(100) NOT NULL,
  `complain_status` varchar(100) NOT NULL,
  `complain_assign_to` varchar(100) NOT NULL,
  `complain_note` text NOT NULL,
  `complain_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        $this->db->query("ALTER TABLE `complains`
  ADD PRIMARY KEY (`complain_ID`);");
        $this->db->query("ALTER TABLE `complains`
  MODIFY `complain_ID` int(11) NOT NULL AUTO_INCREMENT;");
    }

}

?>
