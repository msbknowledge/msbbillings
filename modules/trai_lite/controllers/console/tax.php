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
class Tax extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'tax_status';
        $this->targetModel = 'taxes_model';
        $this->moduleMeta = array('cables' => 'Tax');

        $this->load->model($this->targetModel);
        $this->load->model('packages_model');

        $this->page_config['use_dropdown_columns'] = 'tax_type';

        $this->page_config['use_dropdown_columns_options']['tax_type'] = array(0 => "%", 1 => "Amount");
        $this->page_config['tablePrimaryKey'] = $this->taxes_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Tax'; //search title bar
        $this->page_config['searchFields'] = 'tax_name'; //search box,
        //$this->page_config['list_columns'] = 'tax_name';
        /*         * end page_config* */
    }

    public function widget() {
        
    }

    public function tax() {
        pr($this->{$this->targetModel}->reverse_calulate_tax(236));
    }

   

}

?>
