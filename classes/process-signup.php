<?php 
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php'; 
$main = new Main_class();

// If all validations pass, proceed with user registration
$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);
$random_number = rand(10000, 99999);
$username = 'user_' . $random_number;

if ($main->register_user($name, $email, $password, $activation_token_hash, $username)) {
     // Send activation email
     $mail = require __DIR__ . "/../mailer.php";
     $mail->setFrom("rubinlouie41@gmail.com");
     $mail->addAddress($email); 
     $mail->Subject = "Account Activation";
     $mail->Body = <<<END
       Click <a href="https://goodlandv2.com/activate-account.php?token='$activation_token_hash' ">
       Confirm your email.  </a> You received this message because you provided a legitimate email.
      to activate your account, click the highlighted link to activate your account.
     END;
 
     try {
         $mail->send();
         header("Location: ../c-login.php");
         exit;
     } catch (Exception $e) {
         $_SESSION['status'] = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
         $_SESSION['status_icon'] = "error";
         header("Location: ../c-signup.php");
         exit;
     }
} else {
    $_SESSION['status'] = "Error registering user";
    $_SESSION['status_icon'] = "error";
    header('Location: ../c-signup.php');
    exit;
 

}
?>
