<?php
include('connection.php');  // Adjust the path if necessary

// SQL query to fetch data for esawod_1 (water level, humidity, and temperature)
$sql = "SELECT kit_name, level_cm, humidity, temperature, timestamp FROM sensor_data WHERE kit_name = 'esawod_1' ORDER BY timestamp DESC";
$result = $conn->query($sql);

$data1 = []; // Initialize an array to store the data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data1[] = [
            'kit_name' => $row['kit_name'],
            'level_cm' => (float)$row['level_cm'],  // Ensure level_cm is a float
            'humidity' => (float)$row['humidity'],  // Ensure humidity is a float
            'temperature' => (float)$row['temperature'],  // Ensure temperature is a float
            'timestamp' => $row['timestamp']  // Add timestamp to data
        ];
    }
    echo json_encode($data1); // Send data as JSON
} else {
    echo json_encode([]); // No data found
}

$conn->close(); // Close the connection
?>
