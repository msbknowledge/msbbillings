<?php
class Messages extends MY_Controller
{

  public $publicAccess = array('index');

  public function __construct()
  {
    parent::__construct();
    
  }

  public function index()
  {
     echo 'coming soon';
  }
 
}
