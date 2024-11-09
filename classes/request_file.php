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
    $email = trim($_POST['email']);
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
    $mail->Body = "<p> hi</p>";
    $mail->addAttachment($full_file_path);

    try {
        if ($mail->send()) {
            $mainClass->saveFileRequest($file_id, $visitor_id, $email);
            $_SESSION['status'] = "The file has been sent to your email.";
            $_SESSION['status_icon'] = "success";
            unset($_SESSION['form_data']); // Clear form data on success
            header("Location: ../archives.php");
            exit();
        } else {
            throw new Exception($mail->ErrorInfo);
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "There was an error sending your file request: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
        header("Location: ../archives.php#error#requestModal");
        exit();
    }
}
?>
