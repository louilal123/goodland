<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hasError = false;

    if (empty($email)) {
        $_SESSION['error_email'] = "Email is required.";
        $hasError = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_email'] = "Invalid email format.";
        $hasError = true;
    }

    if (empty($password)) {
        $_SESSION['error_password'] = "Password is required.";
        $hasError = true;
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../get-started.php');
        exit();
    }

    $user = $mainClass->user_login($email, $password);
    if ($user) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_fullname'] = $user['fullname'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_photo'] = $user['photo'];
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
?>