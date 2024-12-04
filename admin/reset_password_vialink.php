<?php
session_start();
require_once "classes/Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get email and OTP from the URL
    $email = isset($_GET['email']) ? trim($_GET['email']) : null;
    $otp = isset($_GET['otp']) ? trim($_GET['otp']) : null;

    if (!$email || !$otp) {
        $_SESSION['status'] = "Invalid or missing link parameters.";
        $_SESSION['status_icon'] = "error";
        header("Location: forgot_password.php");
        exit;
    }

    // Verify the OTP and email by hashing the OTP from the database and comparing
    $otpData = $mainClass->verifyOtpByHash($email, $otp);

    if ($otpData) {
        // OTP is valid, redirect to reset password form
        $_SESSION['email'] = $email; // Pass email to the reset password process
        header("Location: reset_password.php");
        exit;
    } else {
        $_SESSION['status'] = "Invalid OTP or email.";
        $_SESSION['status_icon'] = "error";
        header("Location: forgot_password.php");
        exit;
    }
}
?>
