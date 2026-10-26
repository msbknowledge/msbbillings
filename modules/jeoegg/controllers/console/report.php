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
class Report extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

	$this->load_model('members');
        //$this->targetModel = 'user_types_model';
        //$this->page_config['tablePrimaryKey'] = $this->user_types_model->get_primary_key(); //pk
        /*         * page_config* */
        //$this->page_config['title'] = 'User Type'; //search title bar
        //$this->page_config['searchFields'] = 'user_type_name'; //search box,

        /*         * end page_config* */
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
    /**
     * non generic functions
     * * */
}

?>
