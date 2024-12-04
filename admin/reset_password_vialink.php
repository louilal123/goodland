<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the email and OTP hash from the URL
    $email = isset($_GET['email']) ? trim($_GET['email']) : null;
    $otp = isset($_GET['otp']) ? trim($_GET['otp']) : null;

    // Check if email and otp are present in the URL
    if (!$email || !$otp) {
        $_SESSION['status'] = "Invalid or missing link parameters.";
        $_SESSION['status_icon'] = "error";
        header("Location: forgot_password.php");
        exit;
    }

    // Hash the OTP from the URL (assuming it's SHA256 hashed)
    $hashedOtp = hash('sha256', $otp); // Hash the OTP before verifying

    // Use the method to verify the OTP hash and email
    $verifiedEmail = $mainClass->verifyOtpByHash($hashedOtp);

    if ($verifiedEmail && $verifiedEmail === $email) {
        // OTP is valid, store the email for resetting the password
        $_SESSION['email'] = $email;  
        
        // Redirect to the reset password form
        header("Location: reset_password.php");
        exit;
    } else {
        // Invalid OTP or email
        $_SESSION['status'] = "Invalid OTP or email.";
        $_SESSION['status_icon'] = "error";
        header("Location: forgot_password.php");
        exit;
    }
}
?>
