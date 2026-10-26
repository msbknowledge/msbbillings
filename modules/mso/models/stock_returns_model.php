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
class stock_returns_model extends MY_Model {

    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'stock_returns';
        $this->check();
    }
    public function install() {
        $query = $this->db->query(" CREATE TABLE `stock_returns` (
        `stock_return_ID` int(11) NOT NULL AUTO_INCREMENT,
        `stock_return_month` varchar(20) NOT NULL,
        `stock_return_date` date NOT NULL,
        `stock_return_lco` varchar(50) NOT NULL,
        `stock_return_challan_no` varchar(20) NOT NULL,
        `stock_return_stb_sd` varchar(20) NOT NULL,
        `stock_return_stb_hd` varchar(20) NOT NULL,
        `stock_return_vc_card` varchar(20) NOT NULL,
        `stock_return_remote` varchar(20) NOT NULL,
        `stock_return_adaptor` varchar(20) NOT NULL,
        `stock_return_av_cord` varchar(20) NOT NULL,
        `stock_return_hdmi_cord` varchar(20) NOT NULL,
        `stock_return_remarks` varchar(20) NOT NULL,
        PRIMARY KEY (`stock_return_ID`)
       )ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");
    }

   
}
