<?php
session_start();

// Include the class file
require_once "Main_class.php";

// Initialize error variables
$error_emailOrUsername = '';
$error_password = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrUsername = $_POST['emailOrUsername'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($emailOrUsername)) {
        $error_emailOrUsername = "Email or Username is required.";
        $_SESSION['error_emailOrUsername'] = $error_emailOrUsername;
    } 

    if (empty($password)) {
        $error_password = "Password is required.";
        $_SESSION['error_password'] = $error_password;
    }

    if (empty($error_emailOrUsername) && empty($error_password)) {
        $conn = new Main_class();
        $conn->login_user($emailOrUsername, $password);
    } else {
        $_SESSION['error_message'] = "Please enter valid credentials.";
        header("Location: ../index.php");
        exit();
    }
}
?>
