<?php
session_start();
require_once __DIR__ . '/../../admin/classes/Main_class.php';
$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userId = $_SESSION['user_id'];

    $hasError = false;

    // Validate title
    if (empty($title)) {
        $_SESSION['error_title'] = "Title is required.";
        $hasError = true;
    }

    // Validate description
    if (empty($description)) {
        $_SESSION['error_description'] = "Description is required.";
        $hasError = true;
    }

    // Initialize paths for both cover and file
    $coverPath = '';
    $filePath = '';

    // Validate cover image
    if (!empty($_FILES['cover']['name'])) {
        $coverTmpPath = $_FILES['cover']['tmp_name'];
        $coverName = $_FILES['cover']['name'];
        $coverNameCmps = explode(".", $coverName);
        $coverExtension = strtolower(end($coverNameCmps));

        $allowedCoverExtensions = ['jpg', 'jpeg', 'png'];

        if (in_array($coverExtension, $allowedCoverExtensions)) {
            // Generate unique name for the cover image to prevent overwriting
            $coverNewName = uniqid('cover_', true) . '.' . $coverExtension;
            $coverPath = __DIR__ . '/../uploads/' . $coverNewName;

            // Move the cover image to the uploads folder
            if (!move_uploaded_file($coverTmpPath, $coverPath)) {
                $_SESSION['error_cover'] = "Error moving cover image.";
                $hasError = true;
            } else {
                // Update coverPath to be relative for saving in the database
                $coverPath = 'uploads/' . $coverNewName;
            }
        } else {
            $_SESSION['error_cover'] = "Cover image type not allowed.";
            $hasError = true;
        }
    } else {
        $_SESSION['error_cover'] = "Cover image is required.";
        $hasError = true;
    }

    // Validate file
    if (!empty($_FILES['file']['name'])) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedFileExtensions = ['pdf', 'txt'];

        if (in_array($fileExtension, $allowedFileExtensions)) {
            // Generate unique name for the file to prevent overwriting
            $fileNewName = uniqid('file_', true) . '.' . $fileExtension;
            $filePath = __DIR__ . '/../uploads/' . $fileNewName;

            // Move the file to the uploads folder
            if (!move_uploaded_file($fileTmpPath, $filePath)) {
                $_SESSION['error_file'] = "Error moving file.";
                $hasError = true;
            } else {
                // Update filePath to be relative for saving in the database
                $filePath = 'uploads/' . $fileNewName;
            }
        } else {
            $_SESSION['error_file'] = "File type not allowed.";
            $hasError = true;
        }
    } else {
        $_SESSION['error_file'] = "File is required.";
        $hasError = true;
    }

    // If errors, redirect back with form data
    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../upload_file.php');
        exit();
    } else {
        // Save file and cover image paths in the database
        $mainClass->saveFileInfo($userId, $title, $description, $coverPath, $filePath);

        unset($_SESSION['form_data']);
        $_SESSION['status'] = "File successfully uploaded!";
        $_SESSION['status_icon'] = "success";
        header('Location: ../upload_file.php');
        exit();
    }
}
?>
