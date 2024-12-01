<?php
include '../classes/connection.php'; // Adjust the path as needed

// Fetch the date range from POST parameters
$dateFrom = isset($_POST['date_from']) ? $_POST['date_from'] : null;
$dateTo = isset($_POST['date_to']) ? $_POST['date_to'] : null;

// Validate if both date parameters are provided
if (!$dateFrom || !$dateTo) {
    echo json_encode(['error' => 'Date range is required']);
    exit;
}

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
