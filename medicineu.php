<?php
$nodeSegment = explode('.',$_SERVER['SERVER_NAME']);
$node = 'u404684354_suraksha';
//$node = 'u204249081_'.$nodeSegment[0];
define('DB_SERVER', 'localhost');
define('DB_USER', 'u404684354_node');
define('DB_PASSWORD', 'BR66MK55@msb');
define('DB_NAME', $node);

$sql = "";
    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT medicine_id,medicine_name FROM medicines WHERE medicines.medicine_name in( SELECT DISTINCT return_purchase_medicine FROM `return_purchases` where return_purchase_medicine_id IS NULL) ORDER BY `medicines`.`medicine_id` limit 0,20');
$stmt->execute();


        while ($row = $stmt->fetch()) {
$sql.="UPDATE return_purchases SET return_purchase_medicine_id = '".$row['medicine_id']."' WHERE return_purchase_medicine = '".$row['medicine_name']."';";

        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
echo $sql;
 $stmtz = $conn->prepare($sql);
 $stmtz ->execute();
    /* Toss back results as json encoded array. */
    //echo $sql;

?>
