<?php


/**
 *
 * @author kallol
 */
class Users_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'users';
        $this->joiningArray[0]['table'] = 'user_types';
        $this->joiningArray[0]['condition'] = 'user_types.user_type_ID = users.user_type_id';
        $this->check();
    }
   public function install() {
        $query = $this->db->query("CREATE TABLE `users` (
  `user_ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_firstname` varchar(50) NOT NULL DEFAULT '',
  `user_lastname` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_type_id` int(11) NOT NULL,
  `user_mobile` varchar(45) DEFAULT NULL,
  `user_image` VARCHAR(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        

         $this->db->query("ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_firstname`);");
         $this->db->query("ALTER TABLE `users`
  MODIFY `user_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");
          
   $this->db->query("INSERT INTO `users` 
   (`user_ID`, `user_login`, `user_pass`, `user_firstname`, `user_lastname`, `user_email`, `user_status`, `user_type_id`) VALUES
	(1, 'admin', 'admin123', 'System', 'Admin', 'admin@msbbillings.in', 1, 1,'');
	");
    }
    
    /**
     * get the list of all data in table 
     */
}

?>
