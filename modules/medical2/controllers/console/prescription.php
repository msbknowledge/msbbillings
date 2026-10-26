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
class Prescription extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'prescription_model';
        $this->moduleMeta = array('medical2' => 'prescription');
      //  $this->page_config['tablePrimaryKey'] = $this->doctors_model->get_primary_key(); //pk
        /*         * page_config* */
        $config['use_image_columns']="image_capture";

        $this->page_config['title'] = 'prescription'; //search title bar
      $this->page_config['searchFields'] = 'id,name,phone,address,status'; //search box,
        $this->page_config['list_columns'] = 'id,name,phone,address,status,date';
        $this->allowed_action = array( 'edit_detail','index','view_detail');
        $this->page_config['use_dropdown_columns'] = 'status';
        $this->page_config['use_dropdown_columns_options']['status'] = array('pending' => "Pending","closed"=>"Closed");
        /*         * end page_config* */
    }

        /**
     * view detail
     */
    public function view_detail() {
      $config = $this->auto_fieldtype_detect(NULL);
      $this->page_config = array_merge($config, $this->page_config);
      $entryID = trim($this->input->post('entry'));
      $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
      $entryData1 = $this->{$this->targetModel}->get_field_list();
      $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
     
      echo $this->generate_detail_view($entryData, $this->page_config,'detail_tpl1.php');
  }

  public function edit_detail() {
    $postedData = $this->input->post();
    $config = $this->auto_fieldtype_detect(NULL);
    $this->page_config = array_merge($config, $this->page_config);
    if (isset($postedData['load_edit_entry'])) {
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        echo $this->generate_form_view($entryData, $this->page_config,'add_edit_tpl.php');
    } else {
        if ($postedData) {
            /** status* */
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

            $this->{$this->targetModel}->update_data($postedData, array($config['tablePrimaryKey'] => $postedData[$config['tablePrimaryKey']]));
            echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
        }
    }
}
}?>