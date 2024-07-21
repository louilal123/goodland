<?php
// classes/update_bio.php
require_once __DIR__ . '/../admin/classes/Main_class.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bio = $_POST['bio'];
    $userId = $_SESSION['user_id']; 

    $mainClass = new Main_class();
    $result = $mainClass->updateBio($userId, $bio);

    if ($result) {
        $_SESSION['status'] = "Bio updated successfully.";
        $_SESSION['status_icon'] = "success";
        $_SESSION['user_bio'] = $bio;
    } else {
        $_SESSION['status'] = "Failed to update bio.";
        $_SESSION['status_icon'] = "error";
    }

    header("Location: ../profile.php"); 
    exit;
}
?>
