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
class Channel extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'channel_status';
        $this->targetModel = 'channels_model';
        $this->moduleMeta = array('cables' => 'Channel');

        $this->load->model($this->targetModel);
        $this->load->model('packages_model');


        $this->page_config['tablePrimaryKey'] = $this->channels_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Channel'; //search title bar
        $this->page_config['searchFields'] = 'channel_name,channel_broadcaster'; //search box,
        //$this->page_config['list_columns'] = 'channel_name';
        /*         * end page_config* */
    }

    public function widget() {
        
    }

    public function import() {
        $this->load->model('channels_model');
        $url = "https://channel.trai.gov.in/data.php";
        $url1 = "https://channel.trai.gov.in/bouquetlist.json";
        $data = json_decode(file_get_contents($url), true);
        $alldata = json_decode(file_get_contents($url1), true);
        //pr($alldata);
        $sql = "TRUNCATE TABLE channels";
        $this->db->query($sql);

        foreach ($data as $val) {
            // pr($val,1);
            $channel_broadcaster = $this->db->escape($val['Broadcaster']);
            $channel_name = $this->db->escape($val['Channel']);
            $channel_definition = $this->db->escape($val['HD']);
            $channel_genre = $this->db->escape($val['category']);
            $channel_type = $this->db->escape(1);
            $channel_price = $this->db->escape($val['price']);

            $values[] = "($channel_genre,$channel_broadcaster,$channel_name,$channel_type,$channel_price,$channel_definition)";
            // pr($values);   
        }
        $sql = "INSERT INTO channels (channel_genre,channel_broadcaster,channel_name,channel_type,channel_price,channel_definition) VALUES";
        $sql.=implode(',', $values);
        $this->db->query($sql);
       // pr($sql,1);
        foreach ($alldata as $broadcuster => $valBOUQUET) {
            foreach ($valBOUQUET as $channelname => $valChannels) {
                $all = "";
                foreach ($valChannels['Channels'] as $key => $val) {
                    if ($key == 0) {
                        $all.=$val['Channel'];
                    } else {
                        $all.=", " . $val['Channel'];
                    }
                    // pr($all);
                }
                $channel_broadcaster = $broadcuster;

                if($channel_broadcaster=="Zee Entertainment Enterprises Limited"){
                    $channel_name = "".($channelname);

                }
                if($channel_broadcaster=="TV Today Network Ltd."){
                    $channel_name = "TV Today ".($channelname);

                }
                if($channel_broadcaster=="SUN TV Network Limited"){
                    $channel_name = "SUN ".($channelname);

                }
                if($channel_broadcaster=="STAR India Private Limited"){
                    $channel_name = "STAR ".($channelname);

                }
              
                if($channel_broadcaster=="Sliverstar Communications Ltd."){
                    $channel_name = "Sliverstar ".($channelname);

                }
                if($channel_broadcaster=="Sony Pictures Networks India Private Limited"){
                    $channel_name = "Sony ".($channelname);

                }
                if($channel_broadcaster=="Raj Television Network Limited"){
                    $channel_name = "Raj Television ".($channelname);

                }
                if($channel_broadcaster=="Odisha Television Limited"){
                    $channel_name = "Odisha Television ".($channelname);

                }
                if($channel_broadcaster=="New Delhi Television Limited (NDTV)"){
                    $channel_name = "NDTV ".($channelname);

                }
                if($channel_broadcaster=="New Delhi Television Limited (NDTV)"){
                    $channel_name = "NDTV ".($channelname);

                }
                if($channel_broadcaster=="Mavis Satcom Limted"){
                    $channel_name = "Mavis ".($channelname);

                }
                if($channel_broadcaster=="Eenadu Television Pvt Limited"){
                    $channel_name = "Eenadu ".($channelname);

                }
                if($channel_broadcaster=="Disney Broadcasting (India) Limited"){
                    $channel_name = "Disney ".($channelname);

                }
                if($channel_broadcaster=="Discovery Communications India"){
                    $channel_name = "Discovery ".($channelname);

                }
                if($channel_broadcaster=="Bennett, Coleman & Company Limited (Times Network)"){
                    $channel_name = "Times Network ".$channelname;

                }
                $channel_broadcaster = $this->db->escape($broadcuster);
               // $channel_name = str_ireplace(" ","-",$channel_name);

                $channel_type = count($valChannels['Channels']);
                $channel_price = $this->db->escape($valChannels['Bouquetprice'][0]['bouquetprice']);
                $channel_bouquet_list = $this->db->escape($all);
                $sql1 = "INSERT INTO channels(channel_broadcaster,channel_name,channel_type,channel_price,channel_bouquet_list) VALUES";
                $sql1.= "($channel_broadcaster,'$channel_name',$channel_type,$channel_price,$channel_bouquet_list)";
                $this->db->query($sql1);
            }

            // pr($channel_broadcaster);
        }
    }
    public function channel_search_by_name() {

        $term = $this->input->get('term');
        $channelData = $this->db->query("SELECT * FROM `channels` where `channel_name` like '%" . $term . "%'")->result_array();

        $packages = $this->db->query("SELECT * FROM `packages` where `package_name` like '%" . $term . "%'")->result_array();
    
        $data = null;
        foreach ($channelData as $key => $val) {
            $data[$key]['id'] = $val['channel_ID'];
            $data[$key]['label'] = $val['channel_name'];
            $data[$key]['value'] = $val['channel_name'];
            $data[$key]['amount'] = $val['channel_price'];
        }
foreach ($packages as $key => $val) {
            $data[$key]['id'] = $val['package_ID'];
            $data[$key]['label'] = $val['package_name'];
            $data[$key]['value'] = $val['package_name'];
            $data[$key]['amount'] = $val['package_rate'];
        }

        echo json_encode($data);
    }
}

?>
