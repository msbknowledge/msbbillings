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
class medicine_stock extends MY_Controller
{

    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->targetModel = 'medicine_stocks_model';
        $this->moduleMeta = array('medical' => 'medicine_stock');
        $this->page_config['tablePrimaryKey'] = $this->medicine_stocks_model->get_primary_key(); //pk
        /*         * page_config* */
        $this->page_config['title'] = 'Medicine Stock'; //search title bar
        $this->page_config['searchFields'] = 'medicine_stock_loose,medicine_stock_batch,medicine_mrp,medicine_expire_month,medicine_expire_year,medicine_strip_stock,medicine_loose_stock,medicine_name'; //search box,
        $this->page_config['list_columns'] = $this->page_config['searchFields'];
        $this->page_config['autocomplete']['medicine_name'] = array('medicines' => 'medicine_name');
        //$this->page_config['use_dropdown_columns'] = 'medicine_stock_medicine';
        //$this->page_config['use_dropdown_columns_options']['medicine_stock_medicine'] = $this->medicines_model->get_list_for_dropdown('medicine_name'); //pk
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        /*         * end page_config* */
    }

    public function fast_update()
    {
        $data = $this->input->post();

        if (!empty($data)) {
            $current_date = date('Y-m-d H:i:s');
            $medicine_id = $data['medicine_id'];
            $medicine['medicine_name'] = strtoupper($data['medicine_name']);
            $medicine['medicine_manufacturer'] = strtoupper($data['medicine_manufacturer']);
            $medicine['medicine_category'] = strtoupper($data['medicine_category']);
            $medicine['medicine_hsn'] = $data['medicine_hsn'];
            $medicine['medicine_unit'] = $data['medicine_unit'];
            $medicine['medicine_storage'] = strtoupper($data['medicine_storage']);

            if (empty($medicine_id)) {
                $medicine_id = $this->medicines_model->insert_data($medicine);
            } else {
                $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
            }

            $formatedData = null;
            $keyCount = 0;
            foreach ($data['medicine_stock_batch'] as $key => $value) {
                if (empty($data['medicine_strip_stock'][$key]) && empty($data['medicine_loose_stock'][$key])) {
                    continue;
                }
               
                // date('Y-m-d', strtotime($this->input->post('expiry_date')))
                $formatedData[$keyCount]['medicine_stock_batch'] = $data['medicine_stock_batch'][$key];
                $formatedData[$keyCount]['medicine_strip_stock'] = $data['medicine_strip_stock'][$key];
                $formatedData[$keyCount]['medicine_loose_stock'] = $data['medicine_loose_stock'][$key];
                $formatedData[$keyCount]['medicine_stock_date'] = $current_date;
                $formatedData[$keyCount]['medicine_expire_month'] = $data['medicine_expire_month'][$key];
                $formatedData[$keyCount]['medicine_expire_year'] = $data['medicine_expire_year'][$key];
                $formatedData[$keyCount]['medicine_mrp'] = $data['medicine_mrp'][$key];
                $formatedData[$keyCount]['medicine_stock_medicine'] = $medicine_id;
                $keyCount++;
            }
            //$this->db->query('delete from medicine_stocks where medicine_stock_medicine = ' . $medicine_id);
            
            if (!empty($formatedData[0]['medicine_stock_batch'])) {
                $this->{$this->targetModel}->insert_data($formatedData, true);
                $this->render(array('status' => 'success', 'data' => null, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
            }
        } else {
            $medicine_id = $this->uri->segment(4);
            $data = $this->medicines_model->get_list(array("medicine_id" => $medicine_id));
            $this->render($data[0], 'fast_update_tpl');
        }
    }
    public function medicine_history()
    {
        $data = $this->input->post();

        if (!empty($data)) {
            $medicine_id = $data['medicine_id'];
            $medicine['medicine_name'] = strtoupper($data['medicine_name']);
            $medicine['medicine_manufacturer'] = strtoupper($data['medicine_manufacturer']);
            $medicine['medicine_category'] = strtoupper($data['medicine_category']);
            $medicine['medicine_hsn'] = $data['medicine_hsn'];
            $medicine['medicine_unit'] = $data['medicine_unit'];
            $medicine['medicine_storage'] = $data['medicine_storage'];
            // if (empty($medicine_id)) {
            //     $medicine_id = $this->medicines_model->insert_data($medicine);
            // } else {
            //     $this->medicines_model->update_data($medicine, array('medicine_id' => $medicine_id));
            // }
            $formatedData = null;
            foreach ($data['medicine_stock_batch'] as $key => $value) {
                $formatedData[$key]['medicine_stock_batch'] = $data['medicine_stock_batch'][$key];
                $formatedData[$key]['medicine_strip_stock'] = $data['medicine_strip_stock'][$key];
                $formatedData[$key]['medicine_loose_stock'] = $data['medicine_loose_stock'][$key];
                $formatedData[$key]['medicine_stock_date'] = $data['medicine_stock_date'][$key];
                $formatedData[$key]['medicine_expire_month'] = $data['medicine_expire_month'][$key];
                $formatedData[$key]['medicine_expire_year'] = $data['medicine_expire_year'][$key];
                $formatedData[$key]['medicine_mrp'] = $data['medicine_mrp'][$key];
                $formatedData[$key]['medicine_stock_medicine'] = $medicine_id;
            }
            $this->db->query('delete from medicine_stocks where medicine_stock_medicine = ' . $medicine_id);
            $this->{$this->targetModel}->insert_data($formatedData, true);
            $this->render(array('status' => 'success', 'data' => null, 'message' => '<strong>Well done!</strong> Data Save.'), 'fast_update_tpl');
        } else {
            $this->render(null, 'medicine_history_tpl');
        }
    }

    public function shortage_view()
    {
        //$this->load->view('console/medicine_stock/shortage_tpl');
         $this->render(null, 'shortage_tpl');
    }
    public function shortage()
    {
        $medicine_name = $this->input->post("medicine_name");
        $per_page = 100;
        if (!empty($this->input->get("page"))) {
            $page = $this->input->get("page");
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //$start = ($start_from + 1);
        $sql = "SELECT m.* FROM `medicines` m WHERE 1=1";
        if (!empty($medicine_name)) {
            $sql .= " AND m.medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " limit " . $start_from . "," . $per_page . "";
        $data = $this->db->query($sql)->result_array();

        foreach ($data as $k => $v) {
            $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
            $data[$k]['left_strip'] = $stock['left_strip'];
            $data[$k]['left_loose'] = $stock['left_loose'];
        }
        $res_data = array();
        if (count($data) > 0) {
            $res_data["status"] = "found";
            $res_data["result"] = $data;
            header('Content-Type: application/json');
            echo json_encode($res_data);
        } else {
            $res_data["status"] = "not found";
            header('Content-Type: application/json');
            echo json_encode($res_data);
        }
        //$this->render(array('result' => $data, 'total_records' => $total_records, 'total_records_per_page' => $total_records_per_page), 'shortage_tpl');
    }

    public function stock_view()
    {
        //$this->load->view('console/medicine_stock/stock_tpl');
        $this->render(null, 'stock_tpl');
    }

    public function stock()
    {
        $medicineNname = $this->input->post("medicine_name");
        $medicine_name = isset($medicineNname) ? $medicineNname : '';
        $per_page = 50;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        $sql = "SELECT m.* FROM `medicines` m  WHERE 1=1";
        if (!empty($medicine_name)) {
            $sql .= " AND m.medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " limit " . $start_from . "," . $per_page . "";
        $data = $this->db->query($sql)->result_array();

        foreach ($data as $k => $v) {
            $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
            $data[$k]['left_strip'] = $stock['left_strip'];
            $data[$k]['left_loose'] = $stock['left_loose'];
        }
        if (count($data) > 0) {
            echo json_encode(array("status" => "found", "result" => $data));
        } else {
            echo json_encode(array("status" => "not found"));
        }
    }

    public function current_stock()
    {
       $sql = "SELECT m.medicine_id,p.purchase_mrp
        FROM medicines m 
        JOIN purchases p ON m.medicine_id = p.purchase_medicine_id 
        group by m.medicine_id, p.purchase_medicine_id";
        $medicine_data = $this->db->query($sql)->result_array();
        $total_amount = 0;
        foreach ($medicine_data as $k => $v) {
            $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
            $left_strip = $stock['left_strip'];
            if ($left_strip == 0){
                continue;
            }
            $total_amount += $v['purchase_mrp'] * $left_strip;

            // $result = $this->db->query("SELECT SUM(purchase_mrp *  $left_strip) as totalamount FROM purchases WHERE purchase_medicine_id = '" . $v['medicine_id'] . "'")->result_array();
            // $total_amount += $result[0]['totalamount'];
        }
        echo json_encode(array("status" => "success", "result" => $total_amount));
       // $this->load->view('console/medicine_stock/current_stock amount_tpl', array('total_amount' => $total_amount));
    }

    public function stock_amount()
    {
        $medicine_manufacturer = $this->input->post('medicine_manufacturer');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        if ($this->input->post()) {
            $sql = "SELECT medicine_id,medicine_name,medicine_manufacturer,purchase_date,purchase_mrp,purchase_batch 
            FROM `medicines` join `purchases` on medicines.medicine_id=purchases.purchase_medicine_id where 1=1";
            if (!empty($medicine_manufacturer)) {
                $sql .= " AND medicines.medicine_manufacturer like '%" . $medicine_manufacturer . "%'";
            }
            $sql .= " GROUP BY medicine_id order by purchase_date DESC";

            $data = $this->db->query($sql)->result_array();
            foreach ($data as $k => $v) {
                $stock = $this->{$this->targetModel}->stock_of_medicine($v['medicine_id']);
                // if($stock['left_strip'] == 0)
                //     continue;
                $data[$k]['purchase_total'] = ($stock['left_strip'] * $v['purchase_mrp']);
            }

            $this->load->view('console/medicine_stock/stock_ajax_amount_tpl', array('data' => $data, 'start' => $start, 'end' => $end));
        } else {
           // $this->load->view('console/medicine_stock/stock_amount_tpl', array());
            $this->render(null, 'stock_amount_tpl');
        }
    }

    public function stock_sales_statement(){
        if ($this->input->post()) {
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $purchase_sql = "SELECT purchase_quantity, medicine_name from `purchases` 
            JOIN medicines ON purchases.purchase_medicine_id = medicines.medicine_id 
            WHERE purchase_date >= '".$start."' AND purchase_date <= '".$end."'";
            $purchase_data =  $this->db->query($purchase_sql)->result_array();
            $this->load->view('console/medicine_stock/stock_sales_ajax_statement_tpl', array());
        }else{
            $this->load->view('console/medicine_stock/stock_sales_statement_tpl', array());
        }
    }

    public function stock_by_batch()
    {
        $medicine_id = $this->input->get("medicine_id");
        $medicine_batch = $this->input->get("term");
        $isdebug = !empty($this->input->get("debug"));
    $medicine =  $this->db->query("select distinct purchase_batch as batch,purchase_expire_month as expire_month,purchase_expire_year as expire_year,purchase_cgst_percent as cgst_percent,purchase_mrp as mrp,medicine_category,medicine_schedule from medicines join `purchases` on medicines.medicine_id=purchases.purchase_medicine_id where purchases.purchase_medicine_id=" . $medicine_id)->result_array();

        $purchased_batch =  $this->db->query("select distinct purchase_batch as batch,purchase_expire_month as expire_month,purchase_expire_year as expire_year,purchase_cgst_percent as cgst_percent,purchase_mrp as mrp from purchases where purchase_medicine_id=" . $medicine_id)->result_array();

        $purcased_return =  $this->db->query("select distinct return_purchase_batch as batch,return_purchase_expire_month as expire_month,return_purchase_expire_year as expire_year,return_purchase_mrp as mrp from  return_purchases where return_purchase_medicine_id=" . $medicine_id)->result_array();

        $sold_return =  $this->db->query("select distinct return_sale_batch as batch,return_sale_expire_month as expire_month,return_sale_expire_year as expire_year,return_sale_mrp as mrp from  returns_sales where return_sale_medicine_id=" . $medicine_id)->result_array();

        $stock =  $this->db->query("select distinct medicine_stock_batch as batch,medicine_expire_month as expire_month,medicine_expire_year as expire_year,medicine_mrp as mrp from  medicine_stocks where medicine_stock_medicine=" . $medicine_id)->result_array();

        $sale_batch =  $this->db->query("select distinct sale_batch as batch,sale_expire_month as expire_month,sale_expire_year as expire_year,sale_cgst_percent as cgst_percent,sale_mrp as mrp from sales where sale_medicine_id=" . $medicine_id)->result_array();

        //pr($sale_batch,1);
       // pr($purchased_batch);
        $merged = array_merge($sale_batch, $purcased_return, $sold_return, $stock, $medicine);
   
        $unique = null;
        foreach ($merged as $mr) {
            $unique[$mr['batch']] = $mr;
        }
        $batches = null;
 // pr($unique,1);

        $responce = null;
        foreach ($unique as $k => $v) {
            if (!(empty($medicine_batch)) && $v['batch'] != $medicine_batch) {
                continue;
            }
            $stock = $this->{$this->targetModel}->stock_of_medicine($medicine_id, $v['batch']);
            
            // ✅ Compute New MRP and Rate
            $oldMrp = floatval($v['mrp']);
            $oldGst = floatval($v['cgst_percent']) * 2;
            $newMrp = $oldMrp;
    
            if ($oldGst == 12) {
                $newMrp = round($oldMrp * 0.9375, 2);
            } elseif ($oldGst == 18) {
                $newMrp = round($oldMrp * 0.8898, 2);
            }
    
            // ✅ Calculate Rate (MRP × 0.7619)
            $rate = round($newMrp * 0.7619, 2);

            $data[$v['batch']]['medicine_id'] = $medicine_id;
            $data[$v['batch']]['stock'] = $stock['stock'];
            $data[$v['batch']]['return_stock'] = $stock['return_stock'];
            $data[$v['batch']]['sold_stock'] = $stock['sold_stock'];
            $data[$v['batch']]['sold_return_stock'] = $stock['sold_return_stock'];
            $data[$v['batch']]['left_strip'] = $stock['left_strip'];
            $data[$v['batch']]['left_loose'] = $stock['left_loose'];
            $data[$v['batch']]['balance_stock'] = $stock['balance_stock'];
            $data[$v['batch']]['medicine_category'] = $v['medicine_category'];
             $data[$v['batch']]['medicine_schedule'] = $v['medicine_schedule'];
            $data[$v['batch']]['medicine_mrp'] = $v['mrp'];
            $data[$v['batch']]['medicine_mrp'] = $v['mrp'];
            $data[$v['batch']]['sale_mrp'] = $v['mrp'];
            $data[$v['batch']]['sale_new_mrp'] =$newMrp;
            $data[$v['batch']]['sale_rate'] =$rate;
            $data[$v['batch']]['sale_expire_month'] = $v['expire_month'];
            $data[$v['batch']]['sale_expire_year'] = $v['expire_year'];
            $data[$v['batch']]['sale_cgst_percent'] = 2.5;//$v['cgst_percent'];

            if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                if (!$isdebug)
                    continue;
            }
            $responce[] = array('id' => '', 'label' => $v['batch'] . ' [S:' . $stock['left_strip'] . '|L:' . $stock['left_loose'] . '](' . $v['expire_month'] . '/' . $v['expire_year'] . ') |' . $v['mrp'], 'value' => $v['batch'], 'complete' => $data[$v['batch']]);
        }
         //  pr( $responce,1);
        header('Content-Type: application/json');
        echo json_encode($responce);
    }

    public function stock_by_batch_old()
    {
        $medicine_id = $this->input->get("medicine_id");
        $medicine_batch = $this->input->get("term");
        $isdebug = !empty($this->input->get("debug"));

        $purchased_batch =  $this->db->query("select distinct purchase_batch,purchase_expire_month,purchase_expire_year,purchase_cgst_percent,purchase_mrp from purchases where purchase_medicine_id=" . $medicine_id)->result_array();
        $responce = null;
        foreach ($purchased_batch as $k => $v) {
            if (!(empty($medicine_batch)) && $v['purchase_batch'] != $medicine_batch) {
                continue;
            }
            $stock = $this->{$this->targetModel}->stock_of_medicine($medicine_id, $v['purchase_batch']);
            $data[$v['purchase_batch']]['medicine_id'] = $medicine_id;
            $data[$v['purchase_batch']]['purchase_stock'] = $stock['purchase_stock'];
            $data[$v['purchase_batch']]['purchase_return_stock'] = $stock['purchase_return_stock'];
            $data[$v['purchase_batch']]['sold_stock'] = $stock['sold_stock'];
            $data[$v['purchase_batch']]['sold_return_stock'] = $stock['sold_return_stock'];
            $data[$v['purchase_batch']]['left_strip'] = $stock['left_strip'];
            $data[$v['purchase_batch']]['left_loose'] = $stock['left_loose'];
            $data[$v['purchase_batch']]['balance_stock'] = $stock['balance_stock'];

            $data[$v['purchase_batch']]['medicine_mrp'] = $v['purchase_mrp'];
            $data[$v['purchase_batch']]['medicine_mrp'] = $v['purchase_mrp'];
            $data[$v['purchase_batch']]['sale_mrp'] = $v['purchase_mrp'];
            $data[$v['purchase_batch']]['sale_expire_month'] = $v['purchase_expire_month'];
            $data[$v['purchase_batch']]['sale_expire_year'] = $v['purchase_expire_year'];
            $data[$v['purchase_batch']]['sale_cgst_percent'] = $v['purchase_cgst_percent'];

            if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                if (!$isdebug)
                    continue;
            }
            $responce[] = array('id' => '', 'label' => $v['purchase_batch'] . ' [S:' . $stock['left_strip'] . '|L:' . $stock['left_loose'] . '](' . $v['purchase_expire_month'] . '/' . $v['purchase_expire_year'] . ') |' . $v['purchase_mrp'], 'value' => $v['purchase_batch'], 'complete' => $data[$v['purchase_batch']]);
        }
        header('Content-Type: application/json');
        echo json_encode($responce);
    }

    public function get_info()
    {
        $medicine = $this->medicines_model->get_list(array("medicine_name" => $this->input->post('medicine')));
        $stock =  $this->{$this->targetModel}->stock_of_medicine($medicine[0]['medicine_id']);
        $this->load->view('console/medicine_stock/get_info_tpl', array('stock' => $stock, 'medicine' => $medicine[0]));
    }

    public function get_infox()
    {
        $medicine = $this->medicines_model->get_list(array("medicine_name" => $this->input->post('medicine')));
        $purchased_batch =  $this->db->query("select distinct purchase_batch from purchases where purchase_medicine_id=" . $medicine[0]['medicine_id'])->result_array();
        $responce = null;
        foreach ($purchased_batch as $k => $v) {
            $stock =  $this->{$this->targetModel}->stock_of_medicine($medicine[0]['medicine_id'], $v['purchase_batch']);
            if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {

                continue;
            }
            $data[$v['purchase_batch']] = $stock;
        }

        $this->load->view('console/medicine_stock/get_info_tpl', array('stock' => $data, 'medicine' => $medicine[0]));
    }
    public function expiring_view()
    {
        //$this->load->view('console/medicine_stock/upcomming_expire_tpl');
       // pr("work in progress", 1);
        $this->render(null, 'upcomming_expire_tpl');
    }
    public function expiring()
    {
        $medicine_name = $this->input->post("medicine_name");
        $per_page = 500;
        $page = $this->input->get("page");
        if ($page == 0) {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        $current_ym = date('ym');
        $current_ym_plus = date('ym', strtotime('+4 months'));
        $plus_m = date('ym', strtotime('+4 months'));
        $sql = "select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) as up_expdate, medicines.*, purchases.* from purchases 
        join medicines on purchase_medicine_id = medicine_id) as vtable where up_expdate between $current_ym and $plus_m";
        if (!empty($medicine_name)) {
            $sql .= " and medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " order by purchase_expire_year, purchase_expire_month limit $start_from,$per_page";

        $medicine_data = $this->db->query($sql)->result_array();
        $data = array();
        if (count($medicine_data) > 0) {
            foreach ($medicine_data as $k => $medicine) {
                $stock = $this->{$this->targetModel}->stock_of_medicine($medicine['medicine_id'], $medicine['purchase_batch']);
                $medicine_data[$k]['left_strip'] = $stock['left_strip'];
                $medicine_data[$k]['left_loose'] = $stock['left_loose'];
                if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                    unset($medicine_data[$k]);
                }
            }
            // $result = $this->{$this->targetModel}->expire();
            // $this->render(array('uri'=>'expiring','result' => $result), 'expire_tpl');
            $data["status"] = "found";
            $data["result"] = $medicine_data;
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            $data["status"] = "not found";
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
    public function expired_view()
    {
       
        $this->render(null, 'expired_tpl');
       // $this->load->view('console/medicine_stock/expired_tpl');
    }
    public function expired()
    {
        $medicine_name = $this->input->post("medicine_name");
        $per_page = 500;
        $page = $this->input->get("page");
        if ($page == 0) {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //$start = ($start_from + 1);

        $current_y = date('y');
        $current_m = date('m');
        $sql = "select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) 
            as expdate, medicines.*, purchases.* 
                from purchases join medicines on purchase_medicine_id = medicine_id) as vtable where expdate <= $current_y$current_m";
        if (!empty($medicine_name)) {
            $sql .= " and medicine_name like '%" . $medicine_name . "%'";
        }
        $sql .= " order by purchase_expire_year desc,purchase_expire_month desc limit $start_from,$per_page";
        $medicine_data = $this->db->query($sql)->result_array();
        $data = array();
        if (count($medicine_data) > 0) {
            foreach ($medicine_data as $k => $medicine) {
                $stock = $this->{$this->targetModel}->stock_of_medicine($medicine['medicine_id'], $medicine['purchase_batch']);
                $medicine_data[$k]['left_strip'] = $stock['left_strip'];
                $medicine_data[$k]['left_loose'] = $stock['left_loose'];
                if ($stock['left_strip'] == 0 && $stock['left_loose'] == 0) {
                    unset($medicine_data[$k]);
                }
            }
            $data["status"] = "found";
            $data["result"] = $medicine_data;
            // $result = $this->{$this->targetModel}->expire(true);
            // $this->render(array('uri'=>'expired','result' => $result), 'expire_tpl');

            // echo json_encode(array("status"=>"found","result"=>$medicine_data));
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            $data["status"] = "not found";
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    public function zeronegetive()
    {
        pr("work in progress", 1);
        $result = $this->{$this->targetModel}->zeronegetive(true);
        $this->render(array('result' => $result), 'zeronegetive_tpl');
    }

    public function reconsile()
    {
        $data = json_decode(file_get_contents("https://www.medicea.in/rest/med/drug/all/Digene"), true);
        foreach ($data as $k => $d) {
            $mapped[$k]['medicine_name'] = $d['name'];
            $mapped[$k]['medicine_manufacturer'] = $d['companyName'];
            $mapped[$k]['medicine_category'] = $d['type'];
            $mapped[$k]['medicine_hsn'] = $d['hsnCode'];
            $mapped[$k]['medicine_unit'] = @$d['packing'];
        }
        pr(($mapped));
    }
}
