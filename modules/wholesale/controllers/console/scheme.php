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
class Scheme extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'Scheme_status';
        $this->targetModel = 'Schemes_model';
        $this->moduleMeta = array('cables' => 'Scheme');

        $this->load->model($this->targetModel);

         $this->page_config['use_dropdown_columns'] = 'scheme_product';
         $this->page_config['use_dropdown_columns_options']['scheme_product'] = $this->products_model->get_list_for_dropdown();

        $this->page_config['tablePrimaryKey'] = $this->Schemes_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Scheme'; //search title bar
        $this->page_config['searchFields'] = 'scheme_product,scheme_rate,scheme_discount_percent'; //search box,
        $this->page_config['list_columns'] = 'scheme_product,scheme_rate,scheme_discount_percent,scheme_from,scheme_lessthan' ;
        /*         * end page_config* */
    }

    public function widget() {        
    
    }

    public function validation(){

    }

   
}

?>
