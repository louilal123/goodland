<?php

include '../classes/connection.php'; // Adjust the path as needed

// Assuming the date range and database connection are properly set
$dateFrom = $_POST['date_from'];
$dateTo = $_POST['date_to'];

// Query to fetch data for both kits (esawod_1 and esawod_2)
$query = "
    SELECT 
        kit_name, 
        MAX(level_cm) AS highest_wl, 
        MIN(level_cm) AS lowest_wl, 
        MAX(temperature) AS highest_temp, 
        MIN(temperature) AS lowest_temp, 
        MAX(humidity) AS highest_humidity, 
        MIN(humidity) AS lowest_humidity 
    FROM sensor_data 
    WHERE DATE(timestamp) BETWEEN ? AND ? 
    GROUP BY kit_name
";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $dateFrom, $dateTo);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all the data
$summaryData = [];
while ($row = $result->fetch_assoc()) {
    $summaryData[] = $row;
}

// Output the data as JSON
echo json_encode($summaryData);
?>
