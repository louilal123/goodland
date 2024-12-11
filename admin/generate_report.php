<?php
include '../classes/connection.php'; // Adjust the path as needed

// Fetch the selected month from POST parameters
$monthOf = isset($_POST['month_of']) ? $_POST['month_of'] : null;

// Validate if the month is provided
if (!$monthOf) {
    echo json_encode(['error' => 'Month is required']);
    exit;
}

// Calculate the first and last day of the selected month
$first_day_of_month = $monthOf . '-01'; // First day of the month
$last_day_of_month = date('Y-m-t', strtotime($first_day_of_month)); // Last day of the month

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
$stmt->bind_param("ss", $first_day_of_month, $last_day_of_month);
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
