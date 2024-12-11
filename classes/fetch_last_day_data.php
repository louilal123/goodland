<?php 
include 'connection.php';

function fetch_last_day($kit_name, $conn) {
    $currentTime = date('Y-m-d H:i:s');
    $lastDayTime = date('Y-m-d H:i:s', strtotime('-1 day'));

    // SQL query to fetch data for the last 24 hours
    $sql = "
        SELECT 
            AVG(`level_cm`) as avg_level,
            AVG(`humidity`) as avg_humidity,
            AVG(`temperature`) as avg_temperature
        FROM 
            `sensor_data`
        WHERE 
            `kit_name` = '$kit_name'
            AND `timestamp` BETWEEN '$lastDayTime' AND '$currentTime'
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

// Fetch last day data for both kits
$kit1_data = fetch_last_day('esawod_1', $conn);
$kit2_data = fetch_last_day('esawod_2', $conn);

// Return data as JSON
echo json_encode([
    'kit1' => $kit1_data,
    'kit2' => $kit2_data,
]);
?>
