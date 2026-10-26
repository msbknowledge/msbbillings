<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class profit_loss extends MY_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('purchases_model');
        $this->load->model('sales_model');
        $post_data = $this->input->post();
        $period_start = $this->input->post('start');
        $period_end = $this->input->post('end');
        $year=date('Y');

        if (!empty($period_start) && !empty($period_end)) {

            $sql1 = "SELECT purchase_date,sum(purchase_taxable) as sum_purchase_taxable,sum(purchase_total) as sum_purchase_total FROM purchases WHERE purchase_date BETWEEN '" . $period_start . "' AND '" . $period_end . "' ";
            $sql2 = "SELECT sale_date,sum(sale_taxable) as sum_taxable ,sum(sale_total) as sum_total FROM sales WHERE sale_date BETWEEN '" . $period_start . "' AND '" . $period_end . "' ";
            $sql3= "SELECT sale_date,sum(sale_total * sale_grand_discount / 100) as sale_grand_discount FROM `sales` WHERE sale_date BETWEEN '" . $period_start . "' AND '" . $period_end . "' ";
        } else {
            $sql1 = "SELECT purchase_date,sum(purchase_taxable) as sum_purchase_taxable,sum(purchase_total) as sum_purchase_total FROM purchases WHERE purchase_date BETWEEN '" .$year. "-04-01' AND NOW() ";
            $sql2 = "SELECT sale_date,sum(sale_taxable) as sum_taxable ,sum(sale_total) as sum_total FROM sales WHERE sale_date BETWEEN '" .$year. "-01-01' AND NOW() ";
            $sql3= "SELECT sale_date,sum(sale_total * sale_grand_discount / 100) as sale_grand_discount FROM `sales` WHERE sale_date BETWEEN '" .$year. "-01-01' AND NOW() ";
        }
        $purchase = $this->db->query($sql1)->result_array();

        foreach ($purchase as $key => $value) {
            //  pr($value);
            $purchase_data[$key]['purchase_date'] = $value['purchase_date'];
            $purchase_data[$key]['purchase_taxable'] = $value['sum_purchase_taxable'];
            $purchase_data[$key]['purchase_total'] = $value['sum_purchase_total'];
        }

        $sales = $this->db->query($sql2)->result_array();
        $sales_data = null;
        foreach ($sales as $key => $value) {
            $sales_data[$key]['sale_date'] = $value['sale_date'];
            $sales_data[$key]['sale_taxable'] = $value['sum_taxable'];
            $sales_data[$key]['sale_total'] = $value['sum_total'];
        }
        $sale_grand_dis = $this->db->query($sql3)->result_array();

        //pr($sales_data);
//pr($this->input->post());           
        //die('pree');
        if ($this->input->post('key')) {
            // pr($purchase_data);
            // pr($sales_data);
            // pr($sql1);
            // pr($sql2);
            //die('pree');
            $this->load->view('console/profit_loss_table_tpl', array('purchase_data' => $purchase_data, 'sales_data' => $sales_data, 'sale_grand_dis' => $sale_grand_dis, 'start' => $period_start, 'end' => $period_end));
        } else {
 $this->render(array('purchase_data' => $purchase_data, 'sales_data' => $sales_data, 'sale_grand_dis' => $sale_grand_dis, 'start' => $period_start, 'end' => $period_end), 'profit_loss_tpl');
           // $this->load->view('console/profit_loss_tpl', array('purchase_data' => $purchase_data, 'sales_data' => $sales_data, 'sale_grand_dis' => $sale_grand_dis, 'start' => $period_start, 'end' => $period_end));
        }
    }

}

?>