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
class Credit_note extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        
        /*         * page_config* */
        $this->page_config['title'] = 'Purchase'; //search title bar
        $this->page_config['allowed_action'] = 'add_detail,print,edit_detail,purchase_return,view_detail,quick_edit,delete';
        $this->page_config['searchFields'] = 'product_name,purchase_date,purchase_invoice,purchase_supplier'; //search box,
        $this->page_config['list_columns'] = 'purchase_date,purchase_invoice,purchase_supplier';
        $this->page_config['autocomplete']['supplier_name'] = array('suppliers' => 'supplier_name');
        $this->page_config['autocomplete']['supplier_gst'] = array('suppliers' => 'supplier_gst');
        $this->page_config['autocomplete']['product_name'] = array('products' => 'product_name');
        $this->page_config['use_dropdown_columns'] = 'purchase_supplier';
        $this->page_config['use_dropdown_columns_options']['purchase_supplier'] = $this->suppliers_model->get_list_for_dropdown('supplier_name'); //pk
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }

  

}
?>