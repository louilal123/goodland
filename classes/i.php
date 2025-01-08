<?php
// Include the database connection file
require_once 'connection.php';

// Path to the SQL file in the same classes folder
$sqlFilePath = 'sensor_data.sql'; // Relative path

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

// Split SQL content into individual queries
$sqlQueries = explode(";", $sqlContent);

// Execute each query
foreach ($sqlQueries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if ($conn->query($query)) {
            echo "Query executed successfully: " . htmlspecialchars($query) . "<br>";
        } else {
            echo "Error executing query: " . htmlspecialchars($query) . " - " . $conn->error . "<br>";
        }
    }
}

// Close the database connection
$conn->close();
?>
