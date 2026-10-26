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
class Prescription_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'tb_prescription';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `tb_prescription` (
        `id` int NOT NULL,
        `Name` varchar(250) NOT NULL,
        `phone` varchar(250) NOT NULL,
        `address` varchar(250) NOT NULL,
        `image_capture` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `status` varchar(100) NOT NULL,
        `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
      ");
//        $this->db->query("INSERT INTO `doctors` (`doctor_ID`, `doctor_name`, `doctor_address`, `doctor_contact`) VALUES
// (3, 'Dr REDDY', 'Kolkata', '369874125'),
// (4, 'Dr BATRA', 'Kolkata', '147896325');");
       
    }

}

?>
