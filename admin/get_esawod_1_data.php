<?php

include '../classes/connection.php'; // Adjust the path as needed

// Check if date range is provided
if (isset($_POST['date_from']) && isset($_POST['date_to'])) {
    $dateFrom = $_POST['date_from'];
    $dateTo = $_POST['date_to'];

    try {
        // Fetch chart data for esawod_1
        $query = "
            SELECT 
                DAY(timestamp) AS day,
                AVG(level_cm) AS avg_wl,
                AVG(temperature) AS avg_temp,
                AVG(humidity) AS avg_humidity
            FROM sensor_data
            WHERE kit_name = 'esawod_1' AND DATE(timestamp) BETWEEN ? AND ?
            GROUP BY DAY(timestamp)
            ORDER BY day
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $dateFrom, $dateTo);
        $stmt->execute();
        $result = $stmt->get_result();

        $level_data = [];
        $temperature_data = [];
        $humidity_data = [];
        $days = [];

        while ($row = $result->fetch_assoc()) {
            $days[] = $row['day'];
            $level_data[] = $row['avg_wl'];
            $temperature_data[] = $row['avg_temp'];
            $humidity_data[] = $row['avg_humidity'];
        }

        // Return chart data as JSON
        echo json_encode([
            'days' => $days,
            'level_data' => $level_data,
            'temperature_data' => $temperature_data,
            'humidity_data' => $humidity_data
        ]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Date range not provided.']);
}
?>
