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
class Stock_return extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->targetModel = 'stock_returns_model';
		$this->page_config['searchFields'] = 'stock_return_date'; //search box,

    }


}

?>
