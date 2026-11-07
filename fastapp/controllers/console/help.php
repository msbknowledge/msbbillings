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
        $this->page_config['replace_text'] = array('link' => 'Image');
        $this->page_config['searchFields'] = 'help_id,help_title,help_type,help_description';
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
