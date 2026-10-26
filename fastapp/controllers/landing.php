<?php
class Landing extends MY_Controller {

    public $publicAccess = array('index', 'blogs','chat', 'wishes','home','wishe', 'about_us','blogdetails', 'contact_us', 'payment_terms_and_conditions', 'privacy_policy', 'details', 'main');


    public function __construct() {
        parent::__construct();
        $this->load->model('help_model');
    }
    
    public function index() {
        $landing_url = get_option('home_page');
        if(!empty($landing_url)){
            redirect(base_url($landing_url));
        } else {
            if(base_url($landing_url)=='https://msbbiling.in/'){
                $this->load->view('index_tpl.php');
            }elseif(base_url($landing_url)=='https://medical.msbbillings.in/'){//'.NODE.'
                $modules = json_decode(PLAN_PACKAGES,true);
                    foreach ($modules as $key => $value) {
                        $data['module'][$key+1]=$value;
                    }
                    $data['help_data']=$this->help_model->get_help();
               
                //$this->render($data,'help_tpl');
                  $this->load->view(NODE.'_tpl.php',$data);
            }else{
                 $this->load->view('index_tpl.php');
            }
         
           // echo 'coming soon';
            
           // $this->load->view('2024_tpl.php');
        }
    }
    
    public function contact_us() {
        $this->render();
    }
    public function about_us() {
        $this->render();
    }
     public function wishes() {
         $this->load->view('2024_tpl.php');
    }
    public function chat() {
         echo 'coming soon';
    }
    
}