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
class Customer extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'customers_model';
        $this->moduleMeta = array('medical' => 'Customer');
        $this->page_config['tablePrimaryKey'] = $this->customers_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Customer'; //search title bar
        $this->page_config['searchFields'] = 'customer_name,customer_contact,customer_address,email'; //search box,
        $this->page_config['list_columns'] = 'customer_name,customer_contact,customer_address,email';
        /*         * end page_config* */
    }

}?>