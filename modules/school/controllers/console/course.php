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
class course extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        //$this->page_config['use_status_columns'] = 'course_status';
        $this->targetModel = 'courses_model';
        $this->moduleMeta = array('schools' => 'course');

        $this->load->model($this->targetModel);
        $this->load->model('packages_model');

        $this->page_config['use_dropdown_columns'] = 'course_type';
        $this->page_config['use_dropdown_columns_options']['course_type'] = array("School" => "School", "Activities" => "Activities");

        $this->page_config['tablePrimaryKey'] = $this->courses_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'course'; //search title bar
        $this->page_config['searchFields'] = 'course_ID,course_name,course_type,course_price'; //search box,
        $this->page_config['list_columns'] = 'course_ID,course_name,course_type,course_price';
        /*         * end page_config* */
    }

    public function widget() {
        
    }

    public function import() {
        $this->load->model('courses_model');
        $url = "https://course.trai.gov.in/data.php";
        $url1 = "https://course.trai.gov.in/bouquetlist.json";
        $data = json_decode(file_get_contents($url), true);
        $alldata = json_decode(file_get_contents($url1), true);
        //pr($alldata);
        $sql = "TRUNCATE TABLE courses";
        $this->db->query($sql);

        foreach ($data as $val) {
            // pr($val,1);
            $course_broadcaster = $this->db->escape($val['Broadcaster']);
            $course_name = $this->db->escape($val['course']);
            $course_definition = $this->db->escape($val['HD']);
            $course_genre = $this->db->escape($val['category']);
            $course_type = $this->db->escape(1);
            $course_price = $this->db->escape($val['price']);

            $values[] = "($course_genre,$course_broadcaster,$course_name,$course_type,$course_price,$course_definition)";
            // pr($values);   
        }
        $sql = "INSERT INTO courses (course_genre,course_broadcaster,course_name,course_type,course_price,course_definition) VALUES";
        $sql.=implode(',', $values);
        $this->db->query($sql);
       // pr($sql,1);
        foreach ($alldata as $broadcuster => $valBOUQUET) {
            foreach ($valBOUQUET as $coursename => $valcourses) {
                $all = "";
                foreach ($valcourses['courses'] as $key => $val) {
                    if ($key == 0) {
                        $all.=$val['course'];
                    } else {
                        $all.=", " . $val['course'];
                    }
                    // pr($all);
                }
                $course_broadcaster = $broadcuster;

                if($course_broadcaster=="Zee Entertainment Enterprises Limited"){
                    $course_name = "".($coursename);

                }
                if($course_broadcaster=="TV Today Network Ltd."){
                    $course_name = "TV Today ".($coursename);

                }
                if($course_broadcaster=="SUN TV Network Limited"){
                    $course_name = "SUN ".($coursename);

                }
                if($course_broadcaster=="STAR India Private Limited"){
                    $course_name = "STAR ".($coursename);

                }
              
                if($course_broadcaster=="Sliverstar Communications Ltd."){
                    $course_name = "Sliverstar ".($coursename);

                }
                if($course_broadcaster=="Sony Pictures Networks India Private Limited"){
                    $course_name = "Sony ".($coursename);

                }
                if($course_broadcaster=="Raj Television Network Limited"){
                    $course_name = "Raj Television ".($coursename);

                }
                if($course_broadcaster=="Odisha Television Limited"){
                    $course_name = "Odisha Television ".($coursename);

                }
                if($course_broadcaster=="New Delhi Television Limited (NDTV)"){
                    $course_name = "NDTV ".($coursename);

                }
                if($course_broadcaster=="New Delhi Television Limited (NDTV)"){
                    $course_name = "NDTV ".($coursename);

                }
                if($course_broadcaster=="Mavis Satcom Limted"){
                    $course_name = "Mavis ".($coursename);

                }
                if($course_broadcaster=="Eenadu Television Pvt Limited"){
                    $course_name = "Eenadu ".($coursename);

                }
                if($course_broadcaster=="Disney Broadcasting (India) Limited"){
                    $course_name = "Disney ".($coursename);

                }
                if($course_broadcaster=="Discovery Communications India"){
                    $course_name = "Discovery ".($coursename);

                }
                if($course_broadcaster=="Bennett, Coleman & Company Limited (Times Network)"){
                    $course_name = "Times Network ".$coursename;

                }
                $course_broadcaster = $this->db->escape($broadcuster);
               // $course_name = str_ireplace(" ","-",$course_name);

                $course_type = count($valcourses['courses']);
                $course_price = $this->db->escape($valcourses['Bouquetprice'][0]['bouquetprice']);
                $course_bouquet_list = $this->db->escape($all);
                $sql1 = "INSERT INTO courses(course_broadcaster,course_name,course_type,course_price,course_bouquet_list) VALUES";
                $sql1.= "($course_broadcaster,'$course_name',$course_type,$course_price,$course_bouquet_list)";
                $this->db->query($sql1);
            }

            // pr($course_broadcaster);
        }
    }
    public function course_search_by_name() {

        $term = $this->input->get('term');
        $courseData = $this->db->query("SELECT * FROM `courses` where `course_name` like '%" . $term . "%'")->result_array();

       // $packages = $this->db->query("SELECT * FROM `packages` where `package_name` like '%" . $term . "%'")->result_array();
    
        $data = null;
        foreach ($courseData as $key => $val) {
            $data[$key]['id'] = $val['course_ID'];
            $data[$key]['label'] = $val['course_name'];
            $data[$key]['value'] = $val['course_name'];
            $data[$key]['amount'] = $val['course_price'];
        }
// foreach ($packages as $key => $val) {
//             $data[$key]['id'] = $val['package_ID'];
//             $data[$key]['label'] = $val['package_name'];
//             $data[$key]['value'] = $val['package_name'];
//             $data[$key]['amount'] = $val['package_rate'];
//         }

        echo json_encode($data);
    }
 
    /**
     * generate view for view details 
     */
    protected function generate_detail_view($data = NULL, $user_config = array(), $view_template = 'student/detail_tpl') {
        /** auto field type detect Start* */
        $config = $this->auto_fieldtype_detect($user_config);
        /** auto field type detect End* */
        /** dropdown */
        $config['use_dropdown_columns_options'] = isset($user_config['use_dropdown_columns_options']) ? $user_config['use_dropdown_columns_options'] : array();

        /** image */
        if (!isset($user_config['use_image_columns_path'])) {
            $user_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        }
        $config['use_image_columns'] = is_string(@$user_config['use_image_columns']) ? explode(',', $user_config['use_image_columns']) : NULL;
        $config['use_image_columns_path'] = is_string(@$user_config['use_image_columns_path']) ? explode(',', $user_config['use_image_columns_path']) : $user_config['use_image_columns_path'];



        $tabledata['table_meta']['config'] = $config;
        $tabledata['table_meta']['data'] = isset($data) ? $data : NULL;


        return $this->render($tabledata, $view_template, true, false, false);
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
        echo $this->generate_detail_view($entryData, $this->page_config);
    }

}

?>
