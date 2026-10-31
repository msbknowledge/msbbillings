<?php
error_reporting(0);
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/node_db.php';

$responce = array();

if (isset($_GET['term']) && isset($_REQUEST['table']) && isset($_REQUEST['fieldToSearch'])) {
    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $_REQUEST['table']);
        $fieldToSearch = preg_replace('/[^a-zA-Z0-9_]/', '', $_REQUEST['fieldToSearch']);

        $stmt = $conn->prepare('SELECT * FROM ' . $table . ' WHERE ' . $fieldToSearch . ' LIKE :term LIMIT 0, 20');
        $stmt->execute(array('term' => '%' . $_GET['term'] . '%'));

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['doctor_name'] = isset($row['doctor_name']) ? $row['doctor_name'] : null;
            $row['sale_discount_percent'] = isset($row['medicine_discount']) ? $row['medicine_discount'] : 0;
            $row['sale_cgst_percent'] = isset($row['medicine_gst']) ? (float)$row['medicine_gst'] / 2 : 0;
            $row['sale_sgst_percent'] = $row['sale_cgst_percent'];

            $primaryId = isset($row['medicine_id']) ? $row['medicine_id'] : (isset($row['medicine_ID']) ? $row['medicine_ID'] : (isset($row['supplier_id']) ? $row['supplier_id'] : (isset($row['id']) ? $row['id'] : '')));
            if ($primaryId && !isset($row['medicine_id'])) {
                $row['medicine_id'] = $primaryId;
            }

            $label = isset($row[$fieldToSearch]) ? $row[$fieldToSearch] : '';
            $value = isset($row[$fieldToSearch]) ? $row[$fieldToSearch] : '';

            $responce[] = array(
                'id' => $primaryId,
                'label' => $label,
                'value' => $value,
                'complete' => $row
            );
        }
    } catch (PDOException $e) {
        // Output empty response on database error
    }
}

echo json_encode($responce);
exit;

