<?php
session_start();
require_once 'Main_class.php';

$mainClass = new Main_class();

if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    $id = $_SESSION['admin_id']; // Ensure admin ID is stored in session
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['status'] = "New passwords do not match";
        $_SESSION['status_icon'] = "error";
        header('Location: ../profile.php'); // Redirect to the profile page or wherever needed
        exit();
    }

    // Verify current password
    $currentPasswordHash = $mainClass->getAdminPassword($id);
    if ($currentPasswordHash && password_verify($currentPassword, $currentPasswordHash)) {
        $result = $mainClass->updateAdminPassword($id, $newPassword);
        if ($result) {
            $_SESSION['status'] = "Password updated successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error updating password";
            $_SESSION['status_icon'] = "error";
        }
    } else {
        $_SESSION['status'] = "Current password is incorrect";
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../profile.php'); // Redirect to the profile page or wherever needed
    exit();
} else {
    $_SESSION['status'] = "Missing required fields";
    $_SESSION['status_icon'] = "error";
    header('Location: ../profile.php'); // Redirect to the profile page or wherever needed
    exit();
}
?>
