<?php 
include 'connection.php';

function fetch_last_minute($kit_name, $conn) {
    $currentTime = date('Y-m-d H:i:s');
    $lastMinuteTime = date('Y-m-d H:i:s', strtotime('-1 minute'));

    $sql = "
        SELECT 
            `level_cm`, 
            `humidity`, 
            `temperature`
        FROM 
            `sensor_data`
        WHERE 
            `kit_name` = '$kit_name'
            AND `timestamp` BETWEEN '$lastMinuteTime' AND '$currentTime'
        ORDER BY 
            `timestamp` DESC
        LIMIT 1
    ";

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    if ($data) {
        return [
            'level_data' => [(float)$data['level_cm']],
            'humidity_data' => [(float)$data['humidity']],
            'temperature_data' => [(float)$data['temperature']],
        ];
    }

    // Return empty data if no readings exist
    return [
        'level_data' => [0],
        'humidity_data' => [0],
        'temperature_data' => [0],
    ];
}

$kit1_data = fetch_last_minute('esawod_1', $conn);
$kit2_data = fetch_last_minute('esawod_2', $conn);

echo json_encode([
    'kit1' => $kit1_data,
    'kit2' => $kit2_data,
]);
?>
