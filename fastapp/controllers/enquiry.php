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
 * @author Bapan Roy
 */
class Enquiry extends MY_Controller {

    //put your code here
      public $publicAccess = array('enquiry','contact', 'enquiry_status');

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'enquiry_model';
        $this->page_config['tablePrimaryKey'] = $this->enquiry_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Option'; //search title bar
        $this->page_config['searchFields'] = 'user_name,email,mobile'; //search box,
        $this->page_config['list_columns'] = 'user_name,email,mobile,status';

        /*         * end page_config* */
    }
     public function contact() {
        $postedData = $this->input->post();
        if ($postedData) {
           
            $userData = $userData = array(
                
                'user_name' => trim($postedData['user_name']),
                'email' => trim($postedData['email']),
                'mobile' => trim($postedData['mobile']),
            );
            if ($userData) {
               
                $last_inserted_id = $this->enquiry_model->insert_data($userData);
            if ($last_inserted_id) {
                $userData = $this->enquiry_model->get_list(array('enquiry_id' => $this->db->insert_id()));
                $this->session->set_userdata('current_user_session', $userData);
                echo json_encode(array('status' => 'success', 'message' => 'Success Enquiry'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Fatal Error'));
            }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed'));
            }
        } else {
            redirect(base_url());
            $this->render();
        }
    }

}

?>
