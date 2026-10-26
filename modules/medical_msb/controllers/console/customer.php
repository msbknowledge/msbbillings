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
class Customer extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->targetModel = 'customers_model';
        $this->moduleMeta = array('medical' => 'Customer');
        $this->page_config['tablePrimaryKey'] = $this->customers_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Customer'; //search title bar
        $this->page_config['searchFields'] = 'customer_name,customer_contact,customer_address'; //search box,
        $this->page_config['list_columns'] = 'customer_name,customer_contact,customer_address';
        /*         * end page_config* */
    }
   public function mailInvoice() {
        $base_url=base_url();
        $invoice_id = $this->input->post('invoice_id');
        $entryDatas = $this->{$this->targetModel}->get_list(array('invoice_ID' => $invoice_id));

        //pr($entryDatas,1);
//pr($entryDatas[0]['lco_email'],1);
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
        $this->email->to($entryDatas[0]['lco_email']);

        $this->email->subject('Email Invoice');
       // $this->email->message('Dear Subscriber');
        $this->email->message('Dear Subscriber, please find your invoice <a href="'.$base_url.'console/invoice/viewMailInvoice/?invoice='.$this->encrypt->encode($invoice_id) .'">here</b> ');

        if ($this->email->send()) {
            echo json_encode(array('status' => 'Success'));
        } else {
            echo json_encode(array('status' => 'Failed'));
        }

        //echo $this->email->print_debugger();
    }

    public function viewMailInvoice() {
        
        $invoice_id = $this->encrypt->decode(str_ireplace(' ', '+', $this->input->get('invoice')));
       
        $this->generate_invoice_print($invoice_id);
    }
}

?>