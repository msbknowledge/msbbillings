<?php


/**
 *
 * @author Bapan Roy
 */
class Blog_comment_hindi_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'blog_comment_hindi';
        // $this->joiningArray[0]['table'] = 'user_types';
        // $this->joiningArray[0]['condition'] = 'user_types.user_type_ID = users.user_type_id';
        $this->check();
    }
   public function install() {
        $query = $this->db->query("CREATE TABLE IF NOT EXISTS `blog_comment_hindi` (
  `comnt_id` int(11) NOT NULL,
  `blog_id_hindi` int(10) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        

         $this->db->query("ALTER TABLE `blog_comment_hindi`
  ADD PRIMARY KEY (`comnt_id`);");
         $this->db->query("ALTER TABLE `blog_comment_hindi`
  MODIFY `comnt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");
          
   
    }
    
    /**
     * get the list of all data in table 
     */
}

?>
