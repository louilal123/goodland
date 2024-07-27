<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_photo'];
        $fileName = $_SESSION['user_id'] . '-' . basename($file['name']);
        $filePath = __DIR__ . '/../uploads/' . $fileName;

        // Create upload directory if it doesn't exist
        if (!file_exists(__DIR__ . '/../uploads/')) {
            mkdir(__DIR__ . '/../uploads/', 0777, true);
        }

        $uploadSuccess = move_uploaded_file($file['tmp_name'], $filePath);

        if ($uploadSuccess) {
            // Update the user's photo in the database
            $updateSuccess = $mainClass->update_user_photo($_SESSION['user_id'], $fileName);

            if ($updateSuccess) {
                // Update session variable
                $_SESSION['user_photo'] = $fileName; // only the file name
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
    } else {
        $_SESSION['status'] = "No file uploaded or there was an upload error.";
        $_SESSION['status_icon'] = "error";
    }

    header('Location: ../profile.php'); // Redirect to the profile page
    exit();
}
?>
