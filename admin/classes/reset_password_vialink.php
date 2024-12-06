<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get email and OTP from the URL
    $email = isset($_GET['email']) ? trim($_GET['email']) : null;
    $otp = isset($_GET['otp']) ? trim($_GET['otp']) : null;

    // Check if both parameters exist
    if (!$email || !$otp) {
        $_SESSION['status'] = "Invalid or missing link parameters.";
        $_SESSION['status_icon'] = "error";
        header("Location: forgot_password.php");
        exit;
    }

    // Verify the OTP by hashing the OTP from the database and comparing it
    $otpData = $mainClass->verifyOtpByHash($email, $otp);

    // Check if OTP is valid
    if ($otpData) {
        // OTP is valid, proceed to reset the password
        $_SESSION['email'] = $email; // Store email in session for the reset password process
        header("Location: ../reset_password.php");
        exit;
    } else {
        // OTP is invalid
        $_SESSION['status'] = "Invalid OTP or email.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }
}
?>
