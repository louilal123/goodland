<?php
require_once __DIR__ . '/../admin/classes/Main_class.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userId = $_SESSION['user_id']; 

    if ($newPassword !== $confirmPassword) {
        $_SESSION['status'] = "New passwords do not match.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../profile.php"); 
        exit;
    }

    $mainClass = new Main_class();
    $result = $mainClass->changePassword($userId, $currentPassword, $newPassword);

    if ($result) {
        $_SESSION['status'] = "Password changed successfully.";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Current password is incorrect.";
        $_SESSION['status_icon'] = "error";
    }

    header("Location: ../profile.php"); 
    exit;
}
?>
