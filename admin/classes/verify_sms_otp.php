<?php
session_start();
require_once 'Main_class.php'; // Assuming Main_class.php handles database interactions

$mainClass = new Main_class();
$email = $_SESSION['email']; // Assuming the email is stored in session after login

// Retrieve OTP from POST data
$otp = trim($_POST['otp']);

if (empty($otp)) {
    $_SESSION['status'] = "Please enter the OTP.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../verify_sms.php");
    exit;
}

// Verify the OTP using the email variable
$user = $mainClass->verifySmsOtp($email, $otp);

if ($user) {
    // If OTP is correct, set session variables and redirect to the dashboard or appropriate page
    $_SESSION['admin_id'] = htmlentities($user['admin_id']);
    $_SESSION['email'] = htmlentities($user['email']);
    $_SESSION['phone'] = htmlentities($user['phone']); // If needed
    $_SESSION['status'] = "Login successful!";
    $_SESSION['status_icon'] = "success";
    header("Location: ../dashboard.php"); // Or wherever the user should be redirected
    exit;
} else {
    // OTP is invalid or expired
    $_SESSION['status'] = "Invalid or expired OTP. Please try again.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../verify_sms.php");
    exit;
}
?>
