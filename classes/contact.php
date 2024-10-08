<?php
session_start();

require_once __DIR__ . '/../admin/classes/Main_class.php';
$main = new Main_class();

// Default form values
$name = $email = $subject = $message = "";
$valid = true;

// Validate Name
if (empty(trim($_POST["name"]))) {
    $_SESSION['name_err'] = "Name is required.";
    $valid = false;
} else {
    $name = trim($_POST["name"]);
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $_SESSION['name_err'] = "Name should only contain letters and spaces.";
        $valid = false;
    } elseif (strlen($name) > 100) {
        $_SESSION['name_err'] = "Name is too long.";
        $valid = false;
    }
}

// Validate Email
$email = trim($_POST["email"]);
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_err'] = "Valid email is required.";
    $valid = false;
}

// Validate Subject
if (empty(trim($_POST["subject"]))) {
    $_SESSION['subject_err'] = "Subject is required.";
    $valid = false;
} else {
    $subject = trim($_POST["subject"]);
}

// Validate Message
if (empty(trim($_POST["message"]))) {
    $_SESSION['message_err'] = "Message is required.";
    $valid = false;
} else {
    $message = trim($_POST["message"]);
}

// If any validation fails, redirect back to the form
if (!$valid) {
    $_SESSION['form_data'] = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ];
    header('Location: ../index.php#contact');
    exit;
}

try {
    $main->save_contact_message($name, $email, $subject, $message);
    $_SESSION['status'] = "Your message has been sent!";
    $_SESSION['status_icon'] = "success";
    header("Location: ../index.php#contact");
exit;
} catch (Exception $e) {
    $_SESSION['status'] = "Message could not be sent. Database error: {$e->getMessage()}";
    $_SESSION['status_icon'] = "error";
    header("Location: ../index.php#contact");
exit;
}

?>
