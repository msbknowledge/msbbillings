<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class helps extends MY_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->targetModel = 'helps_model';
        $this->page_config['use_image_columns'] = 'link';
        $this->page_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        $this->page_config['searchFields'] = 'help_id,help_title,help_type,help_description';
        $this->page_config['replace_text'] = array('link' => 'Image');
        $this->page_config['list_columns'] = 'help_title,help_type,link,help_description';
    }
}
