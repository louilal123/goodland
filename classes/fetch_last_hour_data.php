<?php 
include 'connection.php';

function fetch_last_hour($kit_name, $conn) {
    $currentTime = date('Y-m-d H:i:s');
    $lastHourTime = date('Y-m-d H:i:s', strtotime('-1 hour'));

    $sql = "
        SELECT 
            AVG(`level_cm`) AS avg_level, 
            AVG(`humidity`) AS avg_humidity, 
            AVG(`temperature`) AS avg_temperature
        FROM 
            `sensor_data`
        WHERE 
            `kit_name` = '$kit_name'
            AND `timestamp` BETWEEN '$lastHourTime' AND '$currentTime'
    ";

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    if ($data) {
        return [
            'level_data' => [round((float)$data['avg_level'], 2)],
            'humidity_data' => [round((float)$data['avg_humidity'], 2)],
            'temperature_data' => [round((float)$data['avg_temperature'], 2)],
        ];
    }

    return [
        'level_data' => [0],
        'humidity_data' => [0],
        'temperature_data' => [0],
    ];
}

// Fetch last hour data for both kits
$kit1_data = fetch_last_hour('esawod_1', $conn);
$kit2_data = fetch_last_hour('esawod_2', $conn);

// Return data as JSON
echo json_encode([
    'kit1' => $kit1_data,
    'kit2' => $kit2_data,
]);
?>
