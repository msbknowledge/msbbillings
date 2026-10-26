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
class Cable_channel extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'channel_status';
        $this->targetModel = 'cable_channels_model';
        $this->moduleMeta = array('cables' => 'Channel');

        $this->load->model($this->targetModel);
        $this->load->model('cable_packages_model');

            
        $this->page_config['tablePrimaryKey'] = $this->cable_channels_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Channel'; //search title bar
        $this->page_config['searchFields'] = 'channel_name'; //search box,
        //$this->page_config['list_columns'] = 'channel_name';
        /*         * end page_config* */
    }

}

?>
