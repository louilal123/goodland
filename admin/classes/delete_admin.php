<?php
session_start();

if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']); 
    require_once "Main_class.php"; 
    $conn = new Main_class();
    $conn->deleteAdmin($admin_id); 
} else {
    $_SESSION['status'] = "Invalid request."; 
    $_SESSION['status_icon'] = "error";
}

header('Location: ../manageadmins.php'); 
exit();
?>
