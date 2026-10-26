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
class Blogs_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'blogs';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(500) NOT NULL,
  `blog_title_hin` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `slug_hin` varchar(500) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `blog_sub_category_id` int(11) NOT NULL,
  `tags` varchar(250) NOT NULL,
  `tags_hin` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `sort_content` text NOT NULL,
  `sort_content_hin` text NOT NULL,
  `long_content` longtext NOT NULL,
  `long_content_hin` longtext NOT NULL,
  `blog_images` text DEFAULT NULL,
  `blog_images_hindi` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
//        $this->db->query("INSERT INTO `doctors` (`doctor_ID`, `doctor_name`, `doctor_address`, `doctor_contact`) VALUES
// (3, 'Dr REDDY', 'Kolkata', '369874125'),
// (4, 'Dr BATRA', 'Kolkata', '147896325');");
       
    }

}

?>
