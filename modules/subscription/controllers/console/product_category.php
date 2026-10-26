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
class Product_category extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'product_categories_model';
        $this->moduleMeta = array('medical' => 'Product_category');
        $this->page_config['tablePrimaryKey'] = $this->product_categories_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Product_category'; //search title bar
        $this->page_config['searchFields'] = 'product_category_name'; //search box,
        $this->page_config['list_columns'] = 'product_category_name';
        /*         * end page_config* */
    }

}?>