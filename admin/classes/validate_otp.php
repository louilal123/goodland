<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = trim($_POST['otp']);
    $email = $_SESSION['email']; 

    // Check if OTP is empty
    if (empty($otp)) {
        $_SESSION['status'] = "Please enter the OTP.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_user.php");
        exit;
    }

    // Check if OTP is 6 digits long
    if (!preg_match('/^\d{6}$/', $otp)) {
        $_SESSION['status'] = "OTP must be a 6-digit number.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_user.php");
        exit;
    }

    // Verify OTP against the database
    $otpVerification = $mainClass->verifyOtp($email, $otp);

    if (!$otpVerification) {
        $_SESSION['status'] = "Invalid OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_user.php");
        exit;
    }

    // Check if the OTP matches and if it has expired
    if ($otpVerification['otp'] !== $otp) {
        $_SESSION['status'] = "Invalid OTP. Please check your email: '$email'.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_user.php");
        exit;
    }

    // If the OTP has expired
    if (strtotime($otpVerification['expires_at']) < time()) {
        $_SESSION['status'] = "The OTP has expired. Please request a new one.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../verify_user.php");
        exit;
    }
    $_SESSION['otp_verified'] = true; // Set this to true after verification
    $_SESSION['email'] = $email; 
    header("Location: ../reset_password.php"); // Redirect to reset password page
    exit;
}
?>
