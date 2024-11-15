<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable to see the debug output
    $mail->isSMTP();                                           // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                            // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                    // Enable SMTP authentication
    $mail->Username = 'rubinlouie41@gmail.com';                // Your Gmail address
    $mail->Password = 'etpkblhyaxhdfcpf';                     // Your Gmail App Password (not your regular password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also works
    $mail->Port = 587;                                         // Port for TLS (465 is for SSL)

    //Content
    $mail->isHTML(true);                                       // Set email format to HTML
    // You can add more configuration like setting 'From', 'To', 'Subject', etc.

    return $mail;

} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
