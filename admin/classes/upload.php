<?php
session_start();
require_once __DIR__ . '/../../admin/classes/Main_class.php';
$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $adminId = $_SESSION['admin_id'];

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
       // Validate description
       if (empty($status)) {
        $_SESSION['error_status'] = "Status is required.";
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
            $coverNewName = uniqid('cover_', true) . '.' . $coverExtension;
            $coverPath = __DIR__ . '/../uploads/' . $coverNewName;

            if (!move_uploaded_file($coverTmpPath, $coverPath)) {
                $_SESSION['error_cover'] = "Error moving cover image.";
                $hasError = true;
            } else {
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

    if (!empty($_FILES['file']['name'])) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedFileExtensions = ['pdf', 'txt'];

        if (in_array($fileExtension, $allowedFileExtensions)) {
            $fileNewName = uniqid('file_', true) . '.' . $fileExtension;
            $filePath = __DIR__ . '/../uploads/' . $fileNewName;
            if (!move_uploaded_file($fileTmpPath, $filePath)) {
                $_SESSION['error_file'] = "Error moving file.";
                $hasError = true;
            } else {
                $filePath = $fileNewName;
            }
        } else {
            $_SESSION['error_file'] = "File type not allowed.";
            $hasError = true;
        }
    } else {
        $_SESSION['error_file'] = "File is required.";
        $hasError = true;
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../all_files.php#addItemModal');
        exit();
    } else {
        $mainClass->saveFileInfo($adminId, $title, $description, $filePath, $coverPath, $status);


        unset($_SESSION['form_data']);
        $_SESSION['status'] = "File successfully uploaded!";
        $_SESSION['status_icon'] = "success";
        header('Location: ../all_files.php');
        exit();
    }
    
}
?>
