<?php
include "connection.php";

// Query to fetch the most recent data for e-sawod2
$sql = "SELECT kit_name, level_cm, humidity, temperature, timestamp FROM sensor_data WHERE kit_name = 'esawod_2' ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

// Prepare the response data
$data = [];

if ($result->num_rows > 0) {
    $data['esawod_2'] = $result->fetch_assoc();
} else {
    $data['esawod_2'] = null;  // No data for e-sawod2
}

// Send the data as JSON response
echo json_encode($data);

// Close the connection
$conn->close();
?>
