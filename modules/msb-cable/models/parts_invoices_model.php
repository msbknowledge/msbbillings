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
class Parts_invoices_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'parts_invoices';
       $this->joiningArray[0]['table'] = 'customers';
        $this->joiningArray[0]['condition'] = '	part_customer_id = customer_ID ';
    $this->check();
    }
 public function install() {
       $this->db->query("CREATE TABLE `parts_invoices` (
  `part_invoice_id` int(100) NOT NULL,
  `part_customer_id` int(50) NOT NULL,
  `part_invoice_no` varchar(50) NOT NULL,
  `invoice_advance_amount` decimal(10,2) NOT NULL,
  `invoice_due_amount` decimal(10,2) NOT NULL,
  `invoice_collected_by` varchar(50) NOT NULL,
  `invoice_collection_date` date NOT NULL,
  `invoice_billed_amount` decimal(10,2) NOT NULL,
  `invoice_paid_amount` decimal(10,2) NOT NULL,
  `part_invoice_meta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


        $this->db->query("INSERT INTO `parts_invoices` (`part_invoice_id`, `part_customer_id`, `part_invoice_no`, `invoice_advance_amount`, `invoice_due_amount`, `invoice_collected_by`, `invoice_collection_date`, `invoice_billed_amount`, `invoice_paid_amount`, `part_invoice_meta`) VALUES
(10, 254, 'BBSC-2017-Mar-254', '0.00', '0.00', 'Office', '0000-00-00', '120.00', '0.00', ''),
(11, 764, 'BBSC-2017-Mar-764', '0.00', '0.00', 'Office', '0000-00-00', '120.00', '0.00', ''),
(14, 109, 'BBSC-2017-Mar-109', '0.00', '0.00', 'Office', '0000-00-00', '40.00', '0.00', ''),
(15, 109, 'BBSC-2017-Mar-109', '0.00', '0.00', 'Office', '0000-00-00', '40.00', '0.00', ''),
(18, 704, 'BBSC-2017-Mar-704', '0.00', '0.00', 'Office', '0000-00-00', '120.00', '0.00', ''),
(19, 0, '', '0.00', '0.00', 'Office', '2017-05-16', '0.00', '0.00', ''),
(31, 19, '', '0.00', '20.00', 'Office', '2017-05-21', '150.00', '130.00', '{\"invoiceNo\":\"BBSC-2017-May-19\",\"invoice_date\":\"2017-05-21\",\"customer_name\":\"RABIN GOUTAM DAS\",\"part_customer_id\":\"19\",\"invoice_billed_amount\":\"150\",\"customer_address\":\"s n pal ROAD, ARIADAHA\",\"customer_contact\":\"\",\"part_name\":[\"REMOTE N1\"],\"part_qty\":[\"1\"],\"part_rate\":[\"150.00\"],\"part_amount\":[\"150.00\"],\"subtotal\":\"150\",\"discount\":\"0.00\",\"total\":\"150\",\"round\":\"150\",\"invoice_previous_due_amount\":\"0.00\",\"invoice_previous_advance_amount\":\"0.00\",\"invoice_payable_amount\":\"150\",\"round_word\":\"ONE HUNDRED FIFTY \",\"invoice_collected_by\":\"Office\",\"invoice_collection_date\":\"2017-05-21\",\"invoice_note\":\"\",\"invoice_paid_amount\":\"130\",\"invoice_due_amount\":\"20\",\"invoice_advance_amount\":\"0\"}');");
       
        $this->db->query("ALTER TABLE `parts_invoices`
  ADD PRIMARY KEY (`part_invoice_id`);");
        $this->db->query("ALTER TABLE `parts_invoices`
  MODIFY `part_invoice_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
        
    }
 
}

?>
