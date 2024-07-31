<?php
session_start();

if (isset($_POST['id'])) {
    $user_id = intval($_POST['id']); 
    require_once "Main_class.php"; 
    $conn = new Main_class();
    $conn->delete_user($user_id); // Use $user_id here
    $_SESSION['status'] = "User deleted successfully."; 
    $_SESSION['status_icon'] = "success";
} else {
    $_SESSION['status'] = "Invalid request."; 
    $_SESSION['status_icon'] = "error";
}

header('Location: ../manageusers.php'); 
exit();

?>
