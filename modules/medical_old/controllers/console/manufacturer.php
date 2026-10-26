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
 * @author Kallol
 */
class Manufacturer extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'manufacturers_model';
        $this->moduleMeta = array('medical' => 'Manufacturer');
        $this->page_config['tablePrimaryKey'] = $this->manufacturers_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Manufacturer'; //search title bar
        $this->page_config['searchFields'] = 'manufacturer_name'; //search box,
        $this->page_config['list_columns'] = 'manufacturer_name';
        /*         * end page_config* */
    }

}

?>