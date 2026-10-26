<?php
require_once __DIR__ . '/node_db.php';
if (isset($_GET['term'])) {
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT * FROM ' . $_REQUEST['table'] . ' WHERE ' . $_REQUEST['fieldToSearch'] . '  LIKE :term limit 0,20');
        $stmt->execute(array('term' => '%' . $_GET['term'] . '%'));

        while ($row = $stmt->fetch()) {
            $row['doctor_name'] = $row['doctor_name'];
			$row['sale_discount_percent'] = $row['medicine_discount'];
			$row['sale_cgst_percent'] = (float)$row['medicine_gst']/2;
            $responce[] = array('id' => '', 'label' => $row[$_REQUEST['fieldToSearch']], 'value' => $row[$_REQUEST['fieldToSearch']], 'complete' => $row);

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
	
	 // Search for doctor names
        // if ($_GET['table'] == 'doctors') {
        //     $stmt = $conn->prepare('SELECT * FROM doctors WHERE doctor_name LIKE :term LIMIT 0,20');
        //     $stmt->execute(array('term' => '%' . $_GET['term'] . '%'));

        //     while ($row = $stmt->fetch()) {
        //         // Fetch customers related to this doctor
        //         $doctor_id = $row['doctor_ID'];
        //         try {
        //             $customer_stmt = $conn->prepare('SELECT * FROM customers WHERE customer_ID IN (SELECT sale_customer_id FROM sales WHERE sale_doctor_id = :doctor_id)');
        //             $customer_stmt->execute(array('doctor_id' => $doctor_id));
        //         } catch (PDOException $e) {
        //             echo 'Error fetching customers: ' . $e->getMessage();
        //         }

        //         while ($customer = $customer_stmt->fetch()) {
        //             $response[] = array(
        //                 'doctor_name' => $row['doctor_name'],
        //                 'customer_name' => $customer['customer_name'],
        //                 'customer_address' => $customer['customer_address'],
        //                 'customer_contact' => $customer['customer_contact'],
        //                 'customer_gst' => $customer['customer_gst'],
        //             );
        //         }
        //     }
        // }
    /* Toss back results as json encoded array. */
    echo json_encode($responce);
}
?>
