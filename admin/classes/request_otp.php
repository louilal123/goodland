<?php
session_start();
require_once "Main_class.php";
require_once "config.php";

$mainClass = new Main_class();

// Initialize login attempt and lockout time if not already set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    // Check if email is provided
    if (empty($email)) {
        $_SESSION['status'] = "Please enter your email address.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Please enter a valid email address.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    // Check if email exists in the database
    if (!$mainClass->emailExists($email)) {
        $_SESSION['status'] = "The email you provided isn't associated with any account.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    // Lockout mechanism: Too many failed attempts will lock the user out
    if ($_SESSION['login_attempts'] >= 3) {
        $current_time = time();
        $lockout_time = $_SESSION['lockout_time'];

        // If locked out, check the time remaining before they can try again
        if ($lockout_time && ($current_time - $lockout_time) < 300) { // 5 minutes lockout
            $remaining_time = 300 - ($current_time - $lockout_time);
            $_SESSION['status'] = "Too many failed attempts. Please try again in $remaining_time seconds.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../forgot_password.php");
            exit;
        } else {
            // Reset attempts and lockout time after 5 minutes
            $_SESSION['login_attempts'] = 0;
            $_SESSION['lockout_time'] = null;
        }
    }

    // Process OTP or reset link request
    if (isset($_POST['send_otp'])) {
        $otp = $mainClass->initiatePasswordReset($email, 'otp');
        $_SESSION['email'] = $email;

        if ($otp) {
            $mail = require __DIR__ . "/../../mailer.php";
            $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
            $mail->addAddress($email);
            $mail->Subject = "Password Reset OTP";
            $mail->Body = "
            <html>
                <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
                    <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
                        <h2 style='color: #0062cc; text-align: center;'>Password Reset Request</h2>
                        <p style='font-size: 16px; color: #333;'>Hello,</p>
                        <p style='font-size: 16px; color: #333;'>We received a request to reset your password. To complete the process, please use the following OTP (One-Time Password) to reset your password:</p>
                        <p style='font-size: 18px; color: #333; font-weight: bold; text-align: center; padding: 10px; background-color: #e0f7fa; border-radius: 4px;' >
                            <strong>$otp</strong>
                        </p>
                        <p style='font-size: 16px; color: #333;'>This OTP is valid for 24 hours. </p>
                        <p style='font-size: 16px; color: #333;'>If you need further assistance, feel free to contact via this email.</p>
                        <p style='font-size: 16px; color: #333;'>Best regards, <br> The GOODLAND.PH Team</p>
                    </div>
                </body>
            </html>
            ";

            try {
                $mail->send();
                $_SESSION['status1'] = "We've sent an OTP to your email.";
                $_SESSION['status_icon1'] = "success";
                header("Location: ../verify_user.php");
                exit;
            } catch (Exception $e) {
                $_SESSION['status1'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $_SESSION['status_icon1'] = "error";
                header("Location: ../forgot_password.php");
                exit;
            }
        } else {
            $_SESSION['status'] = "Failed to generate OTP. Please try again.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../forgot_password.php");
            exit;
        }
    }

    // Generate and send password reset link
    if (isset($_POST['send_link'])) {
        $otp = rand(100000, 999999);
        
        $user = $mainClass->initiatePasswordResetLink($email, $otp);
        
        if ($user !== false) {
            $encrypted_otp = encryptor('encrypt', $otp);
            $_SESSION['otp'] = $otp;  
            
            $full_reset_link = "https://goodlandv2.com/admin/reset_password_vialink.php?otp=" . urlencode($encrypted_otp);

            $mail = require __DIR__ . "/../../mailer.php";
            $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
            $mail->addAddress($email);
            $mail->Subject = "Password Reset Link";
            $mail->Body = "
            <html>
                <body style='font-family: Arial, sans-serif;'>
                    <h2>Password Reset Request</h2>
                    <p>We received a request to reset your password. To reset your password, please click the following link:</p>
                    <p><a href='$full_reset_link'>Reset Password</a></p>
                    <p>This link is valid for 24 hours.</p>
                </body>
            </html>
            ";

            try {
                $mail->send();
                $_SESSION['status1'] = "Password reset link has been sent to your email.";
                $_SESSION['status_icon1'] = "success";
                header("Location: ../verify_user_link.php");
                exit;
            } catch (Exception $e) {
                $_SESSION['status1'] = "Mailer Error: {$mail->ErrorInfo}";
                $_SESSION['status_icon1'] = "error";
                header("Location: ../forgot_password.php");
                exit;
            }
        } else {
            $_SESSION['status'] = "Failed to generate reset link. Please try again.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../forgot_password.php");
            exit;
        }
    }
}
?>
