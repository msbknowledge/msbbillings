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
class stock_issues_model extends MY_Model {
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'stock_issues';
        $this->check();
    }
    public function install() {
        $query = $this->db->query(" CREATE TABLE `stock_issues` (
        `stock_issue_ID` int(11) AUTO_INCREMENT PRIMARY KEY,
        `stock_issue_month` varchar(20) NOT NULL,
        `stock_issue_date` date NOT NULL,
        `stock_issue_lco` varchar(50) NOT NULL,
        `stock_issue_challan_no` varchar(20) NOT NULL,
        `stock_issue_stb_sd` varchar(20) NOT NULL,
        `stock_issue_stb_hd` varchar(20) NOT NULL,
        `stock_issue_vc_card` varchar(20) NOT NULL,
        `stock_issue_remote` varchar(20) NOT NULL,
        `stock_issue_adaptor` varchar(20) NOT NULL,
        `stock_issue_av_cord` varchar(20) NOT NULL,
        `stock_issue_hdmi_cord` varchar(20) NOT NULL,
        `stock_issue_remarks` varchar(20) NOT NULL
       )ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    }

   
}
