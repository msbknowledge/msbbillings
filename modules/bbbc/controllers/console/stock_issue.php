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
class Stock_issue extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'stock_issues_model';
        $this->page_config['searchFields'] = 'stock_issue_lco,stock_issue_date'; //search box,
        $this->page_config['use_dropdown_columns'] = 'stock_issue_lco';
        $this->page_config['use_dropdown_columns_options']['stock_issue_lco'] = $this->lcos_model->get_list_for_dropdown('NAME_OF_LCO');
    
    }

}

?>
