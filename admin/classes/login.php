<?php
session_start();
require_once "Main_class.php"; 

$mainClass = new Main_class();

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($_SESSION['login_attempts'] >= 3) {
        $current_time = time();
        $lockout_time = $_SESSION['lockout_time'];

        if ($lockout_time && ($current_time - $lockout_time) < 180) {
            $remaining_time = 180 - ($current_time - $lockout_time);
            $_SESSION['status'] = "Too many failed login attempts. Please try again in $remaining_time seconds.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../");
            exit;
        } else {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['lockout_time'] = null;
        }
    }

    if (empty($email) || empty($password)) {
        $_SESSION['status'] = "Please fill out both fields.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../");
        exit;
    }

    $otp = $mainClass->login_user($email, $password);  

    if ($otp) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lockout_time'] = null;

        session_regenerate_id(true);

        $_SESSION['session_token'] = bin2hex(random_bytes(32)); 
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];  
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];  
        $_SESSION['email'] = $email;  
        $_SESSION['admin_id'] = $admin_id; 

        $user_ip = $_SESSION['ip_address'];
        $user_agent = $_SESSION['user_agent'];

        $mail = require __DIR__ . "/../../mailer.php"; 

        $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
        $mail->addAddress($email);  
        $mail->Subject = "Sign-In OTP Verification";
        $mail->Body = "
        <html>
        <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
                <h2 style='color: #0062cc; text-align: center;'>Sign-In OTP Verification</h2>
                <p style='font-size: 16px; color: #333;'>Hello,</p>
                <p style='font-size: 16px; color: #333;'>We received a request to sign in. To complete the process, please use the following OTP (One-Time Password) to verify your identity:</p>
                <p style='font-size: 18px; color: #333; font-weight: bold; text-align: center; padding: 10px; background-color: #e0f7fa; border-radius: 4px;'>
                    <strong>$otp</strong>
                </p>
                <p style='font-size: 16px; color: #333;'>This OTP is valid for 10 minutes. </p>
                <p style='font-size: 16px; color: #333;'>If you did not request this, please ignore this message.</p>

                <h3 style='color: #0062cc;'>Login Attempt Details</h3>
                <p style='font-size: 16px; color: #333;'>The request for this access originated from IP address: <strong>$user_ip</strong></p>
                <p style='font-size: 16px; color: #333;'>User-Agent: <strong>$user_agent</strong></p>

                <p style='font-size: 16px; color: #333;'>Best regards, <br> The GOODLAND.PH Team</p>
            </div>
        </body>
        </html>
        ";

        try {
            $mail->send();
            header("Location: ../verify_signin.php"); 
            exit;
        } catch (Exception $e) {
            $_SESSION['status1'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['status_icon1'] = "error";
            header("Location: ../");
            exit;
        }
    } else {
        $_SESSION['login_attempts']++;

        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['lockout_time'] = time();
            $_SESSION['status'] = "Too many failed login attempts. Please try again in 3 minutes.";
            $_SESSION['status_icon'] = "error";
        } else {
            $_SESSION['status'] = "Invalid email or password. Please try again.";
            $_SESSION['status_icon'] = "error";
        }

        header("Location: ../");
        exit;
    }
}
?>
