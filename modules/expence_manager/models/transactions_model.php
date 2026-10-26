<?php

class Transactions_model extends MY_Model {

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'transactions';
         $this->joiningArray[0]['table'] = 'users';
         $this->joiningArray[0]['condition'] = 'transaction_user_id = user_ID ';
         
       $this->check();

    }

    public function install() {
        $this->db->query("CREATE TABLE`transactions` (
                 `transaction_ID` int(11) NOT NULL AUTO_INCREMENT,
                 `transaction_user_id` int(11) NOT NULL,
                 `transaction_name` varchar(20) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_amount` int(50) NOT NULL, 
  `transaction_note` varchar(100) NOT NULL,
   PRIMARY KEY (`transaction_ID`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
    }
 public function get_dropdown() {
    $data['joindata']= $this->db->query("select transaction_ID,transaction_name,transaction_type,transaction_date,transaction_amount,user_firstname,user_lastname from transactions join users on transactions.transaction_user_id=users.user_ID");
        foreach ($user as $key => $value) {
            $user[$key] = $value['user_firstname'] . ' ( ' . $value['user_lastname'] . ' ) ';
        }
        return $user;
    }
    public function transaction_ammount() {
        $data['alldata'] = $this->db->query("select transaction_name,transaction_type,transaction_amount,transaction_date from transactions where transaction_name like '%" . $name . "%' ")->result_array();
        
        return $data;
    }
    

}

?>