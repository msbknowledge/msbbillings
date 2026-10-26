<?php

/**
 * Description of Site_settings_model
 *
 * @author user
 */
class User_types_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'user_types';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `user_types` (
                    `user_type_ID` int(11) NOT NULL,
                    `user_type_name` varchar(50) NOT NULL,
                    `user_type_super` tinyint(1) NOT NULL DEFAULT '0'
                  ) ENGINE=InnoDB DEFAULT CHARSET=latin1
               ");
        
        $this->db->query("ALTER TABLE `user_types` ADD PRIMARY KEY (`user_type_ID`);");        
        $this->db->query("ALTER TABLE `user_types` MODIFY `user_type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;");
		$this->db->query("INSERT INTO `user_types` (`user_type_ID`, `user_type_name`,`user_type_super`) VALUES (1, 'admin',1) ");

    }

    /**
     * get the list of all data in table 
     */
}

?>
