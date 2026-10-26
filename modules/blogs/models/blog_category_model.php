<?php


/**
 *
 * @author Bapan Roy
 */
class Blog_category_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'blog_category';
        // $this->joiningArray[0]['table'] = 'user_types';
        // $this->joiningArray[0]['condition'] = 'user_types.user_type_ID = users.user_type_id';
        $this->check();
    }
   public function install() {
        $query = $this->db->query("CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_hin` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `slug_hin` varchar(150) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB");
        

         $this->db->query("ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);");
         $this->db->query("ALTER TABLE `blog_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");
          
   
    }
    
    /**
     * get the list of all data in table 
     */
}

?>
