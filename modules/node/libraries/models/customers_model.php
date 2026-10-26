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
class Customers_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct()  {
        parent::__construct();
        $this->table_name = 'customers';
        $this->joiningArray[0]['table'] = 'stbs';
        $this->joiningArray[0]['condition'] = 'customer_stb = stb_ID ';
        $this->joiningArray[0]['type'] = 'left';
        $this->check();
    }

    /**
     * get the list of all data in table 
     */
    public function get_merger_list_for_dropdown() {
        $customers = $this->customers_model->get_list_for_dropdown();
        foreach ($customers as $key => $value) {
            $customers[$key] = $value['customer_name'] . ' ( ' . $value['customer_address'] . ' ) ';
        }
        return $customers;
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `customers` (
  `customer_ID` int(11) NOT NULL,
  `customer_code` varchar(50) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_address` varchar(200) DEFAULT NULL,
  `customer_contact` varchar(15) NOT NULL,
  `customer_stb` varchar(100) NOT NULL,
  `customer_activation_date` date NOT NULL,
  `customer_package` longtext NOT NULL,
  `customer_assigned_to` varchar(100) NOT NULL,
  `customer_area` varchar(55) NOT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT '1',
  `customer_last_renew_date` date NOT NULL,
  `customer_deactivation_date` date DEFAULT NULL,
  `customer_mso` varchar(50) DEFAULT NULL,
  `customer_mso_account` varchar(55) NOT NULL,
  `customer_due_date_of_month` int(11) NOT NULL,
  `customer_gst_no` varchar(50) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        $this->db->query("ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_ID`);");
        $this->db->query("ALTER TABLE `customers`
  MODIFY `customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;");
       // die();
    }
    
    public function account_statement($customer_id, $invoice_date) {
		//pr($invoice_date);
        $customer = $this->get_list(array('customer_ID' =>$customer_id ));
        $data['total_invoice_amount_till_date'] = $this->db->query("SELECT sum(invoice_billed_amount)as invoice_bill FROM `invoices` WHERE invoice_date <='" . $invoice_date . "' AND invoice_customer='" . $customer[0]['customer_ID']."'")->result_array();
        $data['total_collection_amount_till_date'] = $this->db->query("SELECT sum(collection_amount)as collected_bill FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer='" . $customer[0]['customer_ID']."'")->result_array();
       
        $data['last_collection_data'] = $this->db->query("SELECT * FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_customer='" . $customer[0]['customer_ID'] . "' ORDER BY collection_date desc limit 0,3")->result_array();
        $data['customerData'] = $customer[0];
        return $data;
    }
     public function expiry(){
         $date=date('Y-m-d');
        
         $data['expiry_day']= $this->db->query("SELECT COUNT(customer_ID) as data_count FROM customers WHERE customer_last_renew_date =DATE_ADD('".$date."' ,INTERVAL 2 DAY)")->result_array();
    
         $data['extended_day']=$this->db->query("SELECT COUNT(customer_ID)as data_count,DATEDIFF('".$date."',`customer_last_renew_date`) as extended_day FROM `customers` WHERE `customer_last_renew_date`< '".$date."' ORDER BY `customer_last_renew_date` ASC")->result_array();
     return($data);    
    }

   
}

?>
