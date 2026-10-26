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
        $this->page_config['use_dropdown_columns'] = 'stb_type,stb_status,stb_lco_id';
       
         $this->page_config['use_dropdown_columns_options']['stb_lco_id'] = $this->get_lco($data);
         $this->page_config['use_dropdown_columns_options']['stb_type'] = array(
            'SD'=>'SD',
            'HD'=>'HD'
         );
         $this->page_config['use_dropdown_columns_options']['stb_status'] = array(
            'ASSIGNED'=>'ASSIGNED',
            'SPARE'=>'SPARE',
            'DEFECTIVE'=>'DEFECTIVE'
         );
        $this->page_config['tablePrimaryKey'] = $this->stbs_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Set top box manager'; //search title bar
        $this->page_config['searchFields'] = 'stb_no,stb_lco_id,stb_type,stb_status,stb_vc'; //search box,
        $this->page_config['list_columns'] = 'stb_no,stb_lco_id,stb_type,stb_status,stb_vc';
        /*         * end page_config* */
    }

    public function get_lco(){
       $lco =  $this->lcos_model->get_list() ;
       $data = null;
       foreach ($lco as $key => $value) {
           # code...
           $data[$value['lco_ID']] = $value['lco_name'].' ('.$value['lco_code'].')';
       }
       return $data;
    }
    public function reindex() {
        $data = $this->db->query('select distinct(stb_no),vc_no from lcos')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("INSERT INTO `stbs` (`stb_ID`, stb_lco_code, `stb_vc`, `stb_no`, `stb_type`,`stb_status`) VALUES (NULL, '', '".$value['vc_no']."', '".$value['stb_no']."', '','', 'ASSIGNED')");
            $this->db->query("INSERT INTO `stbs` (`stb_ID`, stb_lco_code, `stb_vc`, `stb_no`, `stb_type`,`stb_status`) VALUES (NULL, '', '".$value['vc_no']."', '".$value['stb_no']."', '', '', 'ASSIGNED')");
        }
        redirect('/console/stb');
    }

    public function reindex2() {
        $data = $this->db->query('select * from stbs')->result_array();
        foreach ($data as $key => $value) {
            $this->db->query("UPDATE `lcos` SET `lco_stb` = '".$value['stb_ID']."' WHERE `lcos`.`stb_no` ='".$value['stb_no']."'");
        }
        redirect('/console/stb');
    }

   
    public function tax() {
        pr($this->{$this->targetModel}->reverse_calulate_tax(236));
    }
    public function  fix(){
       $custdata = $this->db->query('select lcos.lco_ID,lcos.lco_stb,stbs.stb_ID,stbs.stb_vc,stbs.stb_no from stbs JOIN lcos ON stbs.stb_ID=lcos.lco_stb;')->result_array();   
       foreach ($custdata as $key=>$value){         
        $this->db->query("UPDATE lcos SET lco_stb = '" .str_replace("'",'',$value['stb_no'] )." ( ".str_replace("'",'',$value['stb_vc'] )." )' where lco_ID = '".$value['lco_ID']."'");   
       }
    
       
    }
    
}

?>
