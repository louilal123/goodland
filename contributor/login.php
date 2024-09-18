<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrUsername = $_POST['emailOrUsername'];
    $password = $_POST['password'];

    // Check for empty fields
    if (empty($emailOrUsername)) {
        $_SESSION['error_emailOrUsername'] = "Email or Username is required.";
        $_SESSION['form_data']['emailOrUsername'] = $emailOrUsername;
        header('Location: ../c-login.php');
        exit();
    }

    if (empty($password)) {
        $_SESSION['error_password'] = "Password is required.";
        $_SESSION['form_data']['emailOrUsername'] = $emailOrUsername;
        header('Location: ../c-login.php');
        exit();
    }

    // Attempt login
    $user = $mainClass->user_login($emailOrUsername, $password);

    if ($user === 'account_not_activated') {
        $_SESSION['status'] = "Your account is not activated. Please verify your email.";
        $_SESSION['status_icon'] = "warning";
        header('Location: ../c-login.php');
        exit();
    } elseif (is_array($user)) {
        $_SESSION['status'] = "Login successful!";
        $_SESSION['status_icon'] = "success";
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header('Location: dashboard.php'); 
        exit();
    } else {
        $_SESSION['status'] = "Invalid email/username or password.";
        $_SESSION['status_icon'] = "error";
        header('Location: ../c-login.php');
        exit();
    }
}
