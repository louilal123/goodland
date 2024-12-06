<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

// Check if OTP exists in the URL (GET request)
if (isset($_GET['otp'])) {
    $hashed_otp = $_GET['otp']; // Get the hashed OTP from the URL
    // Log OTP for debugging purposes
    error_log("OTP from URL: " . $hashed_otp);
} else {
    // If OTP is missing from the URL, show an error and redirect
    error_log("OTP is missing from the URL");
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
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp)); // Redirect back with OTP
        exit;
    }

    // Validate OTP and update password
    $result = $mainClass->resetPasswordlink($hashed_otp, $new_password);

    if ($result) {
        $_SESSION['status'] = "Your password has been successfully reset.";
        $_SESSION['status_icon'] = "success";
        header("Location: ../login.php");  // Redirect to login page
        exit;
    } else {
        $_SESSION['status'] = "Failed to reset your password. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp)); // Redirect back with OTP
        exit;
    }
}
?>
