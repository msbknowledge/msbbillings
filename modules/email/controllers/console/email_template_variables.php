<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 * module: cable
 * @author Kallol
 * @todo separate naming as cable collection
 */
class Email_template_variables extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'email_template_variables_model';
        $this->moduleMeta = array('cables' => 'Collection');
       
        $this->page_config['title'] = 'Email_template_variables'; //search title bar
        $this->page_config['searchFields'] = 'id,variable_name,template_id,created_on,updated_on'; //search box,
        $this->page_config['list_columns'] = 'id,variable_name,template_id,created_on,updated_on';

        /*         * end page_config* */
    }


      public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }
 
    
}

?>
