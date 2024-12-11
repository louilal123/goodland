<?php

include('connection.php');

// SQL query to fetch the latest data for esawod_2
$sql = "SELECT humidity, temperature FROM sensor_data WHERE kit_name = 'esawod_2' ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Return the latest temperature and humidity
    echo json_encode([
        'temperature' => $row['temperature'],
        'humidity' => $row['humidity']
    ]);
} else {
    echo json_encode(['error' => 'No data found']);
}

// Close the connection
$conn->close();
?>
