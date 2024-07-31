<?php

session_start();

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']); 
    require_once "Main_class.php"; 
    $conn = new Main_class();
    $conn->delete_user($user_id);
    $_SESSION['status'] = "User deleted successfully."; 
    $_SESSION['status_icon'] = "success";
} else {
    $_SESSION['status'] = "Invalid request."; 
    $_SESSION['status_icon'] = "error";
}

header('Location: ../manageusers.php'); 
exit();

?>
