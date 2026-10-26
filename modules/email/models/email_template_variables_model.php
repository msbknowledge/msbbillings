<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_settings_model
 *
 * @author Bapan
 * 
 * 
 */
class Email_template_variables_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='email_template_variables';
		$this->check();
    }
     public function install() {
        $query1 = $this->db->query("CREATE TABLE `email_template_variables` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `template_id` int(11) NOT NULL,
          `variable_name` varchar(250) NOT NULL,
          `created_on` datetime NOT NULL DEFAULT current_timestamp(),
          `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB;
		"); 
		$query2=" INSERT INTO email_template_variables (id, template_id, variable_name, created_on, updated_on) VALUES
		(1, 1, '{FULLNAME}', '2023-07-20 13:27:26', NULL),
        (2,2, '{FULLNAME}', '2023-07-20 13:27:26', '2023-07-20 15:12:37'),
        (3, 3, '{VERIFICATION_LINK}', '2023-07-20 13:27:26', NULL),
        (4, 4, '{FULLNAME}', '2023-07-20 13:27:26', '2023-07-20 15:12:54'),
        (5, 5, '{CONTENT}', '2023-07-20 13:27:26', NULL),
        (6, 6, '{TASK_TITLE}', '2023-07-20 13:27:26', '2023-07-20 14:54:22')";
         $this->db->query($query1);
		 $this->db->query($query2);
    }
   
}

?>