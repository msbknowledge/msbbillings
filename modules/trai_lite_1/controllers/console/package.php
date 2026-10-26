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
class Package extends MY_Controller {
    
    

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'package_status';
        $this->targetModel = 'packages_model';
        $this->moduleMeta = array('cables' => 'Package');

        $this->load->model($this->targetModel);
        $this->load->model('taxes_model');


        //$this->page_config['use_dropdown_columns_options']['package_type'] = $this->get_package_types($this->current_site_settings['site_setting_theme']);

        $this->page_config['tablePrimaryKey'] = $this->packages_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Package'; //search title bar
        $this->page_config['searchFields'] = 'package_name'; //search box,
        $this->page_config['list_columns'] = 'package_is_free,package_name,package_rate';
        /*         * end page_config* */
    }

    public function widget() {
        # pr($this->taxes_model->calulate_tax(100));
        pr($this->taxes_model->reverse_calulate_tax(118));
    }

    public function channel() {

        $channel_sql = "SELECT channel_name,channel_price,channel_definition FROM `channels`  WHERE channel_type !='FTA'";
        $package_sql = "SELECT package_name,package_rate,package_channel_count FROM `packages`";
        
        $paychannel = $this->db->query($channel_sql)->result_array();
        $packages = $this->db->query($package_sql)->result_array();

        if ($packages) {
            foreach ($packages as $key => $row) {
                $data['packages'][] = $row;
            }
        }

        if ($paychannel) {
            foreach ($paychannel as $key => $row)  {
                    $data['paychannels'][] = $row;
                }
            }

           $this->render( $data,'pack_cal_tpl');
        }
    
}
?>
