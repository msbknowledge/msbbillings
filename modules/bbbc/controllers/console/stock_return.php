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
		$this->page_config['searchFields'] = 'stock_return_date,stock_return_challan_no,stock_return_vc_card,stock_return_adaptor'; //search box,
        $this->page_config['list_columns'] = 'stock_return_date,stock_return_lco,stock_return_challan_no,stock_return_stb_sd,stock_return_stb_hd,
        stock_return_vc_card,stock_return_remote,stock_return_adaptor,stock_return_av_cord';
    }


}

?>
