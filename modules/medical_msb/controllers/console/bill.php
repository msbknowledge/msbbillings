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
class Bill extends MY_Controller {

    //put your code here
public $publicAccess = array('index','viewMailInvoice');
    public function __construct() {
        parent::__construct();
        }
        
        public function index() {
           $data = json_decode(NODEMETA,true);
			pr($data);
            
        }
         public function viewMailInvoice() {
           $data = json_decode(NODEMETA,true);
			pr($data);
            
        }

}?>
