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
class Channels_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'channels';
              $this->check();
    }
    public function install() {
 $query[] = "CREATE TABLE `channels` (
  `channel_ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `channel_genre` varchar(10) DEFAULT NULL,
  `channel_broadcaster` varchar(100) DEFAULT NULL,
  `channel_name` varchar(100) NOT NULL,
  `channel_type` varchar(10) DEFAULT NULL,
  `channel_price` decimal(10,2) NOT NULL,
  `channel_definition` varchar(11) DEFAULT NULL,
  `channel_bouquet_list` text,
  `channel_discount`varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			 $this->db->query($query[0]);
    }
    /**
     * get the list of all data in table 
     */
   
}
?>
