<?php
// Include the database connection file
require_once 'connection.php';

// Path to the SQL file in the same classes folder
$sqlFilePath = __DIR__ . '/sensor_data.sql';

// Check if the SQL file exists
if (!file_exists($sqlFilePath)) {
    die("SQL file not found at $sqlFilePath");
}

// Read the content of the SQL file
$sqlContent = file_get_contents($sqlFilePath);

// Check if the SQL file was read successfully
if (!$sqlContent) {
    die("Failed to read SQL file.");
}

// Clear the existing data in the sensor_data table
$truncateQuery = "TRUNCATE TABLE sensor_data";
if ($conn->query($truncateQuery)) {
    echo "Table cleared successfully!<br>";
} else {
    die("Error clearing table: " . $conn->error);
}

// Execute the SQL content to import new data
if ($conn->multi_query($sqlContent)) {
    echo "Data imported successfully!";

    // Flush results to process multiple queries
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
} else {
    echo "Error importing data: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
