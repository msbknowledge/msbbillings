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
class Doctors_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'doctors';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `doctors` (
  `doctor_ID` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(50) DEFAULT NULL,
  `doctor_address` varchar(200) DEFAULT NULL,
  `doctor_contact` varchar(15) NOT NULL,
   PRIMARY KEY (`doctor_ID`)
)  ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
       $this->db->query("INSERT INTO `doctors` (`doctor_ID`, `doctor_name`, `doctor_address`, `doctor_contact`) VALUES
(3, 'Dr REDDY', 'Kolkata', '369874125'),
(4, 'Dr BATRA', 'Kolkata', '147896325');");
       
    }

}

?>
