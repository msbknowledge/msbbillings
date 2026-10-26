<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_settings_model
 *
 * @author kALLOL
 * 
 * 
 */
class Invoices_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'invoices';
        $this->joiningArray[0]['table'] = 'customers';
        $this->joiningArray[0]['condition'] = 'invoice_customer = customer_ID';
        $this->check();
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `invoices` (
		  `invoice_ID` int(11) NOT NULL AUTO_INCREMENT,
		  `invoice_customer` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_due_date` date NOT NULL,
  `invoice_for` varchar(100) NOT NULL,
  `invoice_billed_amount` decimal(10,2) NOT NULL,
  `invoice_tax_amount` decimal(10,2) NOT NULL,
  `invoice_note` text NOT NULL,
  `invoice_entry_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_meta` text NOT NULL,
		  PRIMARY KEY (`invoice_ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
		");
    }

    /**
     * 
     * * */
    public function total_invoice_amount($param = NULL) {
        if ($param)
            $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices` WHERE  MONTH(`invoice_date`) = $param");
        else
            $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices`");
        $results = $query->result_array();
        return $results[0]['total_colected_amount'];
    }

    public function total_billed_amount($invoice_period = null) {
        if ($invoice_period) {
            $query = $this->db->query("SELECT sum(`invoice_billed_amount`) as total_billed_amount FROM `invoices` WHERE  `invoice_period` = '$invoice_period'");
        } else {
            $query = $this->db->query("SELECT sum(`invoice_billed_amount`) as total_billed_amount FROM `invoices` ");
        }

        $results = $query->result_array();
        return $results[0]['total_billed_amount'];
    }

    public function customer_due($customer_id = NULL, $beforeDate = FALSE) {
        /*         * total billed amount */
        if ($beforeDate)
            $query = $this->db->query("SELECT sum(`invoice_billed_amount`) as total_billed_amount,sum(`invoice_paid_amount`) as total_paid_amount FROM `invoices` where invoice_customer = $customer_id and invoice_date < '$beforeDate'");
        else
            $query = $this->db->query("SELECT sum(`invoice_billed_amount`) as total_billed_amount,sum(`invoice_paid_amount`) as total_paid_amount FROM `invoices` where invoice_customer = $customer_id");
        $results = $query->result_array();
        return $results[0]['total_billed_amount'] - $results[0]['total_paid_amount'];
        /*         * total reciept amount* */
    }

    public function total_collection_amount($param = NULL, $period = NULL) {

        $param = date('Y-m-d');
        $year = date('Y');
        $month = date('m');

        switch ($period) {
            case 'YEAR':
                $year = date('Y');
                $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices` WHERE  YEAR(`invoice_collection_date`) = $year");
                break;
            case 'MONTH':
                $month = date('m');
                $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices` WHERE  MONTH(`invoice_collection_date`) = $month and YEAR(`invoice_collection_date`) = $year");
                break;
            case 'YEARWEEK':
                $yearweek = date('oW');
                $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices` WHERE  YEARWEEK(`invoice_collection_date`,3) = '$yearweek' and YEAR(`invoice_collection_date`) = $year");
                break;
            case 'DAILY':
                $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices` WHERE  `invoice_collection_date` = '$param'");
                break;
            case 'INVOICE_PERIOD':
                $query = $this->db->query("SELECT sum(`invoice_paid_amount`)  as total_colected_amount FROM `invoices` WHERE   invoice_paid_amount > 0 and `invoice_period` = '" . date('F-y') . "'");
                break;
            default:
                $query = $this->db->query("SELECT sum(`invoice_paid_amount`) as total_colected_amount FROM `invoices`");
                break;
        }


        $results = $query->result_array();
        return floatval($results[0]['total_colected_amount']);
    }

    public function total_due_amount($param = NULL, $period = NULL) {
        $invoice_period = date('F-y');
        $query = $this->db->query("SELECT sum(`invoice_due_amount`) as total_due_amount FROM `invoices` WHERE  `invoice_period` = '$invoice_period'");
        $results = $query->result_array();
        return floatval($results[0]['total_due_amount']);
    }

}

?>
