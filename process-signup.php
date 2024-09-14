<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php'; 
$main = new Main_class();

// Validate input
if (empty($_POST["name"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

// Check if email already exists
if ($main->is_email_exists($_POST["email"])) {
    die("Email already taken");
}

$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);

// Call register_user function
if ($main->register_user($_POST["name"], $_POST["email"], $_POST["password"], $activation_token_hash)) {
    // Send activation email
    $mail = require __DIR__ . "/mailer.php";
    $mail->setFrom("rubinlouie41@gmail.com");
    $mail->addAddress($_POST["email"]);
    $mail->Subject = "Account Activation";
    $mail->Body = <<<END
      Click <a href="http://localhost/goodland/activate-account.php?token=$activation_token">
      Confirm Account.
      </a> to activate your account.


    END;

    try {
        $mail->send();
        header("Location: signup-success.php");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        exit;
    }
} else {
    die("Error registering user");
}

?>
