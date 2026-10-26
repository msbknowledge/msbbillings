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
class Payment extends MY_Controller {

    //put your code here
    public $publicAccess = array('index');
    public function __construct() {
        parent::__construct();
 
    }

 public function index(){

echo "123";
}
 }
?>
