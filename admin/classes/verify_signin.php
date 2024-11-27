<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = trim($_POST['otp']);
    $email = $_SESSION['email'];

    if (empty($otp)) {
        $_SESSION['status'] = "Please enter the OTP.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_signin.php");
        exit;
    }

    $user = $mainClass->verifyEmailOtp($email, $otp);

    if ($user) {
        $_SESSION['admin_id'] = htmlentities($user['admin_id']);
        $_SESSION['email'] = htmlentities($user['email']);
        $_SESSION['status'] = "Login Successful!";
        $_SESSION['status_icon'] = "success";
        header("Location: ../dashboard.php");
        exit;
    } else {
        $_SESSION['status'] = "Invalid or expired OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_signin.php");
        exit;
    }
}
?>
