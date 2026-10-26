<?php
require_once __DIR__ . '/node_db.php';
// $node = 'simplebillings_'.$nodeSegment[0];
// define('DB_SERVER', 'localhost');
// define('DB_USER', 'simplebillings');
// define('DB_PASSWORD', '#logic#123');
// define('DB_NAME', $node);
if (isset($_GET['term'])) {
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       # echo '<pre>';print_r($_REQUEST);die();
        $stmt = $conn->prepare('SELECT * FROM ' . $_REQUEST['table'] . ' WHERE ' . $_REQUEST['fieldToSearch'] . '  LIKE :term limit 0,20');
        $stmt->execute(array('term' => '%' . $_GET['term'] . '%'));

        while ($row = $stmt->fetch()) {
            $responce[] = array('id' => $id, 'label' => $row[$_REQUEST['fieldToSearch']], 'value' => $row[$_REQUEST['fieldToSearch']], 'complete' => $row);
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
	if($_REQUEST['table']=="medicines" && (!isset($_REQUEST['location']))&& (count($responce)<5) && (strlen(trim($_GET['term']))>2)){
	/*	$data = json_decode(file_get_contents('search/'.str_ireplace(' ','-',strtoupper($_GET['term']))),true);	
		if(empty($data)){
		$data = json_decode(file_get_contents("https://www.medicea.in/rest/med/drug/all/".$_GET['term']),true);
		file_put_contents('search/'.str_ireplace(' ','-',strtoupper($_GET['term'])),$data);
		} */
		foreach($data as $k=>$d){
			$mapped['medicine_name'] = $d['name'];
			$mapped['medicine_manufacturer'] = $d['companyName'];
			$mapped['medicine_category'] = $d['type'];
			$mapped['medicine_hsn'] = $d['hsnCode'];
			$mapped['medicine_unit'] = @$d['packing'];
			$mapped['purchase_unit'] = @$d['packing'];
            $responce[] = array('id' => $id, 'label' => $mapped[$_REQUEST['fieldToSearch']].'*', 'value' => $mapped[$_REQUEST['fieldToSearch']], 'complete' => $mapped);
		}
	}	
    /* Toss back results as json encoded array. */
    echo json_encode($responce);
}
?>