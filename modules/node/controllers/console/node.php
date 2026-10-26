<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author Kallol
 */
class Node extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->targetModel = 'customers_model';
        $this->moduleMeta = array('node' => 'Node');
        //$this->load->model($this->targetModel);

        $this->page_config['use_dropdown_columns_options']['node_status'] = array(0 => 'Off', 1 => 'On');
        $this->page_config['use_dropdown_columns_options']['multi'] = array("node_module"=>"node_module");
        $this->page_config['use_dropdown_columns_options']['node_module'] = array(
    	"node" => 'Node', 
    	"dpenterprise"=>"DP custome Node",
    	"jeoegg"=>"Jeo Egg Node",
    	'trai_lite' => 'Trai V2.0',
    	'trai_lite_' => 'Trai_lite_',
    	'trai_lite2' => 'Trai_lite2',
    	'trai-cable' => 'trai-cable',
    	'trai-cable' => 'Trai V1.0',
    	'msb-cable' => 'MSB Cable',
    	"msb-internet" => 'MSB Internet', 
    	'wholesale' => 'wholesale',
    	'wholesale_' => 'wholesale_',
    	"internet" => 'Internet', 
    	"internet_" => 'Internet_',
    	"medical" => 'Medical', 
        "medical2" => 'Medical2',
        "medical_msb" => 'Medical MSB',
        "antu" => 'Antu', 
        "antu_v1" => 'Antu V1',
        "school" => 'School',
        "email" => 'Email',
        "payment" => 'Payment',
        "blogs" => 'Blogs',
        "bbbc"=>"bbbc",
        "product"=>"product",
    	"expence_manager" => 'Expense Manager', 
    	);
        $this->page_config['use_dropdown_columns_options']['node_customer_id'] = $this->customers_model->get_list_for_dropdown("customer_name");
        $this->page_config['title'] = 'Nodes'; //search title bar
        $this->page_config['searchFields'] = 'node_url,node_name,deactivation_date,node_customer_id,node_status'; //search box,
        $this->page_config['list_columns'] ='node_module,'.$this->page_config['searchFields'];
        /*         * end page_config* */
    }

 
}
