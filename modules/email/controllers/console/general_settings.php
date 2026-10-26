<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting_model', 'setting_model');
		
	}

	
	/*--------------------------
	   Email Template Settings
	--------------------------*/
	public function index()
    {
        try {
			$data['title'] = 'Email Templates';
			$data['general_settings'] = $this->setting_model->get_general_settings();
			//pp($data);
            view("general_settings/setting", $data, "Portal | Class rescheduled request");
        } catch (\Throwable $th) {
            redirect(base_url('general_settings'), 'refresh');
        }
    }
    public function add()
    	{
    		$data = array(
    			'application_name' => $this->input->post('application_name'),
    			'email_from' => $this->input->post('email_from'),
    			'admin_email' => $this->input->post('admin_email'),
    			'smtp_host' => $this->input->post('smtp_host'),
    			'smtp_port' => $this->input->post('smtp_port'),
    			'smtp_user' => $this->input->post('smtp_user'),
    			'created_on' => date('Y-m-d : h:m:s'),
    			'updated_on' => date('Y-m-d : h:m:s')
    		);
    
    		$old_logo = $this->input->post('old_logo');
    		$old_favicon = $this->input->post('old_favicon');
    
    		$path="img/";
    
    		if(!empty($_FILES['logo']['name']))
    		{
    			$this->functions->delete_file($old_logo);
    
    			$result = $this->functions->file_insert($path, 'logo', 'image', '9097152');
    			if($result['status'] == 1){
    				$data['logo'] = $path.$result['msg'];
    			}
    			else{
    			
    				redirect(base_url('general_settings'), 'refresh');
    			}
    		}
    
    		// favicon
    		if(!empty($_FILES['favicon']['name']))
    		{
    			$this->functions->delete_file($old_favicon);
    
    			$result = $this->functions->file_insert($path, 'favicon', 'image', '197152');
    			if($result['status'] == 1){
    				$data['favicon'] = $path.$result['msg'];
    			}
    			else{
    			
    				redirect(base_url('general_settings'), 'refresh');
    			}
    		}
    
    		
    		$result = $this->setting_model->update_general_setting($data);
    
    		
    		
    		if($result){
    			
    			redirect(base_url('general_settings'), 'refresh');
    		}
    	}

	// ------------------------------------------------------------
	public function email_templates()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('subject', 'Email Subject', 'trim|required');
			$this->form_validation->set_rules('content', 'Email Body', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo validation_errors();
			}
			else{

				$id = $this->input->post('id');
				
				$data = array(
					'subject' => $this->input->post('subject'),
					'body' => $this->input->post('content'),
					//'created_on' => date('Y-m-d H:i:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->setting_model->update_email_template($data, $id);
				if($result){
					echo "true";
					//redirect(base_url('general_settings'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'Email Templates';
			$data['templates'] = $this->setting_model->get_email_templates();
			view("general_settings/email_templates/templates_list", $data, "Portal | Email Templates");
			
		}
	}

	// ------------------------------------------------------------
	// Get Email Template & Related variables via Ajax by ID
	public function get_email_template_content_by_id()
	{
		$id = $this->input->post('template_id');

		$data['template'] = $this->setting_model->get_email_template_content_by_id($id);
		
		$variables = $this->setting_model->get_email_template_variables_by_id($id);

		$data['variables'] = implode(',',array_column($variables, 'variable_name'));

		echo json_encode($data);
	}

	//---------------------------------------------------------------
    //
    public function email_preview()
    {
        if($this->input->post('content'))
        {
            $data['content'] = $this->input->post('content');
            $data['head'] = $this->input->post('head');
            $data['title'] = 'Send Email to Subscribers';
			echo view("general_settings/email_templates/email_preview", $data, "Portal | Email View");
			
            //echo $this->load->view('general_settings/email_templates/email_preview', $data,true);
        }
    }

}

?>	