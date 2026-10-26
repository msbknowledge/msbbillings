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
class Stb extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'tax_status';
        $this->targetModel = 'stbs_model';
        $this->moduleMeta = array('cables' => 'Stb');
        $this->page_config['use_dropdown_columns'] = 'stb_mso,stb_type';
        $this->page_config['use_dropdown_columns_options']['stb_mso'] = array(
            'AMBC'=>'AMBC',
            'BARASAT CABLE'=>'BARASAT CABLE',
            'BENGAL BROADBAND'=>'BENGAL BROADBAND',
            'DEN'=>'DEN',
            'DIGI'=>'DIGI',
            'GTPL'=>'GTPL',
            'HATHWAY'=>'HATHWAY',
            'ICNC'=>'ICNC',
            'KCBPL'=>'KCBPL',
            'LINKMEN'=>'LINKMEN',
            'MANTHAN'=>'MANTHAN',
            'NEXT DIGITAL'=>'NEXT DIGITAL',
            'PEARL'=>'PEARL',
            'RELIANCE'=>'RELIANCE',
            'SITI'=>'SITI',
            'SKYVISION'=>'SKYVISION',
         );
        $this->page_config['use_dropdown_columns_options']['stb_type'] = array(
            'ASSIGNED'=>'ASSIGNED',
            'SPARE'=>'SPARE',
            'DEFECTIVE'=>'DEFECTIVE'
         );
        $this->page_config['tablePrimaryKey'] = $this->stbs_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Set top box manager'; //search title bar
        $this->page_config['searchFields'] = 'stb_mso,stb_no,stb_type,stb_vc'; //search box,
        $this->page_config['list_columns'] = 'stb_mso,stb_no,stb_type,stb_vc';
        /*         * end page_config* */
    }

    public function reindex() {
        $data = $this->db->query('select distinct(stb_no),vc_no from customers')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("INSERT INTO `stbs` (`stb_ID`, `stb_vc`, `stb_no`, `stb_mso`, `stb_type`) VALUES (NULL, '".$value['vc_no']."', '".$value['stb_no']."', '', 'ASSIGNED')");
            $this->db->query("INSERT INTO `stbs` (`stb_ID`, `stb_vc`, `stb_no`, `stb_mso`, `stb_type`) VALUES (NULL, '".$value['vc_no']."', '".$value['stb_no']."', '', 'ASSIGNED')");
        }
        redirect('/console/stb');
    }

    public function reindex2() {
        $data = $this->db->query('select * from stbs')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("UPDATE `customers` SET `customer_stb` = '".$value['stb_ID']."' WHERE `customers`.`stb_no` ='".$value['stb_no']."'");
        }
        redirect('/console/stb');
    }

   
    public function tax() {
        pr($this->{$this->targetModel}->reverse_calulate_tax(236));
    }
    public function  fix(){
       $custdata = $this->db->query('select customers.customer_ID,customers.customer_stb,stbs.stb_ID,stbs.stb_vc,stbs.stb_no from stbs JOIN customers ON stbs.stb_ID=customers.customer_stb;')->result_array();   
       foreach ($custdata as $key=>$value){         
        $this->db->query("UPDATE customers SET customer_stb = '" .str_replace("'",'',$value['stb_no'] )." ( ".str_replace("'",'',$value['stb_vc'] )." )' where customer_ID = '".$value['customer_ID']."'");   
       }
    
       
    }
    
}

?>
