<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @package cable
 * @author Kallol
 */
class Renew extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'renew_model';
        $this->moduleMeta = array('cables' => 'Cable Lco');
    }

    public function index() {
        $postedData = $this->input->post();
        if (!empty($postedData)) {
          //  pr($postedData,1);
            $data['lcos'] = $this->renew_model->account_renew_lco_list($postedData);
            $data['packages'] = $this->renew_model->packages();
            $this->load->view('console/renew/renew_table_ajax_tpl', $data);
        } else {
            $this->render(null,'renew_table_tpl');
        }
    }

    public function renew_lco() {
        $postedData = $this->input->post();
        $this->renew_model->update($postedData);
        redirect('/console/renew');
    }

}
