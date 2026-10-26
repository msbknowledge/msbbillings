<?php


/**
 *
 * @author Bapan Roy
 */
class Enquiry_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'enquiry';
        $this->check();
    }
   public function install() {
        $query = $this->db->query("CREATE TABLE `enquiry` (
          `enquiry_ID` bigint(20) NOT NULL AUTO_INCREMENT,
          `user_name` varchar(50) NOT NULL DEFAULT '',
          `email` varchar(100) NOT NULL DEFAULT '',
          `enquiry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` int(11) NOT NULL DEFAULT '0',
          `mobile` varchar(45) DEFAULT NULL,
          PRIMARY KEY (`enquiry_ID`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

    }
    
    /**
     * get the list of all data in table 
     */
}

?>
