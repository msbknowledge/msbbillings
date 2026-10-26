<?php

/**
 * Description of Site_settings_model
 *
 * @author user
 */
class Dynamic_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct($table_name) {
        parent::__construct();
        $this->table_name = $table_name;
    }

	public function get_foreign_keys(){
$data = $this->db->query("select * from information_schema.key_column_usage where REFERENCED_TABLE_SCHEMA = database() and TABLE_NAME ='". $this->table_name."'")->result_array();
return $data;
	}


    /**
     * get the list of all data in table 
     */
}

?>
