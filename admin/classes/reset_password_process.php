<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; // Get the email from the hidden input
    $new_password = $_POST['password']; // Get the new password from the form

    // Call the resetPassword function
    if ($mainClass->resetPassword($email, $new_password)) {
        $_SESSION['status'] = "Your password has been reset successfully.";
        $_SESSION['status_icon'] = "success";
        header("Location: ../index.php"); // Redirect to the login page after success
    } else {
        $_SESSION['status'] = "Failed to reset password. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password.php"); // Redirect back to the reset form
    }
    exit;
}


?>
