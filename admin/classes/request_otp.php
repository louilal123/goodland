<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $reset_option = $_POST['reset_option']; // Get the reset option (otp or link)

    if (empty($email)) {
        $_SESSION['status'] = "Please enter your email address.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Please enter a valid email address.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    if (!$mainClass->emailExists($email)) {
        $_SESSION['status'] = "The email you provided isn't associated with any account.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }

    if ($reset_option == 'otp') {
        $otp = $mainClass->initiatePasswordReset($email, 'otp');
        
        // Send OTP via email
        $mail = require __DIR__ . "/../../mailer.php";
        $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset OTP";
        $mail->Body = "
        <html>
            <body style='font-family: Arial, sans-serif;'>
                <h2>Password Reset Request</h2>
                <p>We received a request to reset your password. Please use the following OTP:</p>
                <p><strong>$otp</strong></p>
                <p>This OTP is valid for 24 hours.</p>
            </body>
        </html>
        ";

        try {
            $mail->send();
            $_SESSION['status1'] = "OTP has been sent to your email.";
            $_SESSION['status_icon1'] = "success";
            header("Location: ../verify_user.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['status1'] = "Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['status_icon1'] = "error";
            header("Location: ../forgot_password.php");
            exit;
        }
    } elseif ($reset_option == 'link') {
        $reset_link = $mainClass->initiatePasswordReset($email, 'link');
        
        // Send Reset Link via email
        $mail = require __DIR__ . "/../../mailer.php";
        $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset Link";
        $mail->Body = "
        <html>
            <body style='font-family: Arial, sans-serif;'>
                <h2>Password Reset Request</h2>
                <p>We received a request to reset your password. To reset your password, please click the following link:</p>
                <p><a href='$reset_link'>Reset Password</a></p>
                <p>This link is valid for 24 hours.</p>
            </body>
        </html>
        ";

        try {
            $mail->send();
            $_SESSION['status1'] = "Password reset link has been sent to your email.";
            $_SESSION['status_icon1'] = "success";
            header("Location: ../verify_user.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['status1'] = "Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['status_icon1'] = "error";
            header("Location: ../forgot_password.php");
            exit;
        }
    }
}
?>
