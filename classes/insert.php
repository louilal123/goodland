<?php
// Database connection
include 'connection.php';

// Function to insert random data
function insertRandomData($conn)
{
    $tankNames = ['esawod_1', 'esawod_2'];
    foreach ($tankNames as $tankName) {
        // Generate random data for level, humidity, and temperature
        $level = mt_rand(0, 36); // Random level in cm (0 to 36) as integer
        $humidity = mt_rand(200, 400) / 10; // Random humidity (20% to 40%) as float
        $temperature = mt_rand(200, 400) / 10; // Random temperature (20°C to 40°C) as float
        $timestamp = date('Y-m-d H:i:s'); // Current timestamp

        // Prepare SQL query
        $sql = "INSERT INTO sensor_data (kit_name, level_cm, humidity, temperature, timestamp) 
                VALUES (?, ?, ?, ?, ?)";

        // Use prepared statement
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sddds", $tankName, $level, $humidity, $temperature, $timestamp);
            if ($stmt->execute()) {
                echo "Random data inserted for $tankName.<br>";
            } else {
                echo "Failed to insert data for $tankName: " . $stmt->error . "<br>";
            }
            $stmt->close();
        } else {
            echo "Failed to prepare statement: " . $conn->error . "<br>";
        }
    }
}

// Run the data insertion in a loop every 5 seconds
while (true) {
    insertRandomData($conn);
    sleep(5); // Sleep for 5 seconds
}

?>
