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
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `code` varchar(30) NOT NULL,
        `name_of_lco` varchar(50) NOT NULL,
        `address` varchar(200) NOT NULL,
        `contact_person` varchar(50) NOT NULL,
        `no_of_active_stbs` int(11) NOT NULL,
        `email` varchar(100) DEFAULT NULL,
        `gstin` varchar(20) NOT NULL,
        PRIMARY KEY (`invoice_ID`)
       )ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");
    }
   
}
?>