<?php
include('connection.php');

// SQL query to fetch the latest humidity data from the sensor_data table
$sql = "SELECT kit_name, humidity, timestamp FROM sensor_data ORDER BY timestamp DESC";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'kit_name' => $row['kit_name'],
            'humidity' => (float)$row['humidity'],
            'timestamp' => $row['timestamp']
        ];
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}

$conn->close();
?>
