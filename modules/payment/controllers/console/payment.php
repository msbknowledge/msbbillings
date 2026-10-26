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
class Payment extends MY_Controller {

    //put your code here

//     public function __construct() {
//         parent::__construct();
// 	//$this->load_model('payments_model');
// 	//$this->targetModel = 'payments_model';
//         //$this->targetModel = 'user_types_model';
//         //$this->page_config['tablePrimaryKey'] = $this->user_types_model->get_primary_key(); //pk
//         /*         * page_config* */
//         //$this->page_config['title'] = 'User Type'; //search title bar
//         //$this->page_config['searchFields'] = 'user_type_name'; //search box,

//         /*         * end page_config* */
//     }
  public function __construct() {
        parent::__construct();

        $this->targetModel = 'payments_model';
        $this->moduleMeta = array('payment' => 'Collection');
      
        $this->page_config['title'] = 'Payment'; //search title bar
        $this->page_config['searchFields'] = 'payment_ID,payment_user_ID,payment_amount'; //search box,
        $this->page_config['list_columns'] = 'payment_ID,payment_user_ID,payment_amount';

        /*         * end page_config* */
    }


      public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }
    
     public function report()
    {

        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $transaction_member = $this->input->post('transaction_user_id');
        $member_address = $this->input->post('customer_address');
        $transaction_processed_by = $this->input->post('transaction_processed_by');

        #echo $package_name;
        if (!empty($this->input->post())) { 
            $sql = "SELECT * FROM `transactions` "
                . "join `customers` on transactions.transaction_user_id=customers.customer_ID "
                . "join `users` on transactions.transaction_processed_by=users.user_ID "

                . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= " AND transaction_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND transaction_date<='" . $period_end . "'";
            }
            if (!empty($transaction_processed_by)) {
                $sql .= " AND transaction_processed_by =" . $transaction_processed_by;
            }
            if (!empty($transaction_member)) {
                $sql .= " AND transaction_member =" . $transaction_member;
            }
            if (!empty($member_address)) {
                $sql .= " AND member_address like '%" . $member_address . "%'";
            }
            $collections = $this->db->query($sql)->result_array();
            $customer_data = null;
            foreach ($collections as $key => $collection) {
                $customer_data[$key]['member_name'] = $collection['member_name'];
                $customer_data[$key]['member_code'] = $collection['member_code'];
                $customer_data[$key]['member_address'] = $collection['member_address'];
                $customer_data[$key]['transaction_date'] = $collection['transaction_date'];
                $customer_data[$key]['transaction_type'] = $collection['transaction_type'];
                $customer_data[$key]['transaction_amount'] = $collection['transaction_amount'];

                $customer_data[$key]['transaction_note'] = $collection['transaction_note'];
                $customer_data[$key]['user_firstname'] = $collection['user_firstname'];
                $customer_data[$key]['member_status'] = $collection['member_status'];
            }
            //    pr($customer_data,1);
        }

        $members = $this->members_model->get_list();
        $collection_agent = $this->users_model->get_list();


        if ($this->input->post()) {
            $this->load->view('console/report/collection_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/report/collection_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'members' => $members, 'collection_agent' => $collection_agent));
        }
    }
 
     public function collection_report()
    {

        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $transaction_member = $this->input->post('transaction_member_id');
        $member_address = $this->input->post('member_address');
        $transaction_processed_by = $this->input->post('transaction_processed_by');

        #echo $package_name;
        if (!empty($this->input->post())) { 
            $sql = "SELECT * FROM `transactions` "
                . "join `members` on transactions.transaction_member=members.member_ID "
                . "join `users` on transactions.transaction_processed_by=users.user_ID "

                . "WHERE 1 = 1 ";

            if (!empty($period_start)) {
                $sql .= " AND transaction_date >='" . $period_start . "'";
            }
            if (!empty($period_end)) {
                $sql .= " AND transaction_date<='" . $period_end . "'";
            }
            if (!empty($transaction_processed_by)) {
                $sql .= " AND transaction_processed_by =" . $transaction_processed_by;
            }
            if (!empty($transaction_member)) {
                $sql .= " AND transaction_member =" . $transaction_member;
            }
            if (!empty($member_address)) {
                $sql .= " AND member_address like '%" . $member_address . "%'";
            }
            $collections = $this->db->query($sql)->result_array();
            $customer_data = null;
            foreach ($collections as $key => $collection) {
                $customer_data[$key]['member_name'] = $collection['member_name'];
                $customer_data[$key]['member_code'] = $collection['member_code'];
                $customer_data[$key]['member_address'] = $collection['member_address'];
                $customer_data[$key]['transaction_date'] = $collection['transaction_date'];
                $customer_data[$key]['transaction_type'] = $collection['transaction_type'];
                $customer_data[$key]['transaction_amount'] = $collection['transaction_amount'];

                $customer_data[$key]['transaction_note'] = $collection['transaction_note'];
                $customer_data[$key]['user_firstname'] = $collection['user_firstname'];
                $customer_data[$key]['member_status'] = $collection['member_status'];
            }
            //    pr($customer_data,1);
        }

        $members = $this->members_model->get_list();
        $collection_agent = $this->users_model->get_list();


        if ($this->input->post()) {
            $this->load->view('console/report/collection_ajax_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'collected_data' => $collected_data));
        } else {
            $this->load->view('console/report/collection_report_tpl', array('customer_data' => $customer_data, 'start' => $period_start, 'end' => $period_end, 'members' => $members, 'collection_agent' => $collection_agent));
        }
    }

    //---------------------------------------------------------------
    
    protected function mailInvoice($mailMeta, $printDebug = FALSE, $use_defined_config = NULL) {

        $this->load->library('email');
        /*         * send mail config* */
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.logicmystery.com';
        $config['smtp_user'] = 'no-reply@logicmystery.com';
        $config['smtp_pass'] = 'dHpR(zu5';

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        if (is_array($use_defined_config))
            $config = array_merge($config, $use_defined_config);
        $this->email->initialize($config);
        /*         * send mail config* */

        /*         * mail formating* */
        if (!isset($mailMeta['from']['email'])) {
            $mailMeta['from']['email'] = 'no-reply@logicmystery.com';
        }

        if (!isset($mailMeta['from']['name'])) {
            $mailMeta['from']['name'] = 'Do not Reply';
        }

        $this->email->from($mailMeta['from']['email'], isset($mailMeta['from']['name']) ? $mailMeta['from']['name'] : NULL);
        if (isset($mailMeta['reply_to']['email']))
            $this->email->reply_to($mailMeta['reply_to']['email'], isset($mailMeta['reply_to']['name']) ? $mailMeta['reply_to']['name'] : NULL);

        if (isset($mailMeta['to']))
            $this->email->to($mailMeta['to']);

        if (isset($mailMeta['cc']))
            $this->email->cc($mailMeta['cc']);

        if (isset($mailMeta['bcc']))
            $this->email->bcc($mailMeta['bcc']);

        $this->email->subject(isset($mailMeta['subject']) ? $mailMeta['subject'] : '');
        $this->email->message(isset($mailMeta['body']) ? $mailMeta['body'] : '');

        $sendMailStatus = $this->email->send();
        if ($printDebug)
            echo $this->email->print_debugger();
        return $sendMailStatus;
    }
    /**
     * non generic functions
     * * */
}

?>
