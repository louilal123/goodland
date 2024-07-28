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
        $_SESSION['user_birthday'] = $user['birthday'];
        $_SESSION['user_last_login'] = $user['last_login'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['user_photo'] = $user['user_photo'];
        $_SESSION['user_password'] = $user['password'];
        $_SESSION['user_date_created'] = $user['date_updated'];
        $_SESSION['user_date_updated'] = $user['date_updated'];
        $_SESSION['user_address'] = $user['address'];
        $_SESSION['user_bio'] = $user['bio'];
        $_SESSION['status'] = "Login successful!";
        $_SESSION['status_icon'] = "success";
        
        // Track visitor and update user ID
        $mainClass->trackVisitor(true, $user['user_id']);
        
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
