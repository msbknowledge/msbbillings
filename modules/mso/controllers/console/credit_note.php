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

        $this->targetModel = 'credit_notes_model';
        $this->load->model($this->targetModel);
        $this->page_config['tablePrimaryKey'] = $this->{$this->targetModel}->get_primary_key(); //pk
		$this->page_config['use_dropdown_columns'] = 'lco_id,credit_note_period_start,credit_note_period_end';

        $this->page_config['use_dropdown_columns_options']['lco_id'] = $this->lcos_model->get_list_for_dropdown('NAME_OF_LCO');
        $this->page_config['use_dropdown_columns_options']['credit_note_period_start'] = $this->period_generate();
        $this->page_config['use_dropdown_columns_options']['credit_note_period_end'] = $this->period_generate();

        /*         * page_config* */
        $this->page_config['title'] = 'Credit Note'; //search title bar
        $this->page_config['searchFields'] = 'lco_id,credit_note_date,credit_note_period_start,credit_note_period_end'; //search box,
        $this->page_config['list_columns'] = 'lco_id,credit_note_date,credit_note_period_start,credit_note_period_end';
        /*         * end page_config* */
    }
	private function period_generate() {
        $month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $years = array('15', '16');
        $output_array = null;
        foreach ($years as $year) {
            foreach ($month_names as $month) {
                $output_array[$month . '-' . $year] = $month . '-' . $year;
            }
        }

        return $output_array;
    }
	public function fastnote() {
        if($this->input->post()){
				
				$postedData  = $this->input->post();
				$postedData['credit_note_date']  =  date('Y-m-d', strtotime(str_replace('/', '-', $postedData['credit_note_date'])));
                $lastInsertedID = $this->{$this->targetModel}->insert_data($postedData);

        }
        $credit_note_periods = $this->page_config['use_dropdown_columns_options']['credit_note_period_start'];
        $this->load->view('console/credit_note/creditnote_format', array('credit_note_periods'=>$credit_note_periods));
    }

}

?>
