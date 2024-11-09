<?php
session_start();
require_once 'Main_class.php'; // Include your main class file

// Check if project ID is passed
if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
    $projectId = $_GET['project_id'];

    try {
        // Create an instance of Main_class to access the database
        $mainClass = new Main_class();

        // Call the delete method from Main_class (Deletes project and associated sections)
        $mainClass->deleteProject($projectId);

        // Set success message in session and redirect
        $_SESSION['status'] = 'Project and associated sections deleted successfully.';
        $_SESSION['status_icon'] = 'success';
        header('Location: ../archives.php'); // Redirect back to the project list page
        exit();

    } catch (Exception $e) {
        // Set error message in session and redirect
        $_SESSION['status'] = 'Failed to delete project: ' . $e->getMessage();
        $_SESSION['status_icon'] = 'error';
        header('Location: ../archives.php');
        exit();
    }
} else {
    // Handle case when no project_id is passed
    $_SESSION['status'] = 'No project selected for deletion.';
    $_SESSION['status_icon'] = 'error';
    header('Location: ../archives.php');
    exit();
}
?>
