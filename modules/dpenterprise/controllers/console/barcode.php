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
 * @author pratik
 */
class Barcode extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'tax_status';
        $this->targetModel = 'barcodes_model';
        $this->moduleMeta = array('barcode' => 'Barcode');
        $this->page_config['use_dropdown_columns'] = 'barcode_product';
        $this->page_config['use_dropdown_columns_options']['barcode_product'] = array('isopropyl' => "Isopropyl", 'benzyl' => "Benzyl",'cresol'=>"Cresol With Soap Solution 50% I.P", 'glutaraldehyde'=>"Glutaraldehyde Solution 2% For Instrument Sterilization");
        $this->page_config['tablePrimaryKey'] = $this->{$this->targetModel}->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Barcode'; //search title bar
        $this->page_config['searchFields'] = 'barcode_product,barcode_batch,barcode_mfg'; //search box,
        $this->page_config['list_columns'] = $this->page_config['searchFields'];
        /*         * end page_config* */
    }

    /**
     * view detail
     */
    public function view_detail() {
        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $entryID = trim($this->input->post('entry'));
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $entryID));
        $entryData1 = $this->{$this->targetModel}->get_field_list();
        $entryData = array_intersect_key($entryData2[0], $entryData1[0]);
        echo $this->generate_detail_view($entryData, $this->page_config, 'detail_tpl');
    }

    public function print_code() {
        $entryData2 = $this->{$this->targetModel}->get_list(array($this->page_config['tablePrimaryKey'] => $this->uri->segment(4)));
        $data = $entryData2[0];

        $time = strtotime($data['barcode_mfg']);
        $data['barcode_exp_code'] = date("ym", strtotime("+".get_option("exp_".$data['barcode_product'])." month", $time));
        $data['barcode_exp'] = date("d/m/y", strtotime("+".get_option("exp_".$data['barcode_product'])." month", $time));
        $data['barcode_mfg_code'] = date("ym", $time);
        $data['barcode_mfg'] = date("d/m/Y", $time);
        $data['vendor_code'] = get_option("vendor_code");
        $data['cms_cat'] = get_option("cms_cat_".$data['barcode_product']);
        $data['datamatrix'] = $data['vendor_code']."*".$data['cms_cat']."*".$data['barcode_batch']."*".$data['barcode_mfg_code']."*".$data['barcode_exp_code'];
        $this->load->view("console/barcode/".$data['barcode_product']."_tpl.php",array("data"=>$data));
    }

    /* public function index() {

      $this->load->view('console/barcode2/Benzyl', $data);

      } */
}

?>
