<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $birthday = $_POST['bday'];
    $username = $_POST['username'];
    $password = $_POST['pswd'];
    $confirm_password = $_POST['cpswd'];

    $hasError = false;

    if (empty($fullname)) {
        $_SESSION['error_fullname'] = "Fullname is required.";
        $hasError = true;
    }

    if (empty($email)) {
        $_SESSION['error_email'] = "Email is required.";
        $hasError = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_email'] = "Invalid email format.";
        $hasError = true;
    } elseif ($mainClass->is_email_exists($email)) {
        $_SESSION['error_email'] = "Email already exists.";
        $hasError = true;
    }

    if (empty($birthday)) {
        $_SESSION['error_birthday'] = "Birthday is required.";
        $hasError = true;
    }

    if (empty($username)) {
        $_SESSION['error_username'] = "Username is taken.";
        $hasError = true;
    } elseif ($mainClass->is_username_exists($username)) {
        $_SESSION['error_username'] = "Username already exists.";
        $hasError = true;
    }

    if (empty($password)) {
        $_SESSION['error_password'] = "Password is required.";
        $hasError = true;
    } 
    if (empty($confirm_password)) {
        $_SESSION['error_confirm_password'] = "Confirm password is required.";
        $hasError = true;
    } elseif ($password !== $confirm_password) {
        $_SESSION['error_confirm_password'] = "Passwords do not match.";
        $hasError = true;
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../register.php');
        exit();
    }

    if ($mainClass->register_user($fullname, $email, $birthday, $username, $password)) {
     
        unset($_SESSION['form_data']);
        header('Location: ../get-started.php');
        exit();
    } else {
        header('Location: ../register.php');
        exit();
    }
}
?>