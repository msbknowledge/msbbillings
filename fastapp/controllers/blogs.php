<?php
class Blogs extends MY_Controller
{

  public $publicAccess = array('index','mo', 'blogs', 'home', 'about_us','blogdetails', 'contact_us', 'payment_terms_and_conditions', 'privacy_policy', 'details', 'main');

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['Pagination_model','help_model']);
    $this->load->library('pagination'); 
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data = array();
    $tags = $this->input->get('tags');
    $data['catdetails'] = $this->Pagination_model->CountCategoryBlogs();
    $data['recentblogcont'] = $this->Pagination_model->fechblogs();
    $data['tags'] = $this->Pagination_model->tagihindi();

    $catid = $this->Pagination_model->getcatogryslug($this->input->get("name"));
    $category_id = ($catid) ? $catid : "";
    $search = ($this->input->get("search")) ? $this->input->get("search") : "";
    $tags = ($this->input->get("tags")) ? $this->input->get("tags") : "";
    $url=base_url('blogs');
    $total_row= $this->Pagination_model->getTotalRow($search, $tags, $category_id);
    $config['base_url'] = $url;
    $config['total_rows'] =$total_row;
    $config['per_page'] = 8;
    $config["full_tag_open"]   = '<ul class="pagination justify-content-center justify-content-lg-start">';
    $config['cur_tag_open'] = '<li class="d-flex"><a href="javascript:void(0);">';
    $config["full_tag_close"]  = '</ul>';
    $config["first_tag_open"]  = '<li class="page-item page-link">';
    $config["first_tag_close"] = '</li>';
    $config["last_tag_open"]   = '<li class="page-item page-link">';
    $config["last_tag_close"]  = '</li>';
    $config["next_tag_open"]   = '<li class="page-item"><span aria-hidden="true">';
    $config["next_tag_close"]  = '</span></li>';
    $config["prev_tag_open"]   = '<li class="page-item"> <span aria-hidden="true">';
    $config["prev_tag_close"]  = '</span></li>';
    $config["num_tag_open"]    = '<li class="page-item ">';
    $config["num_tag_close"]   = '</li>';
    $config["cur_tag_open"]    = '<li class="page-item active"> <a>';
    $config["cur_tag_close"]   = '</a></li>';
    $config['first_link'] = 'First Page';
    $config['last_link'] = 'Last Page';
    $config['next_link'] = 'Next Page';
    $config['prev_link'] = 'Prev Page';

    $this->pagination->initialize($config);
    $data['bodycontent']=$this->Pagination_model->getcategorydata($this->pagination->initialize($config),$this->uri->segment(3),$search, $tags, $category_id);
  // print_r($data);die();
    $this->template->load('blogs/default_layout', 'contents', 'blogs/blog', $data);
  }
  public function blogdetails($blogslug)
  {
    $result = array();
    $id = $this->Pagination_model->blogslug($blogslug);
    $result['image_id'] = $this->Pagination_model->getImadeid($id);
    $result['catdetails'] = $this->Pagination_model->CountCategoryBlogs();
    $result['recentblogcont'] = $this->Pagination_model->fechblogs();
    $result['comment'] = $this->Pagination_model->fetchComment($id);
    $result['countComm'] = $this->Pagination_model->countComment($id);
    
    $result['tags'] = $this->Pagination_model->taginenglish();
   
     $result['reply'] = $this->Pagination_model->fechreply($id);
   
   $this->template->load('blogs/default_layout', 'contents', 'blogs/blogdetailspage', $result);
  }
  public function home()
  {
    $this->load->view('home_tpl', $data);
  }

  public function blogs()
  {
    $this->template->load('blogs/default_layout', 'contents', 'blogs/home_tpl', $data);
    // $this->load->view('home_tpl', $data);
  }

  public function about_us()
  {
    $this->template->load('blogs/default_layout', 'contents', 'blogs/about_us', $data);
    //$this->load->view('about_us', $data);
  }
  public function contact_us()
  {
    $this->template->load('blogs/default_layout', 'contents', 'blogs/contact_us', $data);
  }
  public function privacy_policy()
  {
    $this->template->load('blogs/default_layout', 'contents', 'blogs/privacy_policy', $data);
  }
  public function details()
  {
    $this->template->load('blogs/default_layout', 'contents', 'blogs/details_tpl', $data);
  }
  public function main()
  {
    $data['catdetails'] = $this->Pagination_model->CountCategoryBlogs();
    $data['recentblogcont'] = $this->Pagination_model->fechblogs();
    $data['tags'] = $this->Pagination_model->tagihindi();
    $this->template->load('blogs/default_layout', 'contents', 'blogs/main_tpl', $data);
  }
  public function payment_terms_and_conditions()
  {
    $this->load->view('payment_terms-and-conditions', $data);
  }
    public function mo() {
        //->template->load('blogs/default_layout', 'contents', 'blogs/about_us', $data);
        // define('PLAN_NAME', $row['node_plan']);
        // define('PLAN_PACKAGES', $row['node_module']);
        // define('NODE', $row['node_name']);
        // define('NODETYPE', $row['node_plan']);
        // define('ROOTPATH', dirname(__FILE__) . '/');

            
                $modules = json_decode(PLAN_PACKAGES,true);
                    foreach ($modules as $key => $value) {
                        $data['module'][$key+1]=$value;
                    }
                    $data['help_data']=$this->help_model->get_help();
               
                $this->render($data,'help_tpl');
            
        }

}
