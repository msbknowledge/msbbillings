<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @package internet
 * @author Kallol
 */
class Internet_renew extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'internet_renew_model';
        $this->moduleMeta = array('internet' => 'Internet Customer');
    }

    public function index() {
        $postedData = $this->input->post();
        if (!empty($postedData)) {
            $data['customers'] = $this->internet_renew_model->account_renew_customer_list($postedData);
            $data['packages'] = $this->internet_renew_model->packages();
            $this->load->view('console/internet_renew/renew_table_ajax_tpl', $data);
        } else {
            $this->render(null,'renew_table_tpl');
        }
    }

    public function renew_customer() {
        $postedData = $this->input->post();
        $this->internet_renew_model->update($postedData);
        redirect('/console/internet_renew');
    }

}
