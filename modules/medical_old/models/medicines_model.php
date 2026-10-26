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
class Medicines_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'medicines';
        $this->check();
    }

    public function install() {
       $this->db->query("CREATE TABLE `medicines` (
`medicine_id` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `medicine_manufacturer` varchar(20) NOT NULL,
  `medicine_category` varchar(200) NOT NULL,
  `medicine_hsn` int(11) NOT NULL,
  `medicine_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `medicine_gst` decimal(10,2) NOT NULL,
  `medicine_unit` int(11) NOT NULL,
  `medicine_storage` varchar(200) NOT NULL,
 PRIMARY KEY (`medicine_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
       $this->db->query("INSERT INTO `medicines` (`medicine_id`, `medicine_name`, `medicine_manufacturer`, `medicine_category`, `medicine_hsn`, `medicine_unit`) VALUES
(5, 'RANTAC', 'Abbot', 'Vintage', 4411, 10),
(6, 'CALPOL', 'Abbot', 'MetaLife', 4412, 10);
");
      
    }

    
    public function insert_data($dataToInsert, $isMulti = FALSE) {
        foreach ($dataToInsert as $key => $value) {
            $dataToInsert[$key] = strtoupper($value);
        }
        $this->db->cache_delete_all();
        if ($isMulti) {
            return $this->db->insert_batch($this->table_name, $dataToInsert);
        } else {
            $this->db->insert($this->table_name, $dataToInsert);
            return $this->db->insert_id();
        }
    }
	
	public function duplicate(){
		return $this->db->query('select * from (select count(*) as total,medicine_name   from medicines  group by medicine_name) as s where total > 1  order by medicine_name asc  ')->result_array();
	}	
	
	public function no_unit(){
		return $this->db->query('select * from medicines  where medicine_unit =0  order by medicine_name asc  ')->result_array();
	}	
}

?>
