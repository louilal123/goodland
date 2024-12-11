<?php

include('connection.php');

// SQL query to fetch the latest data from sensor_data table
$sql = "SELECT kit_name, humidity, temperature, timestamp FROM sensor_data ORDER BY timestamp DESC LIMIT 2  ";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data); // Send data as JSON
} else {
    echo json_encode([]); // No data found
}

// Close the connection
$conn->close();
?>
