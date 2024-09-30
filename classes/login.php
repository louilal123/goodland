<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $emailOrUsername = filter_var($_POST['emailOrUsername'] ?? '', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';

    $hasError = false;

    // Validate email/username
    if (empty($emailOrUsername)) {
        $_SESSION['error_emailOrUsername'] = "Email is required.";
        $hasError = true;
    } elseif (!filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $emailOrUsername)) {
        $_SESSION['error_emailOrUsername'] = "Valid email is required.";
        $hasError = true;
    }

    // Validate password
    if (empty($password)) {
        $_SESSION['error_password'] = "Password is required.";
        $hasError = true;
    }

    // If there are any errors, redirect back to the form
    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../get-started.php');
        exit();
    }

    // Proceed with login logic if validation passes
    $user = $mainClass->user_login($emailOrUsername, $password);

    if ($user) {
        // Set session data for the logged-in user
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_fullname'] = $user['fullname'];
        $_SESSION['status'] = "Login successful!";
        $_SESSION['status_icon'] = "success";

        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['status'] = "Invalid email or password.";
        $_SESSION['status_icon'] = "error";
        header('Location: ../get-started.php');
        exit();
    }
}
