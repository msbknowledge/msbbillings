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
class Invoice_template extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'invoice_templates_model';
        $this->page_config['tablePrimaryKey'] = $this->{$this->targetModel}->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Invoice_template'; //search title bar
        $this->page_config['searchFields'] = 'Invoice_template_name'; //search box,
        /*         * end page_config* */
    }

}?>