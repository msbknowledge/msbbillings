<?php
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
$is_local = ($server_name === 'localhost' || $server_name === '127.0.0.1' || substr($server_name, -10) === '.localhost' || substr($server_name, -6) === '.local');
$servername = "localhost";
$username = $is_local ? "root" : "u404684354_node";
$password = $is_local ? "" : "BR66MK55@msb";
$dbname = $is_local ? "node" : "u404684354_node";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql_node_data="SELECT node_name FROM nodes";
$result = mysqli_query($conn, $sql_node_data);
if (mysqli_num_rows($result) > 0) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
print_r($data);
//die();
?>
