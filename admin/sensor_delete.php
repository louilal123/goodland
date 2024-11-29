<?php
session_start(); // Start session to store messages
include '../classes/connection.php'; // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // Delete all records from the sensor_data table
        $stmt = $conn->prepare("DELETE FROM `sensor_data`");
        if ($stmt->execute()) {
            // Set session variables for success
            $_SESSION['status'] = 'All sensor data has been deleted successfully.';
            $_SESSION['status_icon'] = 'success';
        } else {
            // Set session variables for error
            $_SESSION['status'] = 'Unable to delete the sensor data. Please try again.';
            $_SESSION['status_icon'] = 'error';
        }
    } catch (Exception $e) {
        // Handle unexpected errors
        $_SESSION['status'] = 'An unexpected error occurred. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    // Redirect back to the main page
    header('Location: sensor_data.php');
    exit();
}
?>
