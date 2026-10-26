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
class Help extends MY_Controller {
public $publicAccess = array('index', 'home');
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('help_model');
        $this->page_config['use_image_columns'] = 'link';
        $this->page_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        
        // $this->page_config['use_file_columns'] = 'link';
        // $this->page_config['use_file_columns_path'] = array('link' => '');
        $this->page_config['searchFields'] = 'help_id';
        // $this->page_config['use_file_columns'] ='help_title'; 
        // $this->page_config['list_columns'] =$this->page_config['searchFields']; 
        $this->page_config['list_columns'] = 'help_title,help_type,link,help_description';
        }
        
        public function index() {
        //     define('PLAN_NAME', $row['node_plan']);
        // define('PLAN_PACKAGES', $row['node_module']);
        // define('NODE', $row['node_name']);
        // define('NODETYPE', $row['node_plan']);
        // define('ROOTPATH', dirname(__FILE__) . '/');

            
                $modules = json_decode(PLAN_PACKAGES,true);
                $s = json_decode(NODETYPE,true);
                // $sql= $this->get_modules();

                    foreach ($modules as $key => $value) {
                        $data['module'][$key+1]=$value;
                    }
                    $data['help_data']=$this->help_model->get_help();
                  //pr( NODETYPE,1);
                    $this->render($data,'help_tpl');
            
        }
          public function demo() {
        //     define('PLAN_NAME', $row['node_plan']);
        // define('PLAN_PACKAGES', $row['node_module']);
        // define('NODE', $row['node_name']);
        // define('NODETYPE', $row['node_plan']);
        // define('ROOTPATH', dirname(__FILE__) . '/');

            
                $modules = json_decode(PLAN_PACKAGES,true);
                $s = json_decode(NODETYPE,true);
                // $sql= $this->get_modules();

                    foreach ($modules as $key => $value) {
                        $data['module'][$key+1]=$value;
                    }
                    $data['help_data']=$this->help_model->get_help();
                //  pr( NODETYPE,1);
                    $this->render($data,'help_tpl');
            
        }


}?>
