<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site_settings_model
 *
 * @author kALLOL
 * 
 * 
 */
class medicine_stocks_model extends MY_Model
{

    //put your code here

    public $table_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'medicine_stocks';
        $this->joiningArray[0]['table'] = 'medicines';
        $this->joiningArray[0]['condition'] = 'medicine_stock_medicine = medicine_id';
        $this->check();
    }

    public function install()
    {
        $this->db->query("CREATE TABLE `medicine_stocks` (
  `medicine_stock_ID` int(11) NOT NULL AUTO_INCREMENT,
  `medicine_stock_medicine` int(11) NOT NULL,
  `medicine_stock_batch` varchar(30) NOT NULL DEFAULT 'N/A',
  `medicine_strip_stock` int(11) NOT NULL,
  `medicine_loose_stock` int(11) NOT NULL,
  `medicine_expire_month` int(11) NOT NULL,
  `medicine_expire_year` int(11) NOT NULL,
  `medicine_stock_loose` int(11) NOT NULL DEFAULT '0',
  `medicine_mrp` decimal(11,2) NOT NULL,
 PRIMARY KEY (`medicine_stock_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
");
        // $this->db->query("INSERT INTO `medicine_stocks` (`medicine_stock_ID`, `medicine_stock_medicine`, `medicine_stock_batch`, `medicine_strip_stock`) VALUES
        // (4, 12, '#bbc', 20),
        // (5, 1, 'rr55', 11),
        // (6, 1, 'llo445', 0),
        // (7, 1, 'aaas12', 0),
        // (8, 4, 'BA72219', 0),
        // (9, 1, 'lm123333', -11),
        // (10, 2, 'mmlasdmad', -6),
        // (11, 1, 'lmsladmalsdm', -21),
        // (12, 3, 'MKLSD', -1),
        // (13, 5, 'aaa001', -22),
        // (14, 6, 'aaa01', 0),
        // (15, 5, 'aaa01', 22);
        // ");

    }

    public function expire($already_expired = false)
    {
        $current_y = date('y');
        $current_m = date('m');
        $limit = 1000;
        $page = intval($this->uri->segment(4));
        if ($page == 0) {
            $page = 1;
        }
        $start = ($page - 1) * $limit;
        if ($already_expired) {
            $medicine_data =  $this->db->query("
                select * from (select CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) 
                as expdate, medicines.*, purchases.* 
				from purchases join medicines on purchase_medicine_id = medicine_id) as vtable where expdate <= $current_y$current_m order by purchase_expire_year desc,purchase_expire_month desc limit $start,$limit")->result_array();
            //print_r($medicine_data);
            //  // print_r($this->db->last_query());
            //die();

            $medicine_count_data  =  $this->db->query("
				select count(*) as count from ( 
                select distinct medicine_id as m_id,CONCAT(purchase_expire_year,LPAD(purchase_expire_month,2,'0')) 
                as expdate,medicines.*, purchases.* 
				from purchases join medicines on purchase_medicine_id = medicine_id ) as vtable
				where 
				expdate	<= $current_y$current_m  
				")->result_array();
            // print_r($medicine_count_data);
            // die();	
        } else {

            $medicine_data =  $this->db->query("
            select distinct purchase_batch,medicines.*, 
            purchases.* 
            from purchases join medicines on purchase_medicine_id = medicine_id 
            where 
            purchase_expire_year >= $current_y
            and purchase_expire_month >= $current_m 
            order by purchase_expire_year asc,purchase_expire_month asc limit $start,$limit")->result_array();

            $medicine_count_data  =  $this->db->query("
				select  count(*) as count
            from purchases join medicines on purchase_medicine_id = medicine_id 
            where 
            purchase_expire_year >= $current_y
            and purchase_expire_month >= $current_m 
            ")->result_array();
        }

        $counter = 0;
        foreach ($medicine_data as $k => $medicine) {
            $counter++;
            $stock = $this->stock_of_medicine($medicine['medicine_id'], $medicine['purchase_batch']);
            $medicine_data[$k]['stock'] = $stock;
            if ($stock['left_strip'] <= 0 && $stock['left_loose'] <= 0) {
                unset($medicine_data[$k]);
            }
        }
        return array("data" => $medicine_data, "count" => $medicine_count_data);
    }

    public function zeronegetive()
    {

        return $this->db->query("select medicines.*, medicine_stocks.* from medicine_stocks join medicines on medicine_stock_medicine = medicine_id where"
            . "  medicine_loose_stock <= 0 && medicine_strip_stock <= 0")->result_array();
    }

    public function shortage()
    {
        return $this->db->query('select * from 
		(select medicine_stock_medicine,sum(medicine_strip_stock) as stock_count,sum(medicine_loose_stock) as loose_count  from medicine_stocks group by medicine_stock_medicine) stocks join medicines on stocks.medicine_stock_medicine = medicines.medicine_id  where stocks .stock_count <= 2 order by stocks .stock_count desc')->result_array();
    }
    public function stock()
    {
        return $this->db->query('select * from 
		(select medicine_stock_medicine,medicine_mrp,sum(medicine_strip_stock) as stock_count,sum(medicine_loose_stock) as loose_count  from medicine_stocks group by medicine_stock_medicine) stocks join medicines on stocks.medicine_stock_medicine = medicines.medicine_id  where stocks .stock_count >0 order by stocks .stock_count desc')->result_array();
    }
    public function purchase_stock_count($purchase_medicine_id, $purchase_batch = "")
    {
        $sql = "SELECT (SUM(purchase_quantity)+SUM(purchase_free_quantity)) purchase_stock  from `purchases` WHERE purchase_medicine_id = $purchase_medicine_id ";
        if ($purchase_batch != "") {
            $sql .= " AND purchase_batch = '$purchase_batch'";
        }
        $data =  $this->db->query($sql)->result_array();
        return $data[0];
    }
    public function sale_stock_count($sale_medicine_id, $sale_batch = "")
    {
        $sql = "SELECT (SUM(sale_strip_quantity)) soled_strip,(SUM(sale_loose_quantity)) soled_loose  from `sales` WHERE sale_medicine_id = $sale_medicine_id ";
        if ($sale_batch != "") {
            $sql .= " AND sale_batch = '$sale_batch'";
        }
        $data =  $this->db->query($sql)->result_array();
        return $data[0];
    }
    public function balance_stock_count($medicine_stock_medicine, $medicine_stock_batch = "")
    {
        $sql = "SELECT (SUM(medicine_strip_stock)) balanced_strip,(SUM(medicine_loose_stock)) balanced_loose  from `medicine_stocks` WHERE medicine_stock_medicine = $medicine_stock_medicine ";
        if ($medicine_stock_batch != "") {
            $sql .= " AND medicine_stock_batch = '$medicine_stock_batch'";
        }
        $data =  $this->db->query($sql)->result_array();
        return $data[0];
    }
    public function purchase_return_stock_count($medicine_id, $return_purchase_Batch = "")
    {

        $sql = "SELECT SUM(return_purchase_strip) return_purchase_stock  from `return_purchases` WHERE return_purchase_medicine_id = $medicine_id";

        if ($return_purchase_Batch != "") {
            $sql .= " AND return_purchase_Batch = '$return_purchase_Batch'";
        }
        $data =  $this->db->query($sql)->result_array();
        return $data[0];
    }
    public function sale_return_stock_count($medicine_id, $return_sale_Batch = "")
    {
        $sql = "SELECT SUM(	return_sale_strip) return_sale_stock  from `returns_sales` WHERE return_sale_medicine_id = $medicine_id ";
        if ($return_sale_Batch != "") {
            $sql .= " AND return_sale_Batch = '$return_sale_Batch'";
        }
        $data =  $this->db->query($sql)->result_array();
        return $data[0];
    }

    public function stock_of_medicine($medicine_id, $medicine_batch = "")
    {

        $medicine = $this->medicines_model->get_list(array("medicine_ID" => $medicine_id));
        $data['medicine_unit'] = $medicine[0]['medicine_unit'];

        $data['purchase_stock'] = $this->purchase_stock_count($medicine_id, $medicine_batch);
        $data['purchase_return_stock'] = $this->purchase_return_stock_count($medicine_id, $medicine_batch);

        $data['sold_stock'] = $this->sale_stock_count($medicine_id, $medicine_batch);
        $data['sold_return_stock'] = $this->sale_return_stock_count($medicine_id, $medicine_batch);

        $data['balance_stock'] = $this->balance_stock_count($medicine_id, $medicine_batch);

        $data['left_strip'] =
            floatval($data['purchase_stock']['purchase_stock']) -
            floatval($data['sold_stock']['soled_strip']) -
            floatval($data['purchase_return_stock']['return_purchase_stock']) +
            floatval($data['sold_return_stock']['return_sale_stock']) +
            floatval($data['balance_stock']['balanced_strip']);
        $balanced_loose = 0 + floatval($data['balance_stock']['balanced_loose']) - floatval($data['sold_stock']['soled_loose']);
        $looseLeft = 0;
        if ($balanced_loose > 0) {
            $fromStrip = ceil($balanced_loose / floatval($medicine[0]['medicine_unit']));
            $looseLeft =   ($fromStrip * floatval($medicine[0]['medicine_unit'])) - $balanced_loose;
        }
        if ($balanced_loose < 0) {
            $fromStrip = floor($balanced_loose / floatval($medicine[0]['medicine_unit']));
            $looseLeft =  $balanced_loose -  ($fromStrip * floatval($medicine[0]['medicine_unit']));
        }
        $data['left_strip']  += $fromStrip;
        $data['left_loose'] = $looseLeft;


        //	echo json_encode($data);

        return $data;
    }
}
