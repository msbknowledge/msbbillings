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
class lcos_model extends MY_Model {
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'lcos';
        $this->check();
    }
    public function install() {
        $query = $this->db->query(" CREATE TABLE `lcos` (
        `lco_id` int(11) AUTO_INCREMENT PRIMARY KEY,
        `lco_code` varchar(30) NOT NULL,
        `lco_name` varchar(50) NOT NULL,
        `lco_address` varchar(200) NOT NULL,
        `lco_contact_person` varchar(50) NOT NULL,
        `lco_stb_active_no` int(11) NOT NULL,
        `lco_email` varchar(100) DEFAULT NULL,
        `lco_gstin` varchar(20) NOT NULL
       )ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    }
   
}
?>