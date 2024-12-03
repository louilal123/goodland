<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

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

    $otp = $mainClass->initiatePasswordReset($email);
    $_SESSION['email'] =  $email ;

    if ($otp) {
        $mail = require __DIR__ . "/../../mailer.php";
        $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset OTP";
        $mail->Body = 
        "
         <html>
        <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
                <h2 style='color: #0062cc; text-align: center;'>Password Reset Request</h2>
                <p style='font-size: 16px; color: #333;'>Hello,</p>
                <p style='font-size: 16px; color: #333;'>We received a request to reset your password. To complete the process, please use the following OTP (One-Time Password) to reset your password:</p>
                <p style='font-size: 18px; color: #333; font-weight: bold; text-align: center; padding: 10px; background-color: #e0f7fa; border-radius: 4px;'>
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
        }
    } else {
        $_SESSION['status'] = "Failed to generate OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../forgot_password.php");
        exit;
    }
}
?>
