<?php 
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php'; 
$main = new Main_class();

// Validate input
if (empty($_POST["name"])) {
    $_SESSION['name_err'] = "Name is required.";
    header('Location: ../c-signup.php');
    exit;
}

if ($main->is_email_exists($_POST["email"])) {
    $_SESSION['status'] = "Email already taken.";
    $_SESSION['status_icon'] = "error";
    header('Location: ../c-signup.php');
    exit;
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_err'] = "Valid email is required.";
    header('Location: ../c-signup.php');
    exit;
}

if (strlen($_POST["password"]) < 8) {
    $_SESSION['password_err'] = "Password must be at least 8 characters.";
    header('Location: ../c-signup.php');
    exit;
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    $_SESSION['password_err'] = "Password must contain at least one letter.";
    header('Location: ../c-signup.php');
    exit;
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    $_SESSION['password_err'] = "Password must contain at least one number.";
    header('Location: ../c-signup.php');
    exit;
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $_SESSION['confirm_password_err'] = "Passwords must match.";
    header('Location: ../c-signup.php');
    exit;
}

$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);

// Generate a random username
$random_number = rand(10000, 99999);
$username = 'user_' . $random_number;

// Call register_user function and pass the username
if ($main->register_user($_POST["name"], $_POST["email"], $_POST["password"], $activation_token_hash, $username)) {
    // Send activation email
    $mail = require __DIR__ . "/../mailer.php";
    $mail->setFrom("your-email@example.com");
    $mail->addAddress($_POST["email"]);
    $mail->Subject = "Account Activation";
    $mail->Body = <<<END
      Click <a href="http://localhost/goodland/activate-account.php?token={$activation_token_hash}">
      Confirm Account.
      </a> to activate your account.
    END;

    try {
        $mail->send();
        header("Location: c-signup.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        $_SESSION['status_icon'] = "error";
        header("Location: ../c-signup.php");
        exit;
    }
} else {
    $_SESSION['status'] = "Error registering user";
    $_SESSION['status_icon'] = "error";
    header("Location: ../c-signup.php");
    exit;
}

?>
