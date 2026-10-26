<?php

/**
 * Description of Site_settings_model
 *
 * @author kALLOL
 * 
 * 
 */
class Schemes_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'schemes';
       // $this->check();
    }

    public function install() {
        $this->db->query("");
        }

  
}

?>
