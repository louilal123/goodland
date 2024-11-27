<?php 
// Include the database connection
include '../classes/connection.php';

// Get the current year and month (or specify a month if needed)
$currentMonth = date('m'); // For the current month
$currentYear = date('Y'); // For the current year

$monthName = date('F', strtotime("$currentYear-$currentMonth-01"));

// Function to fetch data for a given kit_name
function fetch_data_for_kit($kit_name, $currentMonth, $currentYear, $conn) {
    $sql = "
        SELECT 
            DAY(`timestamp`) as day, 
            AVG(`level_cm`) as avg_level_cm, 
            AVG(`humidity`) as avg_humidity, 
            AVG(`temperature`) as avg_temperature
        FROM 
            `sensor_data`
        WHERE 
            MONTH(`timestamp`) = '$currentMonth' 
            AND YEAR(`timestamp`) = '$currentYear'
            AND kit_name = '$kit_name'
        GROUP BY 
            DAY(`timestamp`)
        ORDER BY 
            `day` ASC
    ";
    
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Fetch data for esawod_1
$data_1 = fetch_data_for_kit('esawod_1', $currentMonth, $currentYear, $conn);

// Fetch data for esawod_2
$data_2 = fetch_data_for_kit('esawod_2', $currentMonth, $currentYear, $conn);

// Prepare data for Highcharts (initialize with zeros for all 31 days)
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

function prepare_chart_data($data, $daysInMonth, $currentMonth, $currentYear) {
    $level_data = array_fill(0, $daysInMonth, 0);
    $humidity_data = array_fill(0, $daysInMonth, 0);
    $temperature_data = array_fill(0, $daysInMonth, 0);
    $timestamps = [];

    foreach ($data as $entry) {
        $day = (int)$entry['day'] - 1; // Day is 1-31, array is 0-based
        $level_data[$day] = (float)$entry['avg_level_cm'];
        $humidity_data[$day] = (float)$entry['avg_humidity'];
        $temperature_data[$day] = (float)$entry['avg_temperature'];
        
        // Adjust the timestamp to account for the time zone difference (subtract 8 hours)
        $timestamp = strtotime("$currentYear-$currentMonth-" . $entry['day']);
        $adjusted_timestamp = $timestamp - (8 * 60 * 60); // Subtract 8 hours (28800 seconds)
        $timestamps[] = $adjusted_timestamp * 1000; // Convert to milliseconds
    }

    // Ensure every day is accounted for in timestamps (1 to 31 days)
    for ($i = 1; $i <= $daysInMonth; $i++) {
        if (!in_array(strtotime("$currentYear-$currentMonth-$i") * 1000, $timestamps)) {
            $adjusted_timestamp = strtotime("$currentYear-$currentMonth-$i") - (8 * 60 * 60); // Adjust for time zone
            $timestamps[] = $adjusted_timestamp * 1000; // Convert to milliseconds
        }
    }

    return [
        'level_data' => $level_data,
        'humidity_data' => $humidity_data,
        'temperature_data' => $temperature_data
    ];
}

// Prepare chart data for both kits
$chart_data_1 = prepare_chart_data($data_1, $daysInMonth, $currentMonth, $currentYear);
$chart_data_2 = prepare_chart_data($data_2, $daysInMonth, $currentMonth, $currentYear, $currentYear);

?>