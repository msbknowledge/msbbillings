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
class Import extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->moduleMeta = array('cables' => 'Import');
        $this->load->helper('download');
    }

    public function index() {

        $data = array();
        $this->render($data, 'console/import/import_tpl');
    }

    public function download($fileName = NULL) {

        $fileName = $this->uri->segment(4);
        if ($fileName) {

            $file = ROOTPATH . 'uploads/excel/sample/' . $fileName;


            // check file exists    
            if (file_exists($file)) {
                // get file content
                $data = file_get_contents($file);
                //force download
                force_download($fileName, $data);
            } else {
                // Redirect to base url
                redirect(base_url());
            }
        }
    }

    public function upload() {
        if (isset($_FILES['file_name'])) {
            $errors = array();
            $file_name = $_FILES['file_name']['name'];
            $file_size = $_FILES['file_name']['size'];
            $file_tmp = $_FILES['file_name']['tmp_name'];
            $file_type = $_FILES['file_name']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['file_name']['name'])));

            $expensions = array("xlsx", "xls");
            //  pr(ROOTPATH."/uploads/excel/".$file_name);

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                
                //pr($_FILES);
                
                move_uploaded_file($_FILES['file_name']['tmp_name'],ROOTPATH . "uploads/excel/" . $file_name);
                echo "Success";
                $data=excelToArray(ROOTPATH . "uploads/excel/" . $file_name);
               foreach($data as $key=>$val){
                  // pr($val);
               $pack=$this->db->query("select * from packages where package_name='".$val['customer_package']."'")->result_array();
               //pr($pack);
               if(empty($pack)){
                   echo 'empty';
                   $this->db->query("INSERT INTO `packages`(`package_name`) VALUES ('".$val['customer_package']."')" );
                   $pack_data=$this->db->query("select * from packages where package_name='".$val['customer_package']."'")->result_array();
                   //pr($pack_data);
                   $val['customer_package']='["'.$pack_data[0]['package_ID'].'"]';
               }else{
               $val['customer_package']='["'.$pack[0]['package_ID'].'"]';
               }
               $val['customer_activation_date']=str_replace('/','-',$val['customer_activation_date']);
               $val['customer_deactivation_date']=str_replace('/','-',$val['customer_deactivation_date']);
               //pr($val);
                $this->db->insert('customers', $val); 
               }
               unlink(ROOTPATH . "uploads/excel/" . $file_name);
              redirect(base_url());
            
            } else {
                print_r($errors);
            }
        }
    }

}

?>