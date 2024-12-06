<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

// Check if the OTP exists in the URL (GET request)
if (isset($_GET['otp'])) {
    $hashed_otp = $_GET['otp']; // Get the hashed OTP from the URL
} else {
    // If OTP is not provided, redirect to the forgot password page
    $_SESSION['status'] = "Invalid request. OTP missing.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../forgot_password.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the new password from the form submission
    $new_password = trim($_POST['password']);

    // Validate the new password input
    if (empty($new_password)) {
        $_SESSION['status'] = "New password is required.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp));
        exit;
    }

    // Step 1: Call the resetPasswordlink method to update the password
    $result = $mainClass->resetPasswordlink($hashed_otp, $new_password);

    // Step 2: Handle response based on the result of the password update
    if ($result) {
        $_SESSION['status'] = "Your password has been successfully reset.";
        $_SESSION['status_icon'] = "success";
        header("Location: ../login.php");  // Redirect to login page
        exit;
    } else {
        $_SESSION['status'] = "Failed to reset your password. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp));  // Redirect back to the reset form
        exit;
    }
}

?>

