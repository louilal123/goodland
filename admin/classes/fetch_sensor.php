<?php
require_once('Main_class.php');  // Include your Main_class for database connection

$mainClass = new Main_class();  // Instantiate your class for database interaction

// Call the method to fetch sensor data for Kit A and Kit B
$data = $mainClass->getSensorData();  // Assuming this method fetches the data

// Return the fetched data as JSON
echo json_encode($data);
?>
