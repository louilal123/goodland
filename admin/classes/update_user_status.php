<?php
session_start();
require_once 'Main_class.php';

$mainClass = new Main_class();

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $result = $mainClass->updateUserStatus($user_id, $status);
    if ($result) {
        $_SESSION['status'] = "User status updated successfully";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error updating user status";
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../manageusers.php'); // Redirect to the user list page or wherever needed
    exit();
} else {
    $_SESSION['status'] = "Missing user ID";
    $_SESSION['status_icon'] = "error";
    header('Location: ../manageusers.php'); // Redirect to the user list page or wherever needed
    exit();
}
?>
