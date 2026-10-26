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
class Doctor extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'doctors_model';
        $this->moduleMeta = array('medical' => 'Doctor');
        $this->page_config['tablePrimaryKey'] = $this->doctors_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Doctor'; //search title bar
        $this->page_config['searchFields'] = 'doctor_name,doctor_contact,doctor_address'; //search box,
        $this->page_config['list_columns'] = 'doctor_name,doctor_contact,doctor_address';
        /*         * end page_config* */
    }

}?>