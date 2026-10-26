<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 * module: cable
 * @author Kallol
 * @todo separate naming as cable collection
 */
class Collection extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'collections_model';
        $this->moduleMeta = array('cables' => 'Collection');
        /****
         * only admin are allowed to view the collection and delete it.. nothing other than that..
         * ********************/
        if($this->current_user_session['user_type_super']==1)
			$this->allowed_action = array('delete', 'view_detail');

        $this->page_config['use_dropdown_columns'] = 'collection_customer';
        $this->page_config['use_dropdown_columns_options']['collection_customer'] = $this->customer_list();
        $this->page_config['tablePrimaryKey'] = $this->collections_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Collection'; //search title bar
        $this->page_config['searchFields'] = 'collection_ID,collection_for,customer_name,customer_code,collection_collected_by,collection_date'; //search box,
        $this->page_config['list_columns'] = 'collection_ID,collection_for,customer_name,customer_code,collection_collected_by,collection_entry_timestamp,collection_date,collection_amount';

        /*         * end page_config* */
    }

	/***
	 * deprication start : 9th may 18 - 09:35
	 * will be deleted after 1 month or before if no connection found
	 * ***************/
    public function customer_list() {
        $data = $this->customers_model->get_list_for_dropdown();
        $returndata = null;
        foreach ($data as $key => $value) {
            if ($value['customer_is_free'] == 1 || $value['customer_status'] != 1)
                continue;
            $returndata[$key] = $value['customer_name'] . '(' . $value['customer_code'] . ')';
        }
        return $returndata;
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
    public function print_collection() {
        $postedData = $this->input->post();
       //pr($postedData,1);
         $data= $postedData['selectedItem'];
          $string= implode(',', $data);
       $output=$this->db->query("select * from collections where collection_ID in ($string)")->result_array();
      // pr($output,1);
          foreach ($output as $key =>$value){
        $data = $this->customers_model->account_statement($value['collection_customer'], $value['collection_date']);
       //  pr($data);
        $this->load->view('console/customer/print_template_due_tpl', array('data' => $data, 'date' => $value['collection_date']));
          }
    }
    
}

?>
