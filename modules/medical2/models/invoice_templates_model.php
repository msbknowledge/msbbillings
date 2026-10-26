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
class Invoice_templates_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'Invoice_templates';
        $this->check();
    }

        public function install() {
        $this->db->query("CREATE TABLE `Invoice_templates` (
        `Invoice_template_ID` int(11) NOT NULL AUTO_INCREMENT,
        `Invoice_template_name` varchar(50) DEFAULT NULL,
        `Invoice_template_address` varchar(200) DEFAULT NULL,
        `Invoice_template_contact` varchar(15) NOT NULL,
        PRIMARY KEY (`Invoice_template_ID`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");

        }

}

?>
