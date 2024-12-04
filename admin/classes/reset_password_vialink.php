<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get email and OTP from the URL
    $email = isset($_GET['email']) ? trim($_GET['email']) : null;
    $otp = isset($_GET['otp']) ? trim($_GET['otp']) : null;

    if (!$email || !$otp) {
        $_SESSION['status'] = "Invalid or missing link parameters.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    // Verify the OTP and email
    $otpData = $mainClass->verifyOtp($email, $otp);

    if ($otpData) {
        // Check if OTP is expired
        $currentTime = new DateTime();
        $expiryTime = new DateTime($otpData['expires_at']);

        if ($currentTime > $expiryTime) {
            $_SESSION['status'] = "The OTP has expired.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../forgot_password.php");
            exit;
        }

        // OTP is valid, redirect to reset password form
        $_SESSION['email'] = $email; // Pass email to the reset password process
        header("Location: ../reset_password.php");
        exit;
    } else {
        $_SESSION['status'] = "Invalid OTP or email.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }
}
?>
