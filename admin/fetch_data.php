<?php

include '../classes/connection.php';

$currentMonth = date('m');
$currentYear = date('Y');

$monthName = date('F', strtotime("$currentYear-$currentMonth-01"));

function fetch_data($kit_name, $timeframe, $conn) {
    $sql = "";

    if ($timeframe == 'last24hours') {
        $sql = "
            SELECT 
                HOUR(`timestamp`) AS time_group, 
                AVG(`level_cm`) AS avg_level_cm, 
                AVG(`humidity`) AS avg_humidity, 
                AVG(`temperature`) AS avg_temperature
            FROM 
                `sensor_data`
            WHERE 
                `timestamp` >= NOW() - INTERVAL 1 DAY 
                AND kit_name = '$kit_name'
            GROUP BY 
                HOUR(`timestamp`)
            ORDER BY 
                `time_group` ASC
        ";
        $default_groups = range(0, 23);
    } elseif ($timeframe == 'last7days') {
        $sql = "
            SELECT 
                DATE(`timestamp`) AS time_group, 
                AVG(`level_cm`) AS avg_level_cm, 
                AVG(`humidity`) AS avg_humidity, 
                AVG(`temperature`) AS avg_temperature
            FROM 
                `sensor_data`
            WHERE 
                `timestamp` >= NOW() - INTERVAL 7 DAY 
                AND kit_name = '$kit_name'
            GROUP BY 
                DATE(`timestamp`)
            ORDER BY 
                `time_group` ASC
        ";
        $default_groups = [];
        for ($i = 6; $i >= 0; $i--) {
            $default_groups[] = date('Y-m-d', strtotime("-$i days"));
        }
    } elseif ($timeframe == 'lastmonth') {
        $sql = "
            SELECT 
                DATE(`timestamp`) AS time_group, 
                AVG(`level_cm`) AS avg_level_cm, 
                AVG(`humidity`) AS avg_humidity, 
                AVG(`temperature`) AS avg_temperature
            FROM 
                `sensor_data`
            WHERE 
                `timestamp` >= NOW() - INTERVAL 30 DAY 
                AND kit_name = '$kit_name'
            GROUP BY 
                DATE(`timestamp`)
            ORDER BY 
                `time_group` ASC
        ";
        $default_groups = [];
        for ($i = 29; $i >= 0; $i--) {
            $default_groups[] = date('Y-m-d', strtotime("-$i days"));
        }
    }

    $result = $conn->query($sql);
    $data = [];
    $filled_data = array_fill_keys($default_groups, [
        'avg_level_cm' => 0,
        'avg_humidity' => 0.00,
        'avg_temperature' => 0.00
    ]);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $group = $row['time_group'];
            $filled_data[$group] = [
                'avg_level_cm' => $row['avg_level_cm'] ?? 0,
                'avg_humidity' => $row['avg_humidity'] ?? 0.00,
                'avg_temperature' => $row['avg_temperature'] ?? 0.00
            ];
        }
    }

    foreach ($filled_data as $group => $values) {
        $data[] = array_merge(['time_group' => $group], $values);
    }

    return $data;
}

$timeframe = $_GET['timeframe'] ?? 'last7days';
$data_1 = fetch_data('esawod_1', $timeframe, $conn);
$data_2 = fetch_data('esawod_2', $timeframe, $conn);

if (isset($_GET['ajax'])) {
    echo json_encode(['kit1' => $data_1, 'kit2' => $data_2]);
    exit;
}

?>
