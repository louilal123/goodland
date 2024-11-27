<?php
include "connection.php";

// Query to fetch the most recent temperature for e-sawod1
$sql = "SELECT temperature FROM sensor_data WHERE kit_name = 'esawod_1' ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

// Prepare the response data
$data = [];

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['value'] = (float)$row['temperature'];  // Return temperature value as float
} else {
    $data['value'] = 0;  // Default if no data is found
}

// Send the data as JSON response
echo json_encode($data);

// Close the connection
$conn->close();
?>
