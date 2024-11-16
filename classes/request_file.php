<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set default visitor_id if not already in session
    if (!isset($_SESSION['visitor_id'])) {
        $_SESSION['visitor_id'] = 1;  // Default visitor_id, change as needed
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

    // Check if the file exists
    if (!file_exists($full_file_path)) {
        $_SESSION['status'] = "The requested file does not exist.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../archives.php#error#requestModal");
        exit();
    }

    // Initialize PHPMailer
    $mail = require __DIR__ . "/../mailer.php";
    $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
    $mail->addAddress($email);
    $mail->Subject = "Requested File Copy";
    $mail->isHTML(true);
    $mail->Body = "Here is your reus==quested file ";
    
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