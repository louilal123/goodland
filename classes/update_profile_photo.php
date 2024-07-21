<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_photo'])) {
        $file = $_FILES['profile_photo'];
        $fileName = $_SESSION['user_id'] . '-' . basename($file['name']);
        $filePath = __DIR__ . '/../uploads/' . $fileName;
        $uploadSuccess = move_uploaded_file($file['tmp_name'], $filePath);

        if ($uploadSuccess) {
            // Update the user's photo in the database
            $updateSuccess = $mainClass->update_user_photo($_SESSION['user_id'], $fileName);

            if ($updateSuccess) {
                // Update session variable
                $_SESSION['user_user_photo'] = $fileName;
                
                $_SESSION['status'] = "Profile photo updated successfully!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Failed to update profile photo in the database.";
                $_SESSION['status_icon'] = "error";
            }
        } else {
            $_SESSION['status'] = "Failed to upload photo.";
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../profile.php'); // Redirect to the profile page
        exit();
    }
}
?>
