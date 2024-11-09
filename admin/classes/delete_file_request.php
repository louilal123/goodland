<?php
session_start();

// Check if request ID is provided in the URL
if (isset($_GET['id'])) {
    $request_id = intval($_GET['id']);  // Get the request ID from the URL

    // Include the Main_class for database interaction
    require_once "Main_class.php"; 
    $conn = new Main_class();

    // Call the delete method for deleting the file request
    if ($conn->deleteFileRequest($request_id)) {
        $_SESSION['status'] = "File request successfully deleted!";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting file request.";
        $_SESSION['status_icon'] = "error";
    }
} else {
    $_SESSION['status'] = "Invalid request.";
    $_SESSION['status_icon'] = "error";
}

// Redirect back to the manage file requests page
header('Location: ../file_requests.php'); 
exit();
?>
