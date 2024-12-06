<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

// Get OTP from the URL (GET request)
$hashed_otp = isset($_GET['otp']) ? $_GET['otp'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get new password from the form
    $password = trim($_POST['password']);

    // Validate input
    if (empty($hashed_otp) || empty($password)) {
        $_SESSION['status'] = "All fields are required.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp));
        exit;
    }

    // Check if OTP exists and get associated email
    $email = $mainClass->getEmailFromOtp($hashed_otp);
    if (!$email) {
        $_SESSION['status'] = "Invalid OTP.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    // Get the admin ID associated with the email
    $admin_id = $mainClass->getAdminIdByEmail($email);
    if (!$admin_id) {
        $_SESSION['status'] = "User not found.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Update the password and clear reset token
    $update_status = $mainClass->update_password($admin_id, $hashed_password);
    if ($update_status) {
        $_SESSION['status'] = "Your password has been successfully reset.";
        $_SESSION['status_icon'] = "success";
        header("Location: ../login.php");
        exit;
    } else {
        $_SESSION['status'] = "Failed to reset your password. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($hashed_otp));
        exit;
    }
}
?>
