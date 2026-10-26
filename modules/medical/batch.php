<?php
// $nodeSegment = explode('.',$_SERVER['SERVER_NAME']);
// $node = 'simplebillings_'.$nodeSegment[0];
// define('DB_SERVER', 'localhost');
// define('DB_USER', 'simplebillings');
// define('DB_PASSWORD', '66Od1IK8cIIEMkTgCKv7');
// define('DB_NAME', $node);
$nodeSegment = explode('.',$_SERVER['SERVER_NAME']);
$node = 'u188759301_'.$nodeSegment[0];
define('DB_SERVER', 'localhost');
define('DB_USER',$node);
define('DB_PASSWORD', 'BR66MK55@msb');
define('DB_NAME', $node);
if (isset($_GET['medicine_id'])) {
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_GET['term'])){
        $stmt = $conn->prepare('SELECT medicine_stocks.*,purchases.purchase_cgst_percent,purchases.purchase_unit FROM medicine_stocks left join purchases on purchase_medicine_id = medicine_stock_medicine  WHERE medicine_stock_medicine = '. $_GET['medicine_id'] .' and medicine_stock_batch  LIKE :term group by  medicine_stock_batch limit 0,20');
        $stmt->execute(array('term' => '%' . $_GET['term'] . '%'));
		} else {
		
			$stmt = $conn->prepare('SELECT medicine_stocks.*,purchases.purchase_cgst_percent,purchases.purchase_unit FROM medicine_stocks left join purchases on purchase_medicine_id = medicine_stock_medicine  WHERE medicine_stock_medicine = '. $_GET['medicine_id'] .'  group by  medicine_stock_batch limit 0,20');
			$stmt->execute(array());

		}
        while ($row = $stmt->fetch()) {
			$stmtx = $conn->prepare('SELECT medicines.* from medicines WHERE medicine_ID = '. $_GET['medicine_id'] .'');
			$stmtx->execute(array());
			$rowx = $stmtx->fetch();
			$search['sale_expire_year'] = $row['medicine_expire_year'];
			$search['sale_expire_month'] = $row['medicine_expire_month'];
			$search['sale_cgst_percent'] = $row['purchase_cgst_percent']? $row['purchase_cgst_percent']:((float)$rowx['medicine_gst']/2);
			$search['medicine_stock_batch'] = $row['medicine_stock_batch'];
			$search['medicine_strip_stock'] = $row['medicine_strip_stock'];
			$search['medicine_loose_stock'] = $row['medicine_loose_stock'];
			//$search['sale_cgst_percent'] = $row['sale_cgst_percent']?$row['sale_cgst_percent']:6;
			$search['medicine_mrp'] = $row['medicine_mrp'];
			//if($row['medicine_unit']==0)
			//$row['medicine_unit'] = $row['purchase_unit'];
			$search['sale_mrp'] = $row['medicine_mrp'];
			if($search['medicine_strip_stock']==0 && $search['medicine_loose_stock'])
				continue;
            $responce[] = array('id' => '', 'label' => $search['medicine_stock_batch'].' [S:'.$search['medicine_strip_stock'].'|L:'.$search['medicine_loose_stock'].']('.$search['sale_expire_month'].'/'.$search['sale_expire_year'].') |'.$search['medicine_mrp'], 'value' => $search['medicine_stock_batch'], 'complete' => $search);
			
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

	
    /* Toss back results as json encoded array. */
    echo json_encode($responce);
}
?>
