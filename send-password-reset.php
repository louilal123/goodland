<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php';

$main = new Main_class();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];
    
    // Check if the email exists in the database
    if ($main->is_email_exists($email)) {
        // Generate the token and its hash
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30); // 30 minutes from now
        
        // Save the reset token in the database
        if ($main->save_reset_token($email, $token_hash, $expiry)) {
            // Prepare and send the reset password email
            $mail = require __DIR__ . "/mailer.php";

            $mail->setFrom("rubinlouie41@gmail.com"); // Change this to your verified email
            $mail->addAddress($email);
            $mail->Subject = "Password Reset";
            $mail->Body = <<<END
                Click <a href="http://localhost/goodland/reset-password.php?token=$token">here</a> 
                to reset your password. This link expires in 30 minutes.
            END;

            try {
                $mail->send();
                echo "Password reset email sent, please check your inbox.";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Failed to set password reset token.";
        }
    } else {
        echo "Email not found.";
    }
} else {
    echo "Invalid request.";
}
?>
