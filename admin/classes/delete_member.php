<?php
session_start();

if (isset($_GET['id'])) {
    $member_id = intval($_GET['id']); 
    require_once "Main_class.php"; 
    $conn = new Main_class();
    $conn->delete_member($member_id); 
} else {
    $_SESSION['status'] = "Invalid request."; 
    $_SESSION['status_icon'] = "error";
}

header('Location: ../managemember.php'); 
exit();
?>
