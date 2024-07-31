<?php
session_start();
require_once 'Main_class.php';

$mainClass = new Main_class();

if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['email'])) {
    $id = $_SESSION['admin_id']; // Ensure admin ID is stored in session
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Check if the username or email already exists, excluding the current admin
    $currentAdmin = $mainClass->getAdminDetails($id); // Method to get current admin details by ID

    if ($username !== $currentAdmin['username'] && $mainClass->usernameExists($username)) {
        $_SESSION['status'] = "Username already taken";
        $_SESSION['status_icon'] = "error";
        header('Location: ../profile.php');
        exit();
    }

    if ($email !== $currentAdmin['email'] && $mainClass->emailExists($email)) {
        $_SESSION['status'] = "Email already taken";
        $_SESSION['status_icon'] = "error";
        header('Location: ../profile.php');
        exit();
    }

    // Update admin info
    $result = $mainClass->updateAdminInfo($id, $fullname, $username, $email);
    if ($result) {
        $_SESSION['status'] = "Profile updated successfully";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error updating profile";
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../profile.php');
    exit();
} else {
    $_SESSION['status'] = "Missing required fields";
    $_SESSION['status_icon'] = "error";
    header('Location: ../profile.php');
    exit();
}
?>
