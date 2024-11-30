<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php';

$mainClass = new Main_class();

// Check if the visitor's request data exists in session
if (!isset($_SESSION['file_requests'])) {
    $_SESSION['file_requests'] = [];
}

// File-specific limit and time window
$request_limit = 3;
$time_window = 86400; // 24 hours in seconds

// Get the file ID from the POST request
$file_id = $_POST['file_id'];

// Initialize the request data for this file if not already set
if (!isset($_SESSION['file_requests'][$file_id])) {
    $_SESSION['file_requests'][$file_id] = [
        'request_count' => 0,
        'last_request_time' => time(),
    ];
}

// Check if the time window has passed for this file, reset the count if needed
if (time() - $_SESSION['file_requests'][$file_id]['last_request_time'] > $time_window) {
    $_SESSION['file_requests'][$file_id]['request_count'] = 0; // Reset count after 24 hours
    $_SESSION['file_requests'][$file_id]['last_request_time'] = time(); // Update time
}

// If the visitor has exceeded the request limit for this file
if ($_SESSION['file_requests'][$file_id]['request_count'] >= $request_limit) {
    $_SESSION['status'] = "You have reached the maximum number of requests for this file. Please try again later.";
    $_SESSION['status_icon'] = "error";
    header("Location: archives.php#error#requestModal");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $visitor_id = $_SESSION['visitor_id'];

    // Get form inputs
    $email = $_POST['email'];
    $file_path = $_POST['file_path'];
    $file_title = $_POST['file_title'];

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
        header("Location: archives.php#error#requestModal");
        exit();
    }

    $full_file_path = $file_path;

    if (!file_exists($full_file_path)) {
        $_SESSION['status'] = "The requested file does not exist.";
        $_SESSION['status_icon'] = "error";
        header("Location: archives.php#error#requestModal");
        exit();
    }

    $mail = require __DIR__ . "/mailer.php";
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
        if (!$mail->send()) {
            throw new Exception($mail->ErrorInfo); 
        }

        // Increment the request count for the specific file
        $_SESSION['file_requests'][$file_id]['request_count']++;

        // Save the request details in the database
        $mainClass->saveFileRequest($file_id, $visitor_id, $email);

        $_SESSION['status'] = "The file has been sent to your email.";
        $_SESSION['status_icon'] = "success";
        header("Location: archives.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['status'] = "Error sending your file request: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
        header("Location: archives.php#error#requestModal");
        exit();
    }
}
?>
