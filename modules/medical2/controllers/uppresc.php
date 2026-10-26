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
class Uppresc extends MY_Controller {

    //put your code here
    public $publicAccess = array('index');

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'prescription_model';
        $this->moduleMeta = array('medical2' => 'prescription');
    }
    public function index(){
        $this->load->view('console/prescription/view_detail');
    }

    public function do_upload(){
        
        $data1 = array(
            'Name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'note' => $this->input->post('note'),
            'image_capture' =>$this->input->post('image')
        );  
        $result= $this->db->insert('tb_prescription', $data1);;
        if ($result == TRUE) {
            echo "success";
        }
        }
    
}?>