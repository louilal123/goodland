<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; 
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
  
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];

    $hasError = false;

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format.";
        $_SESSION['status_icon'] = "error";
        $hasError = true;
    } elseif ($mainClass->is_email_exists_except_user($email, $userId)) {
        $_SESSION['status'] = "Email already exists.";
        $_SESSION['status_icon'] = "error";
        $hasError = true;
    }

    // Validate username
    if ($mainClass->is_username_exists_except_user($username, $userId)) {
        $_SESSION['status'] = "Username already exists.";
        $_SESSION['status_icon'] = "error";
        $hasError = true;
    }

    if ($hasError) {
        header('Location: ../profile.php');
        exit();
    }

    $result = $mainClass->update_user_profile($userId, $fullname, $username, $email, $address, $birthday);

    if ($result) {
        $_SESSION['status'] = "Profile updated successfully.";
        $_SESSION['status_icon'] = "success";
        $_SESSION['user_fullname'] = $fullname;
        $_SESSION['user_username'] = $username;
        $_SESSION['user_email'] = $email;
       
        $_SESSION['user_address'] = $address;
        $_SESSION['user_birthday'] = $birthday;
    } else {
        $_SESSION['status'] = "Error updating profile.";
        $_SESSION['status_icon'] = "error";
    }

    header('Location: ../profile.php');
    exit();
}
?>
