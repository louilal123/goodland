<?php
session_start();

// Include the class file
require_once "Main_class.php";

// Initialize error variables
$error_email = '';
$error_password = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email)) {
        $error_email = "Email is required.";
        $_SESSION['error_email'] = $error_email;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format.";
        $_SESSION['error_email'] = $error_email;
    }

    if (empty($password)) {
        $error_password = "Password is required.";
        $_SESSION['error_password'] = $error_password;
    }

    if (empty($error_email) && empty($error_password)) {

        $conn = new Main_class();
        $conn->login_user($email, $password);
        
        if (isset($_SESSION['error_message'])) {
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Please enter valid credentials.";
        header("Location: ../index.php");
        exit();
    }
}
?>
