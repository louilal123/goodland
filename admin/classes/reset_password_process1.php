<?php
session_start();
require_once "Main_class.php"; 
require_once "config.php"; 

$mainClass = new Main_class();

if (isset($_POST['otp']) && isset($_POST['password'])) {
    $otp_from_form = $_POST['otp'];  
    $new_password = $_POST['password'];  

    $decrypted_otp = encryptor('decrypt', $otp_from_form);

    echo" $decrypted_otp";

    if ($decrypted_otp === false || empty($decrypted_otp)) {
        $_SESSION['status'] = "Error: OTP decryption failed.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_form));
        exit;
    }

    $otp_data = $mainClass->getMostRecentOtp($decrypted_otp); 

    if ($otp_data) {
        $admin_id = $otp_data['admin_id'];
        $stored_otp = $otp_data['otp'];

        if ($stored_otp === $decrypted_otp) {
            $result = $mainClass->resetPassword($admin_id, $new_password); 

            if ($result) {
                $_SESSION['status'] = "Your password has been successfully reset.";
                $_SESSION['status_icon'] = "success";
                header("Location: ../.php");
                exit;
            } else {
                $_SESSION['status'] = "Failed to reset your password. Please try again.";
                $_SESSION['status_icon'] = "error";
                header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_form));
                exit;
            }
        } else {
            $_SESSION['status'] = "Invalid OTP. Please try again.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_form));
            exit;
        }
    } else {
        $_SESSION['status'] = "Invalid OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../reset_password_vialink.php?otp=" . urlencode($otp_from_form));
        exit;
    }
} else {
    $_SESSION['status'] = "Invalid request. Missing OTP or password.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../forgot_password.php");
    exit;
}
?>
