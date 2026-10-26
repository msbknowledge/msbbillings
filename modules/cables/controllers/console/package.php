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
class Package extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'package_status';
        $this->targetModel = 'packages_model';
        $this->moduleMeta = array('cables' => 'Package');

        $this->load->model($this->targetModel);
        $this->load->model('taxes_model');


        //$this->page_config['use_dropdown_columns_options']['package_type'] = $this->get_package_types($this->current_site_settings['site_setting_theme']);





        $this->page_config['tablePrimaryKey'] = $this->packages_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Package'; //search title bar
        $this->page_config['searchFields'] = 'package_name,package_cost_inclusive_tax'; //search box,
        $this->page_config['list_columns'] = 'package_is_free,package_name,package_cost_inclusive_tax,package_rate';
        /*         * end page_config* */
    }

    public function widget() {
       # pr($this->taxes_model->calulate_tax(100));
        pr($this->taxes_model->reverse_calulate_tax(118));
    }

    /**
     * add detail
     */
    public function add_detail() {
        $postedData = $this->input->post();
        if (isset($postedData['load_add_entry'])) {
            $entryData = $this->{$this->targetModel}->get_field_list();
             
            echo $this->generate_form_view($entryData[0], $this->page_config);
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
                    $tax = $this->taxes_model->calulate_tax($postedData['package_rate']);
                    $postedData['package_cost_inclusive_tax'] = round($tax['total'], 2);
                }
                if ($postedData['package_rate'] == '' || $postedData['package_rate'] == '0.00') {

                    $tax = $this->taxes_model->reverse_calulate_tax($postedData['package_cost_inclusive_tax']);
                    
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
                    $tax = $this->taxes_model->calulate_tax($postedData['package_rate']);
                    $postedData['package_cost_inclusive_tax'] = round($tax['total'], 2);
                }
                if (empty($postedData['package_rate'])) {
                    $tax = $this->taxes_model->reverse_calulate_tax($postedData['package_cost_inclusive_tax']);
                    $postedData['package_rate'] = round($tax, 2);
                }
                if (NODE == 'cable_sadhan') {

                    $postedData = Array
                        (
                        'package_ID' => $postedData['package_ID'],
                        'package_name' => $postedData['package_name'],
                        'package_rate' => $postedData['package_rate'],
                        'package_cost_inclusive_tax' => $postedData['package_cost_inclusive_tax'],
                    );
                } 
                //pr(array($this->page_config['tablePrimaryKey'] => $postedData[$this->page_config['tablePrimaryKey']]),1);
                $this->{$this->targetModel}->update_data($postedData, array($this->page_config['tablePrimaryKey'] => $postedData[$this->page_config['tablePrimaryKey']]));
               echo (json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }
    public function channel() {
        $channelData='[{"name":" Base Pack","rate":130},{"name":"COLORS","rate":14.02},{"name":"network capacity fee","rate":20}]';
        $channelData = json_decode($channelData,true);
        //pr($channelData);
//die('pree');
        $package = $this->channels_model->get_list();
         $channel = $this->packages_model->get_list();

 // pr($channel, 1);
        $sql = "SELECT channel_name,channel_price,channel_definition FROM `channels`  WHERE channel_type !='FTA'";
        $fta = "SELECT package_name,package_rate,package_channel_count FROM `packages`";
        
        $result = $this->db->query($sql)->result_array();
        $fta_result = $this->db->query($fta)->result_array();
        //pr($fta_result, 1);
        // $result = $conn->query($sql);
        //$fta_result = $conn->query($fta);

        if ($result) {
            foreach ($result as $key => $row) {
                // output data of each row
                $data[] = $row;
                //  pr($data,1);
            }
        }

        if ($fta_result) {
            foreach ($fta_result as $key => $row)  {
                    $fta_data[] = $row;
                     //pr($fta_data,1);
                }
            }

            $dalldata = array( 'data'=>$data,'fta_data'=> $fta_data);
//pr($dalldata, 1);
           $this->render( array('dalldata'=>$dalldata, 'channelData'=>$channelData),'pack_cal_tpl');
               //$this->load->view( 'console/pack_cal_tpl',array('dalldata'=>$dalldata));

            // $conn->close();
        }


}

?>
