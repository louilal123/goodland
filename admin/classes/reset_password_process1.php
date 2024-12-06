<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

// Step 1: Check if OTP exists in the URL (GET request)
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

// Step 2: Check if the form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the new password from the form
    $new_password = trim($_POST['password']);
    $otp_from_form = $_POST['otp']; // OTP from the form (hidden field)

    // Validate the new password
    if (empty($new_password)) {
        $_SESSION['status'] = "New password is required.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp)); // Redirect back with OTP
        exit;
    }

    // Step 3: Validate the OTP and update the password
    // Call the resetPasswordlink method from Main_class to handle OTP and password update
    $result = $mainClass->resetPasswordlink($otp_from_form, $new_password);

    if ($result) {
        // If the password is successfully updated
        $_SESSION['status'] = "Your password has been successfully reset.";
        $_SESSION['status_icon'] = "success";
        header("Location: ../login.php");  // Redirect to login page
        exit;
    } else {
        // If password update fails
        $_SESSION['status'] = "Failed to reset your password. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp)); // Redirect back with OTP
        exit;
    }
}
?>
