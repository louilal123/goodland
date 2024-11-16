<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/phpmailer/src/PHPMailer.php";
require_once __DIR__ . "/phpmailer/src/Exception.php";
require_once __DIR__ . "/phpmailer/src/SMTP.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rubinlouie41@gmail.com';
    $mail->Password = 'etpkblhyaxhdfcpf';  // App password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('rubinlouie41@gmail.com', 'GOODLAND.PH');
    $mail->addAddress('recipient@example.com');
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email';

    $mail->send();
    echo "Message sent successfully!";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>
