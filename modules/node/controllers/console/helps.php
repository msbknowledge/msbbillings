<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class helps extends MY_Controller {

  public function __construct() {
        parent::__construct();
       
       
        $this->targetModel = 'helps_model';
        $this->page_config['use_image_columns'] = 'link';
        $this->page_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        $this->page_config['searchFields'] = 'help_id';
        $this->page_config['use_file_columns'] ='help_title'; 
        // $this->page_config['list_columns'] =$this->page_config['searchFields']; 
        $this->page_config['list_columns'] = 'help_title,help_type,link,help_description';
      
    }


}