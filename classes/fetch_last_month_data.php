<?php 
include 'connection.php';

function fetch_last_month($kit_name, $conn) {
    // Get the current time and the time for 30 days ago
    $currentTime = date('Y-m-d H:i:s');
    $lastMonthTime = date('Y-m-d H:i:s', strtotime('-1 month'));

    // SQL query to fetch the average data for the last 30 days
    $sql = "
        SELECT 
            AVG(`level_cm`) as avg_level,
            AVG(`humidity`) as avg_humidity,
            AVG(`temperature`) as avg_temperature
        FROM 
            `sensor_data`
        WHERE 
            `kit_name` = '$kit_name'
            AND `timestamp` BETWEEN '$lastMonthTime' AND '$currentTime'
    ";

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    if ($data) {
        return [
            'level_data' => [(float)$data['avg_level']],
            'humidity_data' => [(float)$data['avg_humidity']],
            'temperature_data' => [(float)$data['avg_temperature']],
        ];
    }

    // Return empty data if no readings exist
    return [
        'level_data' => [0],
        'humidity_data' => [0],
        'temperature_data' => [0],
    ];
}

// Fetch last month data for both kits
$kit1_data = fetch_last_month('esawod_1', $conn);
$kit2_data = fetch_last_month('esawod_2', $conn);

// Return data as JSON
echo json_encode([
    'kit1' => $kit1_data,
    'kit2' => $kit2_data,
]);
?>
