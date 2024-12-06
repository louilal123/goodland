<?php
session_start();
require_once "Main_class.php";  // Assuming this class handles database interactions
$mainClass = new Main_class();  // Creating an instance of the Main_class

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the OTP and new password from the form
    $otp_from_url = isset($_GET['otp']) ? $_GET['otp'] : '';
    $submitted_otp = isset($_POST['otp']) ? $_POST['otp'] : '';  // OTP from the hidden field in the form
    $new_password = trim($_POST['password']);

    // Validate the new password
    if (empty($new_password)) {
        $_SESSION['status'] = "New password is required.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_url));
        exit;
    }

    // Step 1: Validate OTP
    // Check if the OTP from the URL matches the one stored in the database
    $result = $mainClass->validateResetOTP($otp_from_url, $submitted_otp);

    // If the OTP is valid, proceed with resetting the password
    if ($result) {
        // Step 2: Update the password in the database
        $update_result = $mainClass->updatePassword($new_password, $otp_from_url); // Method that updates password

        if ($update_result) {
            $_SESSION['status'] = "Your password has been successfully reset.";
            $_SESSION['status_icon'] = "success";
            header("Location: ../index.php");  // Redirect to login page
            exit;
        } else {
            $_SESSION['status'] = "Failed to reset your password. Please try again.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_url));
            exit;
        }
    } else {
        $_SESSION['status'] = "Invalid OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_url));  // Redirect back to the reset form
        exit;
    }
} else {
    // If the form is not submitted, redirect to the forgot password page
    $_SESSION['status'] = "Invalid request.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../forgot_password.php");
    exit;
}
