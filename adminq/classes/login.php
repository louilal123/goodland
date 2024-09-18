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

    // Validate fields
    if (empty($emailOrUsername)) {
        $_SESSION['error_emailOrUsername'] = "Email or Username is required.";
    } 

    if (empty($password
    )) {
        $_SESSION['error_password'] = "Password is required.";
    }

    // If there are no validation errors, proceed with authentication
    if (empty($_SESSION['error_emailOrUsername']) && empty($_SESSION['error_password'])) {
        $conn = new Main_class();
        $result = $conn->login_user($emailOrUsername, $password);

        // If login_user returns false, set an error message for invalid credentials
        if (!$result) {
            $_SESSION['status'] = "Invalid credentials! Please try again.";
            $_SESSION['status_icon'] = "error";
        }
    } else {
        $_SESSION['error_message'] = "Please fill out the required fields.";
    }

    // Redirect back to login page
    header("Location: ../index.php");
    exit();
}
