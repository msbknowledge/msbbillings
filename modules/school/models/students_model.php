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
class students_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct()  {
        parent::__construct();
        $this->table_name = 'students';
      
        $this->check();
    }

    /**
     * get the list of all data in table 
     */
    public function get_merger_list_for_dropdown() {
        $students = $this->students_model->get_list_for_dropdown();
        foreach ($students as $key => $value) {
            $students[$key] = $value['student_name'] . ' ( ' . $value['student_address'] . ' ) ';
        }
        return $students;
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `students` (
  `student_ID` int(11) NOT NULL,
  `student_code` varchar(50) DEFAULT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `student_address` varchar(200) DEFAULT NULL,
  `student_contact` varchar(15) NOT NULL,

  `student_activation_date` date NOT NULL,
  `student_package` longtext NOT NULL,
  `student_assigned_to` varchar(100) NOT NULL,
  `student_area` varchar(55) NOT NULL,
  `student_status` tinyint(1) NOT NULL DEFAULT '1',
  `student_last_renew_date` date NOT NULL,
  `student_deactivation_date` date DEFAULT NULL,
  `student_due_date_of_month` int(11) NOT NULL

  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        $this->db->query("ALTER TABLE `students`
  ADD PRIMARY KEY (`student_ID`);");
        $this->db->query("ALTER TABLE `students`
  MODIFY `student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;");
       // die();
    }
    
    public function account_statement($student_id, $invoice_date) {
		//pr($invoice_date);
        $student = $this->get_list(array('student_ID' =>$student_id ));
        $data['total_invoice_amount_till_date'] = $this->db->query("SELECT sum(invoice_billed_amount)as invoice_bill FROM `invoices` WHERE invoice_date <='" . $invoice_date . "' AND invoice_student='" . $student[0]['student_ID']."'")->result_array();
        $data['total_collection_amount_till_date'] = $this->db->query("SELECT sum(collection_amount)as collected_bill FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_student='" . $student[0]['student_ID']."'")->result_array();
       
        $data['last_collection_data'] = $this->db->query("SELECT * FROM `collections` WHERE collection_date <='" . $invoice_date . "' AND collection_student='" . $student[0]['student_ID'] . "' ORDER BY collection_date desc limit 0,3")->result_array();
        $data['studentData'] = $student[0];
        return $data;
    }
     public function expiry(){
         $date=date('Y-m-d');
        
         $data['expiry_day']= $this->db->query("SELECT COUNT(student_ID) as data_count FROM students WHERE student_last_renew_date =DATE_ADD('".$date."' ,INTERVAL 2 DAY)")->result_array();
    
         $data['extended_day']=$this->db->query("SELECT COUNT(student_ID)as data_count,DATEDIFF('".$date."',`student_last_renew_date`) as extended_day FROM `students` WHERE `student_last_renew_date`< '".$date."' ORDER BY `student_last_renew_date` ASC")->result_array();
     return($data);    
    }

   
}

?>
