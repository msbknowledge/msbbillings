<?php
require_once __DIR__ . '/node_db.php';
if (isset($_GET['product_id'])) {
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_GET['term'])){
        $stmt = $conn->prepare('SELECT product_stocks.*,purchases.purchase_cgst_percent,purchases.purchase_unit FROM product_stocks left join purchases on purchase_product_id = product_stock_product  WHERE product_stock_product = '. $_GET['product_id'] .' and product_stock_batch  LIKE :term group by  product_stock_batch limit 0,20');
        $stmt->execute(array('term' => '%' . $_GET['term'] . '%'));
		} else {
		
			$stmt = $conn->prepare('SELECT product_stocks.*,purchases.purchase_cgst_percent,purchases.purchase_unit FROM product_stocks left join purchases on purchase_product_id = product_stock_product  WHERE product_stock_product = '. $_GET['product_id'] .'  group by  product_stock_batch limit 0,20');
			$stmt->execute(array());

		}
        while ($row = $stmt->fetch()) {
			$stmtx = $conn->prepare('SELECT products.* from products WHERE product_id = '. $_GET['product_id'] .'');
			$stmtx->execute(array());
			$rowx = $stmtx->fetch();
			$search['sale_expire_year'] = $row['product_expire_year'];
			$search['sale_expire_month'] = $row['product_expire_month'];
			$search['sale_cgst_percent'] = $row['purchase_cgst_percent']? $row['purchase_cgst_percent']:((float)$rowx['product_gst']/2);
			$search['product_stock_batch'] = $row['product_stock_batch'];
			$search['product_strip_stock'] = $row['product_strip_stock'];
			$search['product_loose_stock'] = $row['product_loose_stock'];
			//$search['sale_cgst_percent'] = $row['sale_cgst_percent']?$row['sale_cgst_percent']:6;
			$search['product_mrp'] = $row['product_mrp'];
			//if($row['medicine_unit']==0)
			//$row['medicine_unit'] = $row['purchase_unit'];
			$search['sale_mrp'] = $row['product_mrp'];
			if($search['product_strip_stock']==0 && $search['product_stock_loose'])
				continue;
            $responce[] = array('id' => '', 'label' => $search['product_stock_batch'].' [S:'.$search['product_strip_stock'].'|L:'.$search['product_loose_stock'].']('.$search['sale_expire_month'].'/'.$search['sale_expire_year'].') |'.$search['product_mrp'], 'value' => $search['product_stock_batch'], 'complete' => $search);
			
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

		
    /* Toss back results as json encoded array. */
    echo json_encode($responce);
}
?>
