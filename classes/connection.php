<?php
// Database connection settings
$servername = "157.230.193.209";  // Your MySQL host (same as in Node.js)
$username = "root";               // MySQL username (same as in Node.js)
$password = "1goodland_v2";       // MySQL password (same as in Node.js)
$dbname = "u510162695_goodland_db"; // MySQL database name (same as in Node.js)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- here is the correct credentials: // db.js
const mysql = require('mysql2');

// MySQL connection setup
const db = mysql.createConnection({
    host: '157.230.193.209',
    user: 'root', // Replace with your MySQL username
    password: '1goodland_v2', // Replace with your MySQL password
    database: 'u510162695_goodland_db' -->