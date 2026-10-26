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
class Credit_notes_model extends MY_Model {

    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'credit_notes';
        $this->check();
    }
    public function install() {
        $query = $this->db->query(" CREATE TABLE `credit_notes` (
        `credit_note_ID` int(11) AUTO_INCREMENT PRIMARY KEY,
        `lco_id` int(11) NOT NULL,
        `credit_note_period_start` varchar(20) NOT NULL,
        `credit_note_period_end` varchar(20) NOT NULL,
        `stb` int(11) NOT NULL,
        `rate` decimal(10,2) NOT NULL DEFAULT '0.00',
        `total_stb_costing` decimal(10,2) NOT NULL DEFAULT '0.00',
        `amount_payable` decimal(10,2) NOT NULL DEFAULT '0.00',
        `credit_note_date` date NOT NULL 
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    }
   
}
?>