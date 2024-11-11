<?php
// Database connection settings

header('Content-Type: application/json');
// $servername = "157.230.193.209"; 
// $username = "root";               
// $password = "1goodland_v2";      
// $dbname = "u510162695_goodland_db"; 

// define('DB_HOST', 'mysql-db');
// define('DB_USERNAME', 'u510162695_goodland_db');
// define('DB_PASSWORD', '1Goodland_db');
// define('DB_NAME', 'u510162695_goodland_db');
// define('DB_CHARSET', 'utf8mb4'); 

$servername = ""; 
$username = "root";               
$password = "1goodland_v2";      
$dbname = "u510162695_goodland_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>