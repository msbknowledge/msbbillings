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
class Nodes_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'nodes';
        $this->joiningArray[0]['table'] = 'customers';
        $this->joiningArray[0]['condition'] = 'node_customer_id = customer_ID';
        $this->check();
    }

}

?>
