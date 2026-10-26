<?php
class Api extends MY_Controller
{

  public $publicAccess = array('index','home','wish');

  public function __construct()
  {
    parent::__construct();
        $this->load->model('help_model');
        $this->page_config['use_image_columns'] = 'link';
        $this->page_config['use_image_columns_path'] = base_url() . 'uploads/' . NODE . '/';
        $this->page_config['searchFields'] = 'help_id';
        $this->page_config['use_file_columns'] ='help_title'; 
    // $this->page_config['list_columns'] =$this->page_config['searchFields']; 
        $this->page_config['list_columns'] = 'help_title,help_type,link,help_description';
    $this->load->library('form_validation');
  }

  public function index()
  {
     
     $data['module_data']=json_decode(NODEMETA,true);
     $modules = json_decode(PLAN_PACKAGES,true);
                // $sql= $this->get_modules();

                    foreach ($modules as $key => $value) {
                        $data['module'][$key+1]=$value;
                    }
                    $data['help_data']=$this->help_model->get_help();
                 
            $this->render($data,'help_tpl');
    //$this->load->view('home_tpl', $data);
  }
 
  public function home()
  {
    $this->load->view('home_tpl', $data);
  }
   public function wish()
  {
    $this->load->view('2025_tpl', $data);
  }

}
