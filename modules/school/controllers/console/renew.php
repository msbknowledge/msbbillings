<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @package school
 * @author Kallol
 */
class Renew extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'renew_model';
        $this->moduleMeta = array('schools' => 'school student');
    }

    public function index() {
        $postedData = $this->input->post();
        if (!empty($postedData)) {
            $data['students'] = $this->renew_model->account_renew_student_list($postedData);
            $data['packages'] = $this->renew_model->packages();
            //print_r($data['postedData']);
            $this->load->view('console/renew/renew_table_ajax_tpl', $data);
        } else {
            $this->render(null,'renew_table_tpl');
        }
    }

    public function renew_student() {
        $postedData = $this->input->post();
        $this->renew_model->update($postedData);
        redirect('/console/renew');
    }
    public function renewal_count(){
        $data['students'] = $this->renew_model->account_renew_student_list();
        header('Content-type: application/json');
        echo json_encode($data);
    }

}
