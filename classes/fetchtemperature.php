<?php
include('connection.php');

// SQL query to fetch the latest temperature data for both tanks
$sql = "SELECT kit_name, temperature, timestamp FROM sensor_data ORDER BY timestamp DESC";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'kit_name' => $row['kit_name'],
            'temperature' => (float)$row['temperature'], // Ensure temperature is a float
            'timestamp' => $row['timestamp']
        ];
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}

$conn->close();
?>
