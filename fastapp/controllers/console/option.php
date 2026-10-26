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
class Option extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'options_model';
        $this->page_config['tablePrimaryKey'] = $this->options_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Option'; //search title bar
        $this->page_config['searchFields'] = 'option_key,option_value'; //search box,


        /*         * end page_config* */
    }

}

?>
