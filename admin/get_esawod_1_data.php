<?php
// Connect to the database
include '../classes/connection.php';

// Get the selected month and year from the POST request
$monthOf = isset($_POST['month_of']) ? $_POST['month_of'] : date('Y-m');

// SQL query to fetch average water level, temperature, and humidity for the selected month
$query = "
    SELECT 
        DATE_FORMAT(timestamp, '%Y-%m-%d') as day,
        AVG(level_cm) as avg_level,
        AVG(temperature) as avg_temp,
        AVG(humidity) as avg_humidity
    FROM 
        sensor_data
    WHERE 
        kit_name = 'esawod_1' AND DATE_FORMAT(timestamp, '%Y-%m') = ?
    GROUP BY 
        DATE_FORMAT(timestamp, '%Y-%m-%d')
    ORDER BY 
        day ASC
";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $monthOf); // Bind the month parameter
$stmt->execute();
$result = $stmt->get_result();

// Initialize arrays to hold the results
$days = [];
$level_data = [];
$temperature_data = [];
$humidity_data = [];

// Fetch the results
while ($row = $result->fetch_assoc()) {
    $days[] = $row['day'];
    $level_data[] = (float)$row['avg_level'];  // Use average level for water level data
    $temperature_data[] = (float)$row['avg_temp'];
    $humidity_data[] = (float)$row['avg_humidity'];
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the data as JSON
echo json_encode([
    'days' => $days,
    'level_data' => $level_data,
    'temperature_data' => $temperature_data,
    'humidity_data' => $humidity_data
]);
?>
