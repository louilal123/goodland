<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$visitor_id = $_SESSION['visitor_id'] ?? null; 
$file_id = $_POST['file_id'];
$email = $_POST['email'];

// add a validation for empty email input 
// add valiation for email Format


if ($visitor_id && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt = $mainClass->pdo->prepare("INSERT INTO file_requests (file_id, visitor_id, email, status) VALUES (?, ?, ?, 'pending')");
    $stmt->execute([$file_id, $visitor_id, $email]);
     
    $_SESSION['status'] = "File Requested successfully.";
    $_SESSION['status_icon'] = "success";
    header("Location: library.php");
    exit;
} else {
    $_SESSION['status'] = "File Requested successfully.";
    $_SESSION['status_icon'] = "success";
    header("Location: library.php");
    exit;
}
?>
