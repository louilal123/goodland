<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

// Check if OTP exists in the URL (GET request)
if (isset($_GET['otp'])) {
    $hashed_otp_from_url = $_GET['otp']; // Get the hashed OTP from the URL
} else {
    // If OTP is missing from the URL, show an error and redirect
    $_SESSION['status'] = "Invalid request. OTP missing.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../forgot_password.php");
    exit;
}

// Check if the form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the new password from the form
    $new_password = trim($_POST['password']);
    
    // Validate the new password
    if (empty($new_password)) {
        $_SESSION['status'] = "New password is required.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp_from_url)); // Redirect back with OTP
        exit;
    }

    // Fetch the plain OTP from the database (assuming you have a method to do this)
    $email = $_SESSION['email'];  // Assuming email is stored in session
    $plain_otp = $mainClass->getOtpFromDatabase($email); // Fetch plain OTP from DB

    // Compare the hashed OTP from URL with the plain OTP from the database
    if ($plain_otp && password_verify($hashed_otp_from_url, $plain_otp)) {
        // OTP is valid, proceed with password reset
        $result = $mainClass->resetPasswordlink($hashed_otp_from_url, $new_password);

        if ($result) {
            $_SESSION['status'] = "Your password has been successfully reset.";
            $_SESSION['status_icon'] = "success";
            header("Location: ../login.php");  // Redirect to login page
            exit;
        } else {
            $_SESSION['status'] = "Failed to reset your password. Please try again.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp_from_url)); // Redirect back with OTP
            exit;
        }
    } else {
        // Invalid OTP, redirect back
        $_SESSION['status'] = "Invalid OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp_from_url)); // Redirect back with OTP
        exit;
    }
}
?>
