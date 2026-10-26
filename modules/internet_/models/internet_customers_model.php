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
class Internet_customers_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'internet_customers';
        $this->check();
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `internet_customers` (
			    `customer_ID` int(11) NOT NULL AUTO_INCREMENT,
                `customer_name` varchar(50) DEFAULT NULL,
                `customer_ip` varchar(25) NOT NULL,
                `customer_user_name` varchar(20) NOT NULL,
                `customer_address` varchar(200) DEFAULT NULL,
                `customer_area` varchar(55) DEFAULT NULL,
                `customer_contact` varchar(15) NOT NULL,
                `customer_email` varchar(200) DEFAULT NULL,
                `customer_package` varchar(255) NOT NULL,
                `customer_code` varchar(100) NOT NULL,
                `customer_isp` varchar(20) DEFAULT NULL,
                `customer_isp_account` varchar(55) NOT NULL,
                `customer_status` tinyint(1) NOT NULL DEFAULT '1',
                `customer_last_renew_date` date NOT NULL,
                `customer_activation_date` date NOT NULL,
                `customer_deactivation_date` date DEFAULT NULL,
                `customer_is_free` tinyint(1) DEFAULT NULL,
			  PRIMARY KEY (`customer_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
			");
       
    }
    
 public function account_statement($customer_id, $invoice_date) {
    
    
        $customer = $this->get_list(array('customer_ID' =>$customer_id ));
        $data['total_invoice_amount_till_date'] = $this->db->query("SELECT sum(invoice_billed_amount)as invoice_bill FROM `internet_invoices` WHERE invoice_date <='" . $invoice_date . "' AND invoice_customer=" . $customer[0]['customer_ID'])->result_array();
       
        $data['total_collection_amount_till_date'] = $this->db->query("SELECT sum(collection_amount)as collected_bill FROM `internet_collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer=" . $customer[0]['customer_ID'])->result_array();
        
        $data['last_collection_data'] = $this->db->query("SELECT * FROM `internet_collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer=" . $customer[0]['customer_ID'] . " ORDER BY collection_date desc limit 0,3")->result_array();
       // $data['last_collection_data'] = $this->db->query("SELECT * FROM (SELECT * FROM `internet_collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer=" . $customer[0]['customer_ID'] . " ORDER BY collection_date desc limit 0,3) AS r ORDER BY collection_date ASC")->result_array();
      

        $data['customerData'] = $customer[0];
       
        return $data;
    }
    public function expiry(){
         $date=date('Y-m-d');
        
         $data['expiry_day']= $this->db->query("SELECT COUNT(customer_ID) as data_count FROM internet_customers WHERE customer_last_renew_date =DATE_ADD('".$date."' ,INTERVAL 2 DAY)")->result_array();
    
         $data['extended_day']=$this->db->query("SELECT COUNT(customer_ID)as data_count,DATEDIFF('".$date."',`customer_last_renew_date`) as extended_day FROM `internet_customers` WHERE `customer_last_renew_date`< '".$date."' ORDER BY `customer_last_renew_date` ASC")->result_array();
     return($data);    
    }
}
