<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 * module: cable
 * @author Kallol
 * @todo separate naming as cable collection
 */
class Cable_collection extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'cable_collections_model';
        $this->moduleMeta = array('cables' => 'Collection');
        /****
         * only admin are allowed to view the collection and delete it.. nothing other than that..
         * ********************/
        if($this->current_user_session['user_type_super']==1)
			$this->allowed_action = array('delete', 'view_detail');

        $this->page_config['use_dropdown_columns'] = 'collection_customer';
        $this->page_config['use_dropdown_columns_options']['collection_customer'] = $this->customer_list();
        $this->page_config['tablePrimaryKey'] = $this->cable_collections_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Collection'; //search title bar
        $this->page_config['searchFields'] = 'collection_for,customer_name,customer_code,collection_collected_by,customer_address,customer_area,collection_date'; //search box,
        $this->page_config['list_columns'] = 'collection_for,customer_name,customer_code,collection_collected_by,customer_area,collection_entry_timestamp,collection_date,collection_amount';

        /*         * end page_config* */
    }

	/***
	 * deprication start : 9th may 18 - 09:35
	 * will be deleted after 1 month or before if no connection found
	 * ***************/
    public function customer_list() {
        $data = $this->cable_customers_model->get_list_for_dropdown();
        $returndata = null;
        foreach ($data as $key => $value) {
            if ($value['customer_is_free'] == 1 || $value['customer_status'] != 1)
                continue;
            $returndata[$key] = $value['customer_name'] . '(' . $value['customer_code'] . ')';
        }
        return $returndata;
    }
    
    
}

?>
