<?php 
include 'connection.php';

function fetch_all_time($kit_name, $conn) {
    // SQL query to fetch the average data for all time
    $sql = "
        SELECT 
            AVG(`level_cm`) as avg_level,
            AVG(`humidity`) as avg_humidity,
            AVG(`temperature`) as avg_temperature
        FROM 
            `sensor_data`
        WHERE 
            `kit_name` = '$kit_name'
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

// Fetch all-time data for both kits
$kit1_data = fetch_all_time('esawod_1', $conn);
$kit2_data = fetch_all_time('esawod_2', $conn);

// Return data as JSON
echo json_encode([
    'kit1' => $kit1_data,
    'kit2' => $kit2_data,
]);
?>
