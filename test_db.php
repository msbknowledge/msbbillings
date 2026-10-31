<?php
require_once __DIR__ . '/node_db.php';
$pdo = new PDO("mysql:host=localhost;dbname=antu", "root", "");
echo "=== CUSTOMERS ===\n";
print_r($pdo->query("DESCRIBE customers")->fetchAll(PDO::FETCH_COLUMN));
echo "=== MEDICINES ===\n";
print_r($pdo->query("DESCRIBE medicines")->fetchAll(PDO::FETCH_COLUMN));
echo "=== PURCHASES ===\n";
print_r($pdo->query("DESCRIBE purchases")->fetchAll(PDO::FETCH_COLUMN));
