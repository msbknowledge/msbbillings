<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed dc ');

class Dynamic extends MY_Controller {
    public function __construct() {
       
       parent::__construct();

    
	$virtual['controller'] = 	$this->uri->segment(2);
	$virtual['action'] = 	$this->uri->segment(3);
	if($virtual['action'] == ''){
		$virtual['action'] = "index";
	}
	if($virtual['controller'] == ''){
		redirect(console_url());
	}
        
        $this->targetModel = $virtual['controller'].'_model';	

	$this->load_model($virtual['controller']);
	$this->page_config['tablePrimaryKey'] = $this->{$this->targetModel}->get_primary_key(); //pk

        /*         * page_config* */

        $this->page_config['title'] = ucfirst($virtual['controller']); //search title bar

	
	$this->{$virtual['action']}();
    }

    /**
     * generate view for index listing table 
     */
  public function test(){
    $this->{$this->targetModel}->foreign_keys();
  }
    protected function render($passedData = array(), $view_file = null, $returnData = FALSE, $header_tpl = 'common/header_tpl', $footer_tpl = 'common/footer_tpl') {
            $segments = $this->router->uri->segments;

try {
            $segments = $this->router->uri->segments;


                if (empty($segments[3])) {
                    $segments[3] = 'index';
                }
                if (empty($segments[2])) {
                    $segments[2] = 'dashboard';
                }

                $this->routedirectory = 'console';

                if ($view_file == null)
                    $view_file_path = $this->routedirectory . '/common/' . $segments[3] . '_tpl';
                else
                    $view_file_path = $this->routedirectory .'/'.  $view_file;


            $returnViewData = '';
            $passedData['current_user_session'] = $this->current_user_session;
            $passedData['site_settings'] = $this->current_site_settings;
            $passedData['site_menu'] = $this->menu_generater();
            $passedData['site_breadcrumb'] = $this->breadcrumb_generator($segments);


            /*             * **********
              header
             *              * ************ */
if($header_tpl!==false)
        $returnViewData .= $this->load->view($this->routedirectory.'/' .$header_tpl, $passedData, $returnData);

            /*             * **********
              view file detection and load
             * ************ */

            $returnViewData .= $this->load->view($view_file_path.'.php', $passedData, $returnData);
//pr($returnViewData);
               
            
           // $returnViewData .= $this->load->view($view_file_path, $passedData, $returnData);
            /*             * **********
              footer
             *              * ************ */
if($footer_tpl!==false)
         $returnViewData .= $this->load->view($this->routedirectory.'/' .$footer_tpl, $passedData, $returnData); 
            return $returnViewData;
        } catch (Exception $err_obj) {
            $this->show_error_page(600, $err_obj->getMessage());
        }
    }
   
protected function auto_fieldtype_detect($user_config = NULL) {
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field' . $this->targetModel . '.txt')) {
            $config = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field' . $this->targetModel . '.txt'), true);
        } else {

            $tableFieldMeta = $this->{$this->targetModel}->get_field_list();


	    $foreignKeys  = $this->{$this->targetModel}->get_foreign_keys(); //fk	
            $autoTextArea = NULL;
            $autoDatePicker = NULL;
            $autoDateTimePicker = NULL;
            $autoStatus = NULL;
            $primaryKey = NULL;
	    $generalInput = null;	
            foreach ($tableFieldMeta[0] as $key => $value) {
            preg_match('#^enum\((.*?)\)$#ism', $value['Type'], $matches);
		if(isset($matches[1])){
                   $matches[1] = explode(',',str_ireplace(array("'",'"'),'',$matches[1]));
			$doptons = null;
			foreach($matches[1] as $dv){
				$doptons[$dv] = $dv;
			}
		        $config['use_dropdown_columns_options'][ $key] =$doptons;
			continue;
		}

	foreach($foreignKeys as $ky){
	$CI->{$ky['REFERENCED_TABLE_NAME']} = new Dynamic_model($ky['REFERENCED_TABLE_NAME']);
        $config['use_dropdown_columns_options'][$ky['COLUMN_NAME']] = $CI->{$ky['REFERENCED_TABLE_NAME']}->get_list_for_dropdown() ;
	}
                if ($value['Type'] == 'text' || $value['Type'] == 'longtext') {
                    $autoTextArea[] = $key;
			continue;
                }else
                if ($value['Type'] == 'date') {
                    $autoDatePicker[] = $key;continue;
                }else
                if ($value['Type'] == 'datetime') {
                    $autoDateTimePicker[] = $key;continue;
                }else
                if ($value['Type'] == 'tinyint(1)') {
                    $autoStatus[] = $key;continue;
                }else
                if ($value['Key'] == 'PRI') {
                    $primaryKey = $key;continue;
                }else{
		if(array_key_exists( $key,$config['use_dropdown_columns_options'])===false)
		  $generalInput[] =  $key;
		}
            }

        


            /*             * textarea */
            $config['textarea_columns'] = is_string(@$user_config['textarea_columns']) ? explode(',', $user_config['textarea_columns']) : $autoTextArea;
            /*             * datetimepicker */
            $config['datetimepicker_columns'] = is_string(@$user_config['datetimepicker_columns']) ? explode(',', $user_config['datetimepicker_columns']) : $autoDateTimePicker;
            /*             * datepicker */
            $config['datepicker_columns'] = is_string(@$user_config['datepicker_columns']) ? explode(',', $user_config['datepicker_columns']) : $autoDatePicker;
            /*             * status */
            $config['use_status_columns'] = is_string(@$user_config['use_status_columns']) ? explode(',', $user_config['use_status_columns']) : $autoStatus;
            /*             * PRIMARY KEY */
            $config['tablePrimaryKey'] = is_string(@$user_config['tablePrimaryKey']) ? $user_config['tablePrimaryKey'] : $primaryKey;
	 
	$config['generalInput'] = $generalInput;	
            /** auto field type detect End* */
            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field' . $this->targetModel . '.txt', json_encode($config));
        }
	//pr($config);
        return $config;
    }
        /**
     * index show list
     */
    public function index() {

        $config = $this->auto_fieldtype_detect(NULL);
        $this->page_config = array_merge($config, $this->page_config);
        $orderBy = $this->orderby_input_process();

        $likeCondition = $this->generate_search_like_condition();
        $allData = $this->{$this->targetModel}->get_list_for_tables(NULL, FALSE, $this->current_site_settings['site_setting_record_per_page'], NULL, $likeCondition, $orderBy);
        $data['generateTableView'] = $this->generate_table_view($allData, $this->page_config);
        if ($this->input->post()) {
            echo $data['generateTableView'];
        } else {
            $data['generateTableSearch'] = $this->generate_table_search_view($this->page_config);
            $this->render($data);
        }
    }

  }
