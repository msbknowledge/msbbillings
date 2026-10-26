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
class Plans_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'plans';
        $this->joiningArray[0]['table'] = 'nodes';
        $this->joiningArray[0]['condition'] = 'node_plan_id=plan_ID';
        $this->check();
    }

}

?>
