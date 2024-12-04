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

    // Check which button was clicked: send link or send OTP
    if (isset($_POST['send_otp'])) {
        // Generate OTP and get the plain OTP from Main_class
        $otp = $mainClass->initiatePasswordReset($email, 'otp');
        $_SESSION['email'] = $email;

        if ($otp) {
            // Send OTP via email
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

    // For sending the reset link
    if (isset($_POST['send_link'])) {
        $reset_link = $mainClass->initiatePasswordReset($email, 'link');
        $_SESSION['email'] = $email;

        if ($reset_link) {
            // Hash the reset link for security (you could also hash the link if you prefer)
            $hashed_otp = hash('sha256', $reset_link);

            // Generate the reset link with the hashed OTP (for URL)
            $full_reset_link = "https://goodlandv2.com/reset_password_vialink.php?email=" . urlencode($email) . "&otp=" . urlencode($hashed_otp);

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
