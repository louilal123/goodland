<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['status'] = "All fields are required.";
        $_SESSION['status_icon'] = "error";
        header("Location: contactus.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Please enter a valid email address.";
        $_SESSION['status_icon'] = "error";
        header("Location: contactus.php");
        exit;
    }

    // Save contact message to the database
    try {
        $mainClass->save_contact_message($name, $email, $subject, $message);
    } catch (Exception $e) {
        $_SESSION['status'] = "Failed to save the message to the database. Error: {$e->getMessage()}";
        $_SESSION['status_icon'] = "error";
        header("Location: contactus.php");
        exit;
    }

    // Fetch the receiving email from the settings table
    try {
        $settings = $mainClass->fetchSettings(); // Using your fetchSettings method
        $receiverEmail = $settings['email']; // Assuming 'contact_email' is the column in your settings table
    } catch (Exception $e) {
        $_SESSION['status'] = "Failed to fetch contact email from settings. Error: {$e->getMessage()}";
        $_SESSION['status_icon'] = "error";
        header("Location: contactus.php");
        exit;
    }

    // Prepare PHPMailer
    $mail = require __DIR__ . "/mailer.php";

    // Set user's email as sender
    try {
        $mail->setFrom($email, htmlspecialchars($name)); // Dynamic sender
    } catch (Exception $e) {
        $_SESSION['status'] = "Invalid sender email: {$e->getMessage()}";
        $_SESSION['status_icon'] = "error";
        header("Location: contactus.php");
        exit;
    }

    // Set the recipient email from the settings table
    $mail->addAddress($receiverEmail); // Use the email fetched from the settings table

    $mail->Subject = htmlspecialchars($subject);
    $mail->isHTML(true);

    $mail->Body = "
        <html>
        <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
                <h2 style='color: #0062cc; text-align: center;'>Contact Form Submission</h2>
                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
                <p><strong>Message:</strong> " . nl2br(htmlspecialchars($message)) . "</p>
            </div>
        </body>
        </html>
    ";

    // Send the email
    try {
        $mail->send();
        $_SESSION['status'] = "Your message has been sent successfully.";
        $_SESSION['status_icon'] = "success";
    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['status_icon'] = "error";
    }

    // Redirect to the contact page
    header("Location: contactus.php");
    exit;
}
?>
