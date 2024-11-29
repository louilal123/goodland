<?php
include '../classes/connection.php'; // Adjust the path as needed

// Initialize variables
$dateFrom = $_POST['date_from'] ?? null;
$dateTo = $_POST['date_to'] ?? null;

if (isset($_POST['filter']) && $dateFrom && $dateTo) {
    $stmt = $conn->prepare("SELECT `timestamp`, `kit_name`, `level_cm`, `humidity`, `temperature` 
                            FROM `sensor_data` 
                            WHERE DATE(`timestamp`) BETWEEN ? AND ?
                            ORDER BY `timestamp` DESC");
    $stmt->bind_param("ss", $dateFrom, $dateTo);
} else {
    $stmt = $conn->prepare("SELECT `timestamp`, `kit_name`, `level_cm`, `humidity`, `temperature` 
                            FROM `sensor_data` 
                            ORDER BY `timestamp` DESC");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add +8 hours to timestamp
        $timestamp = date("M d, Y h:i:s A", strtotime($row['timestamp'] . ' +8 hours'));
        echo "
        <tr>
            <td>{$timestamp}</td>
            <td>" . htmlspecialchars($row['kit_name']) . "</td>
            <td>" . htmlspecialchars($row['level_cm']) . " cm</td>
            <td>" . htmlspecialchars($row['humidity']) . "%</td>
            <td>" . htmlspecialchars($row['temperature']) . "°C</td>
        </tr>";
    }
} else {
    echo '
    <tr>
        <td colspan="5">No data available for the selected date range.</td>
    </tr>';
}
?>
