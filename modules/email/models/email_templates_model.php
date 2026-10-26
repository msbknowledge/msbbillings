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
class Email_templates_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name ='email_templates';
		$this->check();
    }
    	function get_email_template_content_by_slug($slug)
	{
		return $this->db->get_where($this->table_name,array('slug' => $slug))->row_array();
	}
     public function install() {
        $query[] = $this->db->query("CREATE TABLE `email_templates` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) NOT NULL,
          `slug` varchar(220) NOT NULL,
          `subject` varchar(255) NOT NULL,
          `body` longtext NOT NULL,
          `created_on` datetime NOT NULL DEFAULT current_timestamp(),
          `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
		");
		$query[]=" INSERT INTO email_templates (id, name, slug, subject,body, created_on, updated_on) VALUES
		(1, 'Welcome', 'welcome', 'Thanks for joining us', 'Hi {FULLNAME},<br><br>Thanks for email verification and we warmly welcome you on svp-academy.<br><br><div><div><br></div></div><div><div></div></div><span><b></b><b>Regards,</b><br><b><u><a href=\"https://svp.payrollease.in/\" title=\"Link: https://svp.payrollease.in/\">https://svp.payrollease.in/</a></u></b><br></span>', '2023-07-20 12:56:33', NULL),
(2, 'Register', 'register-applied', 'New Register Applied for', '\nHello,{FULLNAME}<div><br>Thank you for signing up with us<br><br>To activate your account and verify your email address,<br><br></div><div>Please click on link bellow <br>{VERIFICATION_LINK}<br><a target=\"\" rel=\"\"></a></div><div><a target=\"\" rel=\"\"><br></a></div><div><a target=\"\" rel=\"\"><br></a></div><div><a target=\"\" rel=\"\">Regards,<br>Team svp-academy</a></div>', '2023-07-20 12:56:39', '2023-09-11 17:07:04'),
(3, 'Email Verification', 'email-verification', 'Verify your account', 'Hello,<div><br>Thank you for signing up with us<br><br>To activate your account and verify your email address,<br><br></div><div>Please click on link bellow <br>{VERIFICATION_LINK}<br><a target=\"\" rel=\"\"></a></div><div><a target=\"\" rel=\"\"><br></a></div><div><a target=\"\" rel=\"\"><br></a></div><div><a target=\"\" rel=\"\">Regards,<br>Team svp-academy</a></div>', '2021-03-30 11:42:03', '2023-09-11 15:04:49'),
(4, 'Forgot Password', 'forgot-password', 'Reset Password', '<span>Dear Candidate \n\n{FULLNAME} ,<br><span><u></u><u></u></span></span><span><br>This is to inform you that you have been </span><span><br></span><br><b>Best Regards</b><br>\n{RESET_LINK}<div><b><u><a target=\"_blank\" rel=\"nofollow\" href=\"https://svp.payrollease.in/\" title=\"Link: https://svp.payrollease.in/\">﻿https://svp.payrollease.in/</a></u></b><br></div>', '2023-07-20 12:39:12', '2023-07-21 08:52:42'),
(5, 'Exam Information', 'exam-batch', 'Task Application Submitted Successfully', '<span>Dear Candidate,<br></span><br>You have successfully applied for the Exame of <b>{TASK_TITLE}</b>. <br>Student will review your profile and let you know if your profile matches the Exam requirements and specifications. Please note that only Student shall be receive email by  Teacher.<br><br>We wish you best of luck .<br><br><span><b>Regards,</b><br><b><a href=\"http://www.vp.payrollease.in\">www.vp.payrollease.in</a></b></span>', '2023-02-21 21:07:52', '2023-07-20 16:14:25'),
(6, 'Result Student', 'result-student', 'Congratulation !!', '<p>gfgf</p>', '2022-07-15 12:15:32', '2023-07-20 15:14:33');";
             $this->db->query($query[0]);
			 $this->db->query($query[1]);
    }
   
}

?>