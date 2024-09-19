<?php
session_start();
require_once 'Main_class.php';

$mainClass = new Main_class();

if (isset($_FILES['photo'])) {
    $id = $_SESSION['admin_id']; // Ensure admin ID is stored in session
    $photo = $_FILES['photo'];
    $photoName = basename($photo['name']);
    $photoPath = '../uploads/' . $photoName;

    if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
        $result = $mainClass->updateAdminPhoto($id, $photoName); // Store only the file name
        if ($result) {
            $_SESSION['status'] = "Photo updated successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error updating photo";
            $_SESSION['status_icon'] = "error";
        }
    } else {
        $_SESSION['status'] = "Failed to upload photo";
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../profile.php'); // Redirect to the profile page or wherever needed
    exit();
} else {
    $_SESSION['status'] = "No photo uploaded";
    $_SESSION['status_icon'] = "error";
    header('Location: ../profile.php'); // Redirect to the profile page or wherever needed
    exit();
}
?>
