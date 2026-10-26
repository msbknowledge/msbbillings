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
class Manufacturers_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'manufacturers';
        $this->check();
    }

    public function install() {
    $this->db->query("CREATE TABLE `manufacturers` (
    `manufacturer_ID` int(11) NOT NULL AUTO_INCREMENT,
    `manufacturer_name` varchar(100) NOT NULL,
    PRIMARY KEY (`manufacturer_ID`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
    ");
    // $this->db->query("INSERT INTO `manufacturers` (`manufacturer_ID`, `manufacturer_name`) VALUES
    // (1, 'Abbot');
    // ");
    }

}

?>
