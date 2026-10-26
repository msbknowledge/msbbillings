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
class Supplier extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'suppliers_model';
        $this->moduleMeta = array('medical' => 'Supplier');
        $this->page_config['tablePrimaryKey'] = $this->suppliers_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Supplier'; //search title bar
        $this->page_config['searchFields'] = 'supplier_name,supplier_address,supplier_contact,supplier_gst'; //search box,
        $this->page_config['list_columns'] = 'supplier_name,supplier_address,supplier_contact,supplier_gst';
        /*         * end page_config* */
    }

}

?>