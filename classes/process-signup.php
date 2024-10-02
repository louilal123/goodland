<?php 
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php'; 
$main = new Main_class();

$name = $email = $password = $password_confirmation = "";
$valid = true;

// $country_flag = "ph"; 

// require_once  __DIR__ . '/../geoplugin/geoplugin.class.php';
$geoplugin = new geoPlugin();
        
$ip = $_SERVER['REMOTE_ADDR'];
if ($ip == '127.0.0.1' || $ip == '::1') {
    $ip = '112.198.194.108';
}
$geoplugin->locate($ip);
$city = $geoplugin->city;
$region = $geoplugin->region;
$country = $geoplugin->countryCode;
$country_flag = $country;
// end 

// Validate input
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

// Validate email
$email = trim($_POST["email"]);
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_err'] = "Valid email is required.";
    $valid = false;
} elseif ($main->is_email_exists($email)) {
    $_SESSION['status'] = "Email already taken. Please Login with your account";
    $_SESSION['status_icon'] = "error";
    header('Location: ../c-signup.php');
    exit;
}

// Validate password
$password = $_POST["password"];
if (empty($password)) {
    $_SESSION['password_err'] = "Password is required.";
    $valid = false;
} elseif (strlen($password) < 8) {
    $_SESSION['password_err'] = "Password must be at least 8 characters.";
    $valid = false;
} elseif (!preg_match("/[a-zA-Z]/", $password)) {
    $_SESSION['password_err'] = "Password must contain at least one letter.";
    $valid = false;
} elseif (!preg_match("/[0-9]/", $password)) {
    $_SESSION['password_err'] = "Password must contain at least one number.";
    $valid = false;
}

// Validate password confirmation
$password_confirmation = $_POST["password_confirmation"];
if(empty($password_confirmation)){
    $_SESSION['confirm_password_err'] = "Confirm Password is required.";
    $valid = false;
} elseif ($password !== $password_confirmation) {
    $_SESSION['confirm_password_err'] = "Passwords must match.";
    $valid = false;
}

// If any validation failed, redirect back
if (!$valid) {
    $_SESSION['form_data'] = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password_confirmation
    ];
    header('Location: ../c-signup.php');
    exit;
}

$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);
$random_number = rand(10000, 99999);
$username = 'user_' . $random_number;

if ($main->register_user($name, $email, $password, $activation_token_hash, $username, $country_flag)) {
     $mail = require __DIR__ . "/../mailer.php";
     $mail->setFrom("rubinlouie41@gmail.com");
     $mail->addAddress($email); 
     $mail->Subject = "Account Activation";
     $mail->Body = <<<END
       Click <a href="http://localhost/goodland/activate-account.php?token={$activation_token_hash}">
       Confirm your email. You received this message because you provided a legitimate email.
       </a> to activate your account.
     END;
 
     try {
         $mail->send();
         header("Location: ../c-login.php");
         exit;
     } catch (Exception $e) {
         $_SESSION['status'] = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
         $_SESSION['status_icon'] = "error";
         header("Location: ../c-signup.php");
         exit;
     }
} else {
    // signup fails 
    $_SESSION['status'] = "The admins will now verify your signup application. ";
    $_SESSION['status_icon'] = "success";
    header('Location: ../c-signup.php');
    exit;
}
?>
