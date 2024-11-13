<?php
session_start();
require_once 'Main_class.php'; // Include your main class file

// Function to delete all records
try {
    // Create an instance of Main_class to access the database
    $mainClass = new Main_class();

    // Delete all file requests first to avoid foreign key constraint violations
    $mainClass->deleteAllFileRequests();

    // Delete all sessions
    $mainClass->deleteAllSessions();

    // Delete all visitors
    $mainClass->deleteAllVisitors();

    // Set success message in session and redirect
    $_SESSION['status'] = 'All records deleted successfully.';
    $_SESSION['status_icon'] = 'success';
    header('Location: ../projects.php'); // Redirect back to the page
    exit();

} catch (Exception $e) {
    // Set error message in session and redirect
    $_SESSION['status'] = 'Failed to delete all records: ' . $e->getMessage();
    $_SESSION['status_icon'] = 'error';
    header('Location: ../projects.php');
    exit();
}
?>
