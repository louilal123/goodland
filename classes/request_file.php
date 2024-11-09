<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['visitor_id'])) {
        $_SESSION['visitor_id'] = 1;
    }

    $visitor_id = $_SESSION['visitor_id'];

    // Get form inputs
    $email = $_POST['email'];
    $file_id = $_POST['file_id'];
    $file_path = $_POST['file_path'];
    $file_title = $_POST['file-title'];

    // Store form data in session in case of error
    $_SESSION['form_data'] = [
        'email' => $email,
        'file_id' => $file_id,
        'file_path' => $file_path,
        'file_title' => $file_title
    ];

    // Validate email input
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Please enter a valid email address.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../archives.php#error#requestModal");
        exit();
    }

    $full_file_path = __DIR__ . "/../admin/uploads/" . $file_path;

    if (!file_exists($full_file_path)) {
        $_SESSION['status'] = "The requested file does not exist.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../archives.php#error#requestModal");
        exit();
    }

    // Initialize PHPMailer
    $mail = require __DIR__ . "/../admin/mailer.php";
    $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
    $mail->addAddress($email);
    $mail->Subject = "Requested File Copy";
    $mail->isHTML(true);
    $mail->Body = '
    <div style="font-family:Arial,sans-serif">
        <div class="adM"></div>
        <div style="font-size:18px;background-color:#e0f7fa;color:#333333;padding:20px">
            <div class="adM"></div>
            <p>Hello,</p>
            <p style="font-size:20px;color:#0062cc;font-weight:bold">
                You requested a copy of the file titled: 
                <strong>\'' . htmlspecialchars($file_title) . '\'</strong> from our platform.
            </p>
            <p style="font-size:16px">Below is the attached file. You can download it at your convenience.</p>
            <p style="font-size:16px">Thank you for using our platform!</p>
            <p style="font-size:14px;color:#888888">
                Best regards, <br>
                <a href="http://goodlandv2.com" target="_blank">GOODLAND.PH</a>
            </p>
            <div class="yj6qo"></div>
            <div class="adL"></div>
        </div>
        <div class="adL"></div>
    </div>';
    
    
    $mail->addAttachment($full_file_path);

  
try {
    // Attempt to send the email
    if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo); // Throw an exception if sending fails
    }

    // Log the file request if email is sent successfully
    $mainClass->saveFileRequest($file_id, $visitor_id, $email);

    // Set success session status and redirect
    $_SESSION['status'] = "The file has been sent to your email.";
    $_SESSION['status_icon'] = "success";
    header("Location: ../archives.php");
    exit();
} catch (Exception $e) {
    // Set error session status and redirect with error message
    $_SESSION['status'] = "Error sending your file request: " . $e->getMessage();
    $_SESSION['status_icon'] = "error";
    header("Location: ../archives.php#error#requestModal");
    exit();
}
}
?>
