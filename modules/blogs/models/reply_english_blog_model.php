<?php


/**
 *
 * @author Bapan Roy
 */
class Reply_english_blog_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'reply_english_blog';
        // $this->joiningArray[0]['table'] = 'user_types';
        // $this->joiningArray[0]['condition'] = 'user_types.user_type_ID = users.user_type_id';
        $this->check();
    }
   public function install() {
        $query = $this->db->query("CREATE TABLE IF NOT EXISTS `reply_english_blog` (
  `id` int(10) NOT NULL,
  `blog_id_hindi` int(10) NOT NULL,
  `comment_id` int(10) DEFAULT NULL,
  `reply_name` varchar(250) DEFAULT NULL,
  `reply` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;");
        

         $this->db->query("ALTER TABLE `reply_english_blog`
  ADD PRIMARY KEY (`id`);");
         $this->db->query("ALTER TABLE `reply_english_blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");
          
   
    }
    
    /**
     * get the list of all data in table 
     */
}

?>
