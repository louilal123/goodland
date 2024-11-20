<?php
include('connection.php');

// SQL query to fetch the latest data from the sensor_data table
$sql = "SELECT kit_name, level_cm, timestamp FROM sensor_data ORDER BY timestamp DESC";
$result = $conn->query($sql);

$data = []; // Initialize an array to store the data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'kit_name' => $row['kit_name'],
            'level_cm' => (float)$row['level_cm'], // Ensure level_cm is a float
            'timestamp' => $row['timestamp']
        ];
    }
    echo json_encode($data); // Send data as JSON
} else {
    echo json_encode([]); // No data found
}

$conn->close(); // Close the connection
?>
