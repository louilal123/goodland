<?php
include('connection.php');

// SQL query to fetch water level, humidity, and temperature for esawod_1
$sql = "SELECT kit_name, level_cm, humidity, temperature, timestamp FROM sensor_data WHERE kit_name = 'esawod_1' ORDER BY timestamp DESC";
$result = $conn->query($sql);

$data = []; // Initialize an array to store the data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'kit_name' => $row['kit_name'],
            'level_cm' => (float)$row['level_cm'], // Water level (cm)
            'humidity' => (float)$row['humidity'], // Humidity
            'temperature' => (float)$row['temperature'], // Temperature
            'timestamp' => $row['timestamp']
        ];
    }
    echo json_encode($data); // Send data as JSON
} else {
    echo json_encode([]); // No data found
}

$conn->close(); // Close the connection
?>
