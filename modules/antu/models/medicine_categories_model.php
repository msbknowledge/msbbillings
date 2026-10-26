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
class Medicine_categories_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'medicine_categories';
        $this->check();
    }

    public function install() {
      $this->db->query("CREATE TABLE `medicine_categories` (
  `medicine_category_id` int(22) NOT NULL AUTO_INCREMENT,
  `medicine_category_name` varchar(100) NOT NULL,
 PRIMARY KEY (`medicine_category_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
      $this->db->query("INSERT INTO `medicine_categories` (`medicine_category_id`, `medicine_category_name`) VALUES
(1, 'Syrup'),
(2, 'Capsule'),
(3, 'Injection'),
(4, 'Ointment'),
(5, 'Tablet'),
(6, 'Cream'),
(7, 'Drops'),
(8, 'Diaper'),
(9, 'Liquid'),
(10, 'Preparations'),
(11, 'Surgical'),
(12, 'Inhalers'),
(13, 'Implants_Patches'),
(14, 'Multi Therapy'),
(15, 'Vintage'),
(16, 'Pain Management'),
(17, 'CNS-Task Force'),
(18, 'Hospital Care'),
(19, 'Derma Prime'),
(20, 'Superspeciality'),
(21, 'Restora'),
(22, 'PPD'),
(23, 'SCD');");
      
    }

}

?>
