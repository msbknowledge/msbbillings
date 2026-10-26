<?php


/**
 *
 * @author Bapan Roy
 */
class Blogs_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'blogs';
        // $this->joiningArray[0]['table'] = 'user_types';
        // $this->joiningArray[0]['condition'] = 'user_types.user_type_ID = users.user_type_id';
        $this->check();
    }
   public function install() {
        $query = $this->db->query("CREATE TABLE `blogs` (
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
        

         $this->db->query("ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);");
         $this->db->query("ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");
          
   
    }
    
    /**
     * get the list of all data in table 
     */
}

?>
