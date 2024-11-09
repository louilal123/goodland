<?php
session_start();

// Check if file ID is provided in the URL
if (isset($_GET['id'])) {
    $file_id = intval($_GET['id']);  // Get the file ID from the URL
    
    // Include the Main_class for database interaction
    require_once "Main_class.php"; 
    $conn = new Main_class();

    // Call the delete method for deleting the file
    if ($conn->deleteFile($file_id)) {
        $_SESSION['status'] = "File successfully deleted!";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting file.";
        $_SESSION['status_icon'] = "error";
    }
} else {
    $_SESSION['status'] = "Invalid request.";
    $_SESSION['status_icon'] = "error";
}

// Redirect back to the manage files page
header('Location: ../all_files.php'); 
exit();
?>
