<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Bapan Roy
 */
class User_type extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'user_types_model';
        $this->page_config['tablePrimaryKey'] = $this->user_types_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'User Type'; //search title bar
        $this->page_config['searchFields'] = 'user_type_name'; //search box,

        /*         * end page_config* */
    }

 
    //---------------------------------------------------------------
    /**
     * non generic functions
     * * */
}

?>
