<?php

class payments_model extends MY_Model {

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'payments';
         $this->joiningArray[0]['table'] = 'customers';
         $this->joiningArray[0]['condition'] = 'customer_ID= payment_user_id ';  
         $this->check();

    }

    public function install() {
        $this->db->query("CREATE TABLE `payments` (
        `payment_ID` int(11) NOT NULL AUTO_INCREMENT,
        `payment_user_id` int(11) NOT NULL,
        `payment_timestamp` datetime NOT NULL,
        `payment_amount` int(50) NOT NULL, 
        PRIMARY KEY (`payment_ID`)
         ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
    }
    

}

?>
