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
class product_stocks_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'product_stocks';
        $this->joiningArray[0]['table'] = 'products';
        $this->joiningArray[0]['condition'] = 'product_stock_product = product_id';
        $this->check();
    }

    public function install() {
        $this->db->query("CREATE TABLE `product_stocks` (
  `product_stock_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_stock_product` int(11) NOT NULL,
  `product_stock_batch` varchar(30) NOT NULL DEFAULT 'N/A',
  `product_strip_stock` int(11) NOT NULL,
  `product_loose_stock` int(11) NOT NULL,
  `product_expire_month` int(11) NOT NULL,
  `product_expire_year` int(11) NOT NULL,
  `product_stock_loose` int(11) NOT NULL DEFAULT '0',
  `product_mrp` decimal(11,2) NOT NULL,
 PRIMARY KEY (`product_stock_ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
");
        $this->db->query("INSERT INTO `product_stocks` (`product_stock_ID`, `product_stock_product`, `product_stock_batch`, `product_strip_stock`) VALUES
(4, 12, '#bbc', 20),
(5, 1, 'rr55', 11),
(6, 1, 'llo445', 0),
(7, 1, 'aaas12', 0),
(8, 4, 'BA72219', 0),
(9, 1, 'lm123333', -11),
(10, 2, 'mmlasdmad', -6),
(11, 1, 'lmsladmalsdm', -21),
(12, 3, 'MKLSD', -1),
(13, 5, 'aaa001', -22),
(14, 6, 'aaa01', 0),
(15, 5, 'aaa01', 22);
");
       
    }

    public function expire($already_expired = false) {
        $current_y = date('y');
        $current_m = date('m');
        if ($already_expired) {
            return $this->db->query("select products.*, product_stocks.* from product_stocks join products on product_stock_product = product_id where product_expire_year <= $current_y and product_expire_month <= $current_m order by product_expire_year asc,product_expire_month asc")->result_array();
        } else {
            return $this->db->query("select products.*, product_stocks.* from product_stocks join products on product_stock_product = product_id where product_expire_year <= $current_y and product_expire_month > $current_m order by product_expire_year asc,product_expire_month asc")->result_array();
        }
    }

    public function zeronegetive() {

        return $this->db->query("select products.*, product_stocks.* from product_stocks join products on product_stock_product = product_id where"
                        . "  product_loose_stock <= 0 && product_strip_stock <= 0")->result_array();
    }

    public function shortage() {
        return $this->db->query('select * from 
		(select product_stock_product,sum(product_strip_stock) as stock_count,sum(product_loose_stock) as loose_count  from product_stocks group by product_stock_product) stocks join products on stocks.product_stock_product = products.product_id  where stocks .stock_count <= 2 order by stocks .stock_count desc')->result_array();
    }
   public function stock() {
        return $this->db->query('select * from 
		(select product_stock_product,product_mrp,sum(product_strip_stock) as stock_count,sum(product_loose_stock) as loose_count  from product_stocks group by product_stock_product) stocks join products on stocks.product_stock_product = products.product_id  where stocks .stock_count >0 order by stocks .stock_count desc')->result_array();
    } 

}

?>
