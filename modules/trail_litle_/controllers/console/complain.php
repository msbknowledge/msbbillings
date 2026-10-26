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
class Complain extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'customer_status';
        $this->targetModel = 'complain_model';
        $this->moduleMeta = array('complain' => 'Complain');

        $this->load->model($this->targetModel);
        $this->load->model('users_model');
        $this->load->model('customers_model');
        #$cable_customer=$this->db->query('select * from customers')->result_array();
        # $internet_customer=$this->db->query('select * from internet_customers')->result_array();
        #pr(array_merge($cable_customer,$internet_customer));


        $this->page_config['use_dropdown_columns'] = 'complain_service,complain_type,complain_status,complain_assign_to';
        $this->page_config['use_dropdown_columns_options']['complain_assign_to'] = $this->users_model->get_list_for_dropdown('user_login');
        $this->page_config['use_dropdown_columns_options']['complain_service'] = array('cable' => 'Cable', 'internet' => 'Internet');
        $this->page_config['use_dropdown_columns_options']['complain_type'] = array(
            'New cable connection'=>'New cable connection',
            //'New internet connection'=>'New cable connection',
            'Co-axcel cutting'=>'Co-axcel cutting', 
            'Fiber cutting'=>'Fiber cutting',
            'No signal'=> 'No signal',
            'Picture freezing'=>'Picture freezing',
            'Stb problem'=>'Stb problem'
            );
        $this->page_config['use_dropdown_columns_options']['complain_status'] = array('new'=>'New', 'assign'=>'Assigned', 'resolved'=>'Resolved');


        $this->page_config['tablePrimaryKey'] = $this->complain_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Complain'; //search title bar
        $this->page_config['searchFields'] = 'complain_assign_to'; //search box,
        $this->page_config['list_columns'] = 'complain_from_customer,complain_service,complain_status,complain_assign_to';
        /*         * end page_config* */
    }
   

    /**
     * add detail
     */
    public function add_detail() {
        $postedData = $this->input->post();
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
            echo $this->generate_form_view($entryData[0], $this->page_config, 'add_edit_tpl');
        } else {
            if ($postedData) {
                /** status* */
                $config = $this->auto_fieldtype_detect(NULL);
                if (isset($config['use_status_columns'])) {
                    foreach ($config['use_status_columns'] as $statusColumn) {
                        $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
                    }
                }
                /*                 * multi chooser */
                if (isset($this->page_config['use_dropdown_columns_options']['multi'])) {
                    foreach ($this->page_config['use_dropdown_columns_options']['multi'] as $multiChooser => $multi) {
                        if (isset($postedData[$multiChooser]))
                            $postedData[$multiChooser] = is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                        else
                            $postedData[$multiChooser] = '["0"]';
                    }
                }
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);

                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
               // translateIt
            }
        }
    }

    public function customer_search() {
        if ($this->uri->segment(4) == 'cable')
            $results = $this->customers_model->get_list_for_dropdown(null, array('customer_status' => 1), null, 10, null, array('customer_name' => $this->input->get('term')));
        if ($this->uri->segment(4) == 'internet')
            $results = $this->internet_customers_model->get_list_for_dropdown(null, array('customer_status' => 1), null, 10, null, array('customer_name' => $this->input->get('term')));

        $output = null;
        $counter = 0;

        foreach ($results as $result) {
            $output[$counter]['id'] = $result['customer_ID'];
            $output[$counter]['label'] = $result['customer_name'] . '(' . $result['customer_code'] . ')';
            $output[$counter]['value'] = $result['customer_name'];
            $counter++;
        }
        echo json_encode($output);
    }

}

?>
