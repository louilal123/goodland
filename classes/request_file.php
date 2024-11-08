<?php 
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    if (!isset($_SESSION['visitor_id'])) {
        $_SESSION['visitor_id'] = 1;  
    }
    
    // Get form inputs
    $email = trim($_POST['email']);
    $file_id = $_POST['file_id'];
    $file_path = $_POST['file_path'];
    $file_title =  $_POST['file-title'];  

    // Validate email input
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Please enter a valid email address.";
        $_SESSION['status_icon'] = "error";
        $_SESSION['form_data'] = $_POST;
        $_SESSION['open_modal'] = true; // Flag to keep the modal open
        header("Location: ../archives.php#requestModal");
        exit();
    }

    $full_file_path = __DIR__ . "/../admin/uploads/" . $file_path;

    if (!file_exists($full_file_path)) {
        $_SESSION['status'] = "The requested file does not exist.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../archives.php#requestModal");
        exit();
    }

    // Initialize PHPMailer
    $mail = require __DIR__ . "/../admin/mailer.php";
    $mail->setFrom("rubinlouie41@gmail.com", "GOODLAND.PH");
    $mail->addAddress($email);
    $mail->Subject = "Requested File Copy";
    $mail->isHTML(true); // Enable HTML if your mail body is HTML-formatted

    $mail->Body = "
   <p> hi</p>
";


    $mail->addAttachment($full_file_path);

    try {
        // Attempt to send the email
        if ($mail->send()) {
            // Save the request in the database
            $mainClass->saveFileRequest($file_id, $visitor_id, $email); // Log the request

            // Success message
            $_SESSION['status'] = "The file has been sent to your email.";
            $_SESSION['status_icon'] = "success";
            header("Location: ../archives.php");
            exit();
        } else {
            throw new Exception($mail->ErrorInfo);
        }
    } catch (Exception $e) {
        // If email sending fails, capture error and keep modal open
        $_SESSION['status'] = "There was an error sending your file request: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
        header("Location: ../archives.php");
        exit();
        $_SESSION['form_data'] = $_POST; // Repopulate form data
        $_SESSION['open_modal'] = true;  // Keep modal open for user correction
    }

    // Clear any remaining form data and modal flags after successful request handling
    unset($_SESSION['form_data']); 
    unset($_SESSION['open_modal']); 
    header("Location: ../archives.php");
    exit();
}
?>
