<?php
session_start();

// Include the Main_class for database interaction
require_once "Main_class.php"; 
$conn = new Main_class();

// Handle deletion of all file requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Call the delete method for deleting all file requests
    if ($conn->deleteAllFileRequests()) {
        $_SESSION['status'] = "All file requests have been successfully deleted!";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting all file requests.";
        $_SESSION['status_icon'] = "error";
    }
}

// Redirect back to the manage file requests page
header('Location: ../file_requests.php'); 
exit();
?>
