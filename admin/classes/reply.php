<?php
session_start();
require_once "Main_class.php";

// Include the mailer
$mail = require __DIR__ . "/../../mailer.php"; // Adjust the path as necessary

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $id = $_POST['id']; // The message ID to reply to
    $reply_message = $_POST['reply_message']; // The reply message content
    $admin_id = $_SESSION['admin_id']; // Admin ID from session (assumes admin is logged in)
    $user_email = $_POST['email']; // The email of the user who sent the message

    if ($mainClass->insert_reply($id, $admin_id, $reply_message)) {
        $_SESSION['status'] = "Your reply has been sent successfully.";
        $_SESSION['status_icon'] = "success";

        $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
        $mail->addAddress($user_email);  
        $mail->Subject = "Your Message has been Replied to";
        $mail->Body = "
        <html>
        <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
             <p style='font-size: 16px; color: #333; font-weight: bold;'>$reply_message</p>
               <p style='font-size: 16px; color: #333;'>Best regards, <br> The GOODLAND.PH Team</p>
            </div>
        </body>
        </html>
        ";

        try {
            $mail->send();
            header("Location: ../messages.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['status'] = "Reply sent, but email notification failed. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['status_icon'] = "error";
            header("Location: ../messages.php"); 
            exit;
        }
    } else {
        $_SESSION['status'] = "Failed to send the reply. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../messages.php"); 
    }
} else {
    $_SESSION['status'] = "Please enter a reply message.";
    $_SESSION['status_icon'] = "error";
    header("Location: ../messages.php"); 
}
exit;
