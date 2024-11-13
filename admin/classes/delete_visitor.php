<?php
session_start();
require_once 'Main_class.php'; // Include your main class file

// Check if visitor ID is passed
if (isset($_GET['visitor_id']) && !empty($_GET['visitor_id'])) {
    $visitorId = $_GET['visitor_id'];

    try {
        // Create an instance of Main_class to access the database
        $mainClass = new Main_class();

        // Call the delete method from Main_class (Deletes visitor and associated sessions)
        $mainClass->deleteVisitor($visitorId);

        // Set success message in session and redirect
        $_SESSION['status'] = 'Visitor record and associated sessions deleted successfully.';
        $_SESSION['status_icon'] = 'success';
        header('Location: ../website_visitors.php'); // Redirect back to the visitor list page
        exit();

    } catch (Exception $e) {
        // Set error message in session and redirect
        $_SESSION['status'] = 'Failed to delete visitor: ' . $e->getMessage();
        $_SESSION['status_icon'] = 'error';
        header('Location: ../website_visitors.php');
        exit();
    }
} else {
    // Handle case when no visitor_id is passed
    $_SESSION['status'] = 'No visitor selected for deletion.';
    $_SESSION['status_icon'] = 'error';
    header('Location: ../website_visitors.php');
    exit();
}
?>
