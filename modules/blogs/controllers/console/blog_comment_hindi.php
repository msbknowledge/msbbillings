<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 * module: cable
 * @author Kallol
 * @todo separate naming as cable collection
 */
class Blog_comment_hindi extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'blog_comment_hindi_model';
        $this->moduleMeta = array('cables' => 'Collection');
        /****
         * only admin are allowed to view the collection and delete it.. nothing other than that..
         * ********************/
//         if($this->current_user_session['user_type_super']==1)
// 			$this->allowed_action = array('delete', 'view_detail');

//         $this->page_config['use_dropdown_columns'] = 'collection_customer';
//         $this->page_config['use_dropdown_columns_options']['collection_customer'] = $this->customer_list();
//         $this->page_config['tablePrimaryKey'] = $this->collections_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Blog_comment_hindi'; //search title bar
        $this->page_config['searchFields'] = 'comnt_id,name,email,comment'; //search box,
        $this->page_config['list_columns'] = 'comnt_id,name,email,comment';

        /*         * end page_config* */
    }


      public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();
        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config, 'table_tpl');
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }
    
    
    //=============================================================
  public function mailInvoice() {
       $URL ='https://svp.websofttechs.com/portal/update_password/';
              $message = "<p>This email has been sent as a request to reset our password</p>";
              $message .= "Please click on the password reset link 
                <br><a href='" . $URL. "'>Reset 
                Password</a>";
              $data = [
                "fullname" => 'Bapan',
                "reset_link" => $message,

              ];
              $this->load->library('email'); // load CI email library
              $this->mail_template('bapanr144@gmail.com', 'forgot-password', $data);
  }
  // Eamil Templates
  function mail_template($to = '', $slug = '', $mail_data = '')
  {

    $template =  $this->email_templates_model->get_email_template_content_by_slug($slug);

    $body = $template['body'];

    $template_id = $template['id'];

    $data['head'] = $subject = $template['subject'];

    $data['content'] = $this->mail_template_variables($body, $slug, $mail_data);

    $data['title'] = $template['name'];
    
   $template = $this->load->view("console/email_preview", $data, true);
//pr($template,1);
    $this->send_mail($to, $subject, $template, null, null);
    return true;
  }


  // GET Eamil Templates AND REPLACE VARIABLES
  function mail_template_variables($content, $slug, $data = '')
  {

    switch ($slug) {
      case 'login-alert':
        $content = str_replace('{FULLNAME}',  $data['fullname'], $content);
        $content = str_replace('{TIMESTAMP}', date('F j, Y H:i:s'), $content);
        return $content;
        break;

      case 'email-verification':
        $content = str_replace('{TIMESTAMP}', date('F j, Y H:i:s'), $content);
        $content = str_replace('{VERIFICATION_LINK}', $data['fullname'], 'LINK HERE');
        return $content;
        break;

      case 'welcome':
        $content = str_replace('{FULLNAME}', $data['fullname'], $content);
        return $content;
        break;

      case 'forgot-password':
        $content = str_replace('{FULLNAME}', $data['fullname'], $content);
        $content = str_replace('{RESET_LINK}', $data['reset_link'], $content);
        return $content;
        break;

      case 'applicant-applied':
        $content = str_replace('{TASK_TITLE}', $data['task_title'], $content);
        return $content;
        break;

      case 'Exam':
        $content = str_replace('{TASK_TITLE}', $data['task_title'], $content);
        return $content;
        break;

      case 'general-notification':
        $content = str_replace('{CONTENT}', $data['content'], $content);
        return $content;
        break;

      case 'candidate-rigister':
        $content = str_replace('{TASK_TITLE}', $data['task_title'], $content);
        return $content;
        break;

      default:
        # code...
        break;
    }
  }

 public function send_mail($to = null, $subject  = null, $body = null, $attachment = null, $cc = null) {

        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'smtp.hostinger.com';
        $config['smtp_user'] = 'admin@msbbillings.in';
        $config['smtp_pass'] = 'BR66MK55@msb';
        $config['smtp_crypto']  = 'tls';
        $config['smtp_port'] = '465';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
         $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from('admin@msbbillings.in', 'Bengal BroadBand');
        $this->email->to($to);//$entryDatas[0]['email']

        $this->email->subject($subject);
       // $this->email->message('Dear Subscriber');
        $this->email->message($body);

        if ($this->email->send()) {
            echo json_encode(array('status' => 'Success'));
        } else {
            echo json_encode(array('status' => 'Failed'));
        }

        //echo $this->email->print_debugger();
    }
  //=============================================================
   
 
    
}

?>
