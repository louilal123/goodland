<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrUsername = filter_var($_POST['emailOrUsername'] ?? '', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';

    $hasError = false;

    if (empty($emailOrUsername)) {
        $_SESSION['error_emailOrUsername'] = "Email is required.";
        $hasError = true;
    } elseif (!filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $emailOrUsername)) {
        $_SESSION['error_emailOrUsername'] = "Valid email is required.";
        $hasError = true;
    }

    if (empty($password)) {
        $_SESSION['error_password'] = "Password is required.";
        $hasError = true;
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../c-login.php');
        exit();
    }

    $user = $mainClass->user_login($emailOrUsername, $password);

    if (is_array($user) && isset($user['user_id'], $user['fullname'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_fullname'] = $user['fullname'];
        $_SESSION['status'] = "Login successful!";
        $_SESSION['status_icon'] = "success";
    
        header('Location: dashboard.php');
        exit();
    } elseif ($user === 'account_not_activated_or_disabled') {
        $_SESSION['status'] = "Please wait for the admins to verify your signup application.";
        $_SESSION['status_icon'] = "error";
        header('Location: ../c-login.php');
        exit();
    } else {
        $_SESSION['status'] = "Invalid email or password.";
        $_SESSION['status_icon'] = "error";
        header('Location: ../c-login.php');
        exit();
    }
}
?>