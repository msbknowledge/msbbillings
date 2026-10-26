<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Kallol
 */
class Cable_stb extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

       
        $this->targetModel = 'cable_stbs_model';
        $this->moduleMeta = array('cables' => 'cable_Stb');
        $this->page_config['use_dropdown_columns'] = 'stb_mso,stb_type';
        $this->page_config['use_dropdown_columns_options']['stb_mso'] = array(
            'SITI'=>'SITI',
            'GTPL'=>'GTPL',
            'DEN'=>'DEN',
            'MANTHAN'=>'MANTHAN',
            'DIGI'=>'DIGI'
         );
        $this->page_config['use_dropdown_columns_options']['stb_type'] = array(
            'ASSIGNED'=>'ASSIGNED',
            'SPARE'=>'SPARE',
            'DEFECTIVE'=>'DEFECTIVE'
         );
        $this->page_config['tablePrimaryKey'] = $this->cable_stbs_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Set top box manager'; //search title bar
        $this->page_config['searchFields'] = 'stb_mso,stb_no,stb_type,stb_vc'; //search box,
        $this->page_config['list_columns'] = 'stb_mso,stb_no,stb_type,stb_vc';
        /*         * end page_config* */
    }

    public function reindex() {
        $data = $this->db->query('select distinct(stb_no),vc_no from cable_customers')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("INSERT INTO `cable_stbs` (`stb_ID`, `stb_vc`, `stb_no`, `stb_mso`, `stb_type`) VALUES (NULL, '".$value['vc_no']."', '".$value['stb_no']."', '', 'ASSIGNED')");
            $this->db->query("INSERT INTO `cable_stbs` (`stb_ID`, `stb_vc`, `stb_no`, `stb_mso`, `stb_type`) VALUES (NULL, '".$value['vc_no']."', '".$value['stb_no']."', '', 'ASSIGNED')");
        }
        redirect('/console/cable_stb');
    }

    public function reindex2() {
        $data = $this->db->query('select * from cable_stbs')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("UPDATE `cable_customers` SET `customer_stb` = '".$value['stb_ID']."' WHERE `customers`.`stb_no` ='".$value['stb_no']."'");
        }
        redirect('/console/cable_stb');
    }

  }

?>
