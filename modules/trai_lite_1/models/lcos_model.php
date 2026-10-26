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
class Lcos_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct()  {
        parent::__construct();
        $this->table_name = 'lcos';
        $this->joiningArray[0]['table'] = 'stbs';
        $this->joiningArray[0]['condition'] = 'stb_lco_id = lco_ID';
        $this->joiningArray[0]['type'] = 'left';
        $this->check();
    }

    /**
     * get the list of all data in table 
     */
    public function get_merger_list_for_dropdown() {
        $lcos = $this->lcos_model->get_list_for_dropdown();
        foreach ($lcos as $key => $value) {
            $lcos[$key] = $value['lco_name'] . ' ( ' . $value['lco_address'] . ' ) ';
        }
        return $lcos;
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `lcos` (
  `lco_ID` int(11) NOT NULL,
  `lco_code` varchar(50) DEFAULT NULL,
  `lco_name` varchar(50) DEFAULT NULL,
  `lco_address` varchar(200) DEFAULT NULL,
  `lco_contact` varchar(15) NOT NULL,
  `lco_activation_date` date NOT NULL,
  `lco_package` longtext NOT NULL,
  `lco_area` varchar(55) NOT NULL,
  `lco_status` tinyint(1) NOT NULL DEFAULT '1',
  `lco_last_renew_date` date NOT NULL,
  `lco_deactivation_date` date DEFAULT NULL,
  `lco_due_date_of_month` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        $this->db->query("ALTER TABLE `lcos`
  ADD PRIMARY KEY (`lco_ID`);");
        $this->db->query("ALTER TABLE `lcos`
  MODIFY `lco_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;");
       // die();
    }
    
    public function account_statement($lco_id, $invoice_date) {
		//pr($invoice_date);
        $lco = $this->get_list(array('lco_ID' =>$lco_id ));
        $data['total_invoice_amount_till_date'] = $this->db->query("SELECT sum(invoice_billed_amount)as invoice_bill FROM `invoices` WHERE invoice_date <='" . $invoice_date . "' AND invoice_lco='" . $lco[0]['lco_ID']."'")->result_array();
        $data['total_collection_amount_till_date'] = $this->db->query("SELECT sum(collection_amount)as collected_bill FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_lco='" . $lco[0]['lco_ID']."'")->result_array();
       
        $data['last_collection_data'] = $this->db->query("SELECT * FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_lco='" . $lco[0]['lco_ID'] . "' ORDER BY collection_date desc limit 0,3")->result_array();
        $data['lcoData'] = $lco[0];
        return $data;
    }
     public function expiry(){
         $date=date('Y-m-d');
        
         $data['expiry_day']= $this->db->query("SELECT COUNT(lco_ID) as data_count FROM lcos WHERE lco_last_renew_date =DATE_ADD('".$date."' ,INTERVAL 2 DAY)")->result_array();
    
         $data['extended_day']=$this->db->query("SELECT COUNT(lco_ID)as data_count,DATEDIFF('".$date."',`lco_last_renew_date`) as extended_day FROM `lcos` WHERE `lco_last_renew_date`< '".$date."' ORDER BY `lco_last_renew_date` ASC")->result_array();
     return($data);    
    }

   
}

?>
