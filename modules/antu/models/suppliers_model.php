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
class Suppliers_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'suppliers';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `suppliers` (
        `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
        `supplier_name` varchar(100) NOT NULL,
        `supplier_address` varchar(200) NOT NULL,
        `supplier_contact` varchar(200) NOT NULL,
        `supplier_gst` varchar(50) NOT NULL,
        PRIMARY KEY (`supplier_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
        
// $this->db->query("INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`, `supplier_gst`) VALUES
//     (1, 'Supplier A', 'Address A', '1234567890', 'GST0001'),
//     (2, 'Supplier B', 'Address B', '1234567891', 'GST0002'),
//     (3, 'Supplier C', 'Address C', '1234567892', 'GST0003'),
//     (4, 'Supplier D', 'Address D', '1234567893', 'GST0004'),
//     (5, 'Supplier E', 'Address E', '1234567894', 'GST0005'),
//     (6, 'Supplier F', 'Address F', '1234567895', 'GST0006'),
//     (7, 'Supplier G', 'Address G', '1234567896', 'GST0007'),
//     (8, 'Supplier H', 'Address H', '1234567897', 'GST0008'),
//     (9, 'Supplier I', 'Address I', '1234567898', 'GST0009'),
//     (10, 'Supplier J', 'Address J', '1234567899', 'GST0010'),
//     (11, 'Supplier K', 'Address K', '1234567800', 'GST0011'),
//     (12, 'Supplier L', 'Address L', '1234567801', 'GST0012'),
//     (13, 'Supplier M', 'Address M', '1234567802', 'GST0013'),
//     (14, 'Supplier N', 'Address N', '1234567803', 'GST0014'),
//     (15, 'Supplier O', 'Address O', '1234567804', 'GST0015'),
//     (16, 'Supplier P', 'Address P', '1234567805', 'GST0016'),
//     (17, 'Supplier Q', 'Address Q', '1234567806', 'GST0017'),
//     (18, 'Supplier R', 'Address R', '1234567807', 'GST0018'),
//     (19, 'Supplier S', 'Address S', '1234567808', 'GST0019'),
//     (20, 'Supplier T', 'Address T', '1234567809', 'GST0020'),
//     (21, 'Supplier U', 'Address U', '1234567810', 'GST0021'),
//     (22, 'Supplier V', 'Address V', '1234567811', 'GST0022'),
//     (23, 'Supplier W', 'Address W', '1234567812', 'GST0023'),
//     (24, 'Supplier X', 'Address X', '1234567813', 'GST0024'),
//     (25, 'Supplier Y', 'Address Y', '1234567814', 'GST0025'),
//     (26, 'Supplier Z', 'Address Z', '1234567815', 'GST0026'),
//     (27, 'Supplier AA', 'Address AA', '1234567816', 'GST0027'),
//     (28, 'Supplier AB', 'Address AB', '1234567817', 'GST0028'),
//     (29, 'Supplier AC', 'Address AC', '1234567818', 'GST0029'),
//     (30, 'Supplier AD', 'Address AD', '1234567819', 'GST0030'),
//     (31, 'Supplier AE', 'Address AE', '1234567820', 'GST0031'),
//     (32, 'Supplier AF', 'Address AF', '1234567821', 'GST0032'),
//     (33, 'Supplier AG', 'Address AG', '1234567822', 'GST0033'),
//     (34, 'Supplier AH', 'Address AH', '1234567823', 'GST0034'),
//     (35, 'Supplier AI', 'Address AI', '1234567824', 'GST0035'),
//     (36, 'Supplier AJ', 'Address AJ', '1234567825', 'GST0036'),
//     (37, 'Supplier AK', 'Address AK', '1234567826', 'GST0037'),
//     (38, 'Supplier AL', 'Address AL', '1234567827', 'GST0038'),
//     (39, 'Supplier AM', 'Address AM', '1234567828', 'GST0039'),
//     (40, 'Supplier AN', 'Address AN', '1234567829', 'GST0040'),
//     (41, 'Supplier AO', 'Address AO', '1234567830', 'GST0041'),
//     (42, 'Supplier AP', 'Address AP', '1234567831', 'GST0042'),
//     (43, 'Supplier AQ', 'Address AQ', '1234567832', 'GST0043'),
//     (44, 'Supplier AR', 'Address AR', '1234567833', 'GST0044'),
//     (45, 'Supplier AS', 'Address AS', '1234567834', 'GST0045'),
//     (46, 'Supplier AT', 'Address AT', '1234567835', 'GST0046'),
//     (47, 'Supplier AU', 'Address AU', '1234567836', 'GST0047'),
//     (48, 'Supplier AV', 'Address AV', '1234567837', 'GST0048'),
//     (49, 'Supplier AW', 'Address AW', '1234567838', 'GST0049'),
//     (50, 'Supplier AX', 'Address AX', '1234567839', 'GST0050');");
        
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
}

?>
