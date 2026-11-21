<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Help extends MY_Controller
{
    public $publicAccess = array('index', 'home');

    public function __construct()
    {
        parent::__construct();
        $this->load->model('help_model');
        $this->page_config['use_image_columns'] = 'link';
        $this->page_config['use_image_columns_path'] = base_url() . 'uploads/' . (defined('NODE') ? NODE : '') . '/';
        $this->page_config['replace_text'] = array('link' => 'Image');
        $this->page_config['searchFields'] = 'help_id,help_title,help_type,help_description';
        $this->page_config['list_columns'] = 'help_title,help_type,link,help_description';
    }

    public function index()
    {
        $modules = defined('PLAN_PACKAGES') ? json_decode(PLAN_PACKAGES, true) : array();
        $data['module'] = array();
        if (is_array($modules)) {
            foreach ($modules as $key => $value) {
                $data['module'][$key + 1] = $value;
            }
        }

        $active_plan = defined('NODETYPE') ? NODETYPE : (defined('PLAN_NAME') ? PLAN_NAME : 'medical');
        $data['active_plan'] = $active_plan;
        $data['node_name'] = defined('NODE') ? NODE : 'antu';
        $data['help_data'] = $this->help_model->get_help();
        $data['page_title'] = 'Help & Knowledge Base';

        $this->render($data, 'help_tpl');
    }

    public function demo()
    {
        $this->index();
    }
}
