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
class Internet_package extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'package_status';
        $this->targetModel = 'internet_packages_model';
        $this->moduleMeta = array('internet' => 'Internet Package');
        $this->page_config['tablePrimaryKey'] = $this->internet_packages_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Package'; //search title bar
        $this->page_config['searchFields'] = 'package_name,package_cost_inclusive_tax,package_subscription_days,package_isp'; //search box,
        $this->page_config['list_columns'] = 'package_name,package_cost_inclusive_tax,package_rate,package_subscription_days,package_isp';
        /*         * end page_config* */
    }

    public function widget() {
       # pr($this->internet_taxes_model->calulate_tax(100));
        pr($this->internet_taxes_model->reverse_calulate_tax(118));
    }

    /**
     * add detail
     */
    public function add_detail() {
        $postedData = $this->input->post();
        if (isset($postedData['load_add_entry'])) {
           
            $entryData = $this->{$this->targetModel}->get_field_list();
            
            echo $this->generate_form_view($entryData[0], $this->page_config);
             //pr($this->generate_form_view($entryData[0], $this->page_config));
        } else {
            if ($postedData) {
                /** status* */
                $config = $this->auto_fieldtype_detect(NULL);
                if (isset($config['use_status_columns'])) {
                    foreach ($config['use_status_columns'] as $statusColumn) {
                        $postedData[$statusColumn] = isset($postedData[$statusColumn]) ? 1 : 0;
                    }
                }

                if ($postedData['package_cost_inclusive_tax'] == '' || $postedData['package_cost_inclusive_tax'] == '0.00') {
                    $tax = $this->internet_taxes_model->calulate_tax($postedData['package_rate']);
                    $postedData['package_cost_inclusive_tax'] = round($tax['total'], 2);
                }
                if ($postedData['package_rate'] == '' || $postedData['package_rate'] == '0.00') {

                    $tax = $this->internet_taxes_model->reverse_calulate_tax($postedData['package_cost_inclusive_tax']);
                    
                    $postedData['package_rate'] = round($tax, 2);
                }

               # pr($postedData,1);
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);

                echo (json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    /**
     * edit detail
     */
    public function edit_detail() {
        $postedData = $this->input->post();
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config);
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
                        $postedData[$multiChooser] = @is_array($postedData[$multiChooser]) ? json_encode($postedData[$multiChooser]) : json_encode(array());
                    }
                }
                if (empty($postedData['package_cost_inclusive_tax'])) {
                    $tax = $this->internet_taxes_model->calulate_tax($postedData['package_rate']);
                    $postedData['package_cost_inclusive_tax'] = round($tax['total'], 2);
                }
                if (empty($postedData['package_rate'])) {
                    $tax = $this->internet_taxes_model->reverse_calulate_tax($postedData['package_cost_inclusive_tax']);
                    $postedData['package_rate'] = round($tax, 2);
                }
              

                
                $this->{$this->targetModel}->update_data($postedData, array($this->page_config['tablePrimaryKey'] => $postedData[$this->page_config['tablePrimaryKey']]));
                echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

}

?>
