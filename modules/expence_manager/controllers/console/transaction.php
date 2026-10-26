<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction extends MY_Controller {
    public function __construct() {
        parent::__construct();    

         $this->targetModel = 'transactions_model';
          $this->page_config['title'] = 'transaction'; 
        $this->page_config['use_dropdown_columns'] = 'transaction_type,transaction_user_id';
       $this->page_config['use_dropdown_columns_options']['transaction_type'] =array('credit'=>'Credit','debit'=>'Debit');
        $this->page_config['use_dropdown_columns_options']['transaction_user_id'] =$this->users_model->get_list_for_dropdown('user_firstname');
          $this->page_config['title'] = 'Transaction'; 
           $this->page_config['searchFields'] = 'transaction_user_id,transaction_type,transaction_amount';
           $this->page_config['list_columns'] = 'transaction_type,user_firstname,transaction_date,transaction_amount';
    }
    public function transaction_ammount(){
       //  $this->load->view('transaction_view');
         $postedData = $this->input->post();
         $data['transaction_name'] = $postedData['transaction_name'];
               $data['transaction_type'] = $postedData['transaction_type'];
                $data['transaction_time'] = $postedData['transaction_time'];
                 $data['transaction_ammount'] = $postedData['transaction_amount'];
          $data = $this->transactions_model-> transaction_ammount($data);
     }
    public function transaction_report(){
        $post_data = $this->input->post();
           $start = $this->input->post('start');
        $end = $this->input->post('end');
        $transaction_name = $this->input->post('transaction_name');
        $transaction_type = $this->input->post('transaction_type');
       
        if (!empty($post_data)) {
            $sql = "SELECT * FROM `transactions` "
                    . "join `users` on transactions.transaction_user_id=users.user_ID "
                    . "WHERE 1 = 1 ";

            if (!empty($start)) {
                $sql .= "AND transaction_date >='" . $start . "'";
            }
            if (!empty($end)) {
                $sql .= "AND transaction_date<='" . $end . "'";
            }
             if (!empty($transaction_name)) {
                $sql .= "AND transaction_name like '%" . $transaction_name . "%'";
            }
            if (!empty($transaction_type)) {
                $sql .= "AND transaction_type= '" . $transaction_type . "' ";
            }
            
            $collections = $this->db->query($sql)->result_array();
            
            $alldata = null;
             foreach ($collections as $key => $collection) {
             $data[$key]['transaction_name'] = $collection['transaction_name'];
             $data[$key]['transaction_date'] = $collection['transaction_date'];
              $data[$key]['transaction_type'] = $collection['transaction_type'];
             }
             
           $this->load->view('console/transaction_ajax_report',array('collections'=>$collections));
         
        } 
        else{
           $this->render(null,'transaction_report');
           
        }
           
      
       }
}
?>