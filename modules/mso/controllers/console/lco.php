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
class Lco extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'tax_status';
        $this->targetModel = 'lcos_model';
        $this->load->model($this->targetModel);
        $this->page_config['tablePrimaryKey'] = $this->lcos_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Database Details'; //search title bar
        $this->page_config['searchFields'] = 'CODE,NAME_OF_LCO,ADDRESS,CONTACT_PERSON'; //search box,
        $this->page_config['list_columns'] = 'ID,CODE,NAME_OF_LCO,ADDRESS,CONTACT_PERSON,NO_OF_ACTIVE_STBS,NO_OF_ACTIVE_HDSTBS';
        /*         * end page_config* */
    }

    /**
     * index show list
     */
    public function index() {

        $orderBy = $this->orderby_input_process();

        $likeCondition = $this->generate_search_like_condition();

        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config);

        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

    public function view_bill() {
        $this->load->view('console/index');
        //$this->load->view(base_url('/modules/lco/views/console/index.php'));
        //echo base_url('/modules/lco/views/console/index.php');
    }

    public function edit_detail() {
        $postedData = $this->input->post();
        if (isset($postedData['load_edit_entry'])) {
            $entryData2 = $this->{$this->targetModel}->get_list(array($this->{$this->targetModel}->get_primary_key() => trim($postedData['load_edit_entry'])));
            $entryData1 = $this->{$this->targetModel}->get_field_list();
            $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
            echo $this->generate_form_view($entryData, $this->page_config, 'add_edit_tpl');
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

                $this->{$this->targetModel}->update_data($postedData, array($this->page_config['tablePrimaryKey'] => $postedData[$this->page_config['tablePrimaryKey']]));
                echo translateIt(json_encode(array('status' => 'success', 'message' => 'Data Updated Successfully')));
            }
        }
    }

    public function add_detail() {
        $postedData = $this->input->post();
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

                echo translateIt(json_encode(array('status' => 'success', 'message' => 'Data Added Successfully')));
            }
        }
    }

    public function search() {
        $keyword = $this->input->get('term');
        $results = $this->lcos_model->get_list(NULL, NULL, null, 0, array('code' => $keyword));
        $output = null;
        foreach ($results as $key => $result) {
            $output[$key]['id'] = $result['ID'];
            $output[$key]['label'] = $result['NAME_OF_LCO'] . '(' . $result['CODE'] . ')';
            $output[$key]['value'] = $result['CODE'];
            $output[$key]['NAME_OF_LCO'] = $result['NAME_OF_LCO'];
            $output[$key]['ADDRESS'] = $result['ADDRESS'];
            $output[$key]['CONTACT_PERSON'] = $result['CONTACT_PERSON'];
            $output[$key]['NO_OF_ACTIVE_STBS'] = $result['NO_OF_ACTIVE_STBS'];
			$output[$key]['NO_OF_ACTIVE_HDSTBS'] = $result['NO_OF_ACTIVE_HDSTBS'];
			$output[$key]['GSTIN'] = $result['GSTIN'];
        }

        echo json_encode($output);
    }

}

?>
