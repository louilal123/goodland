<?php
session_start();
require_once __DIR__ . '/../../admin/classes/Main_class.php';
$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // File ID to be updated
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

    // Validate status
    if (empty($status)) {
        $_SESSION['error_status'] = "Status is required.";
        $hasError = true;
    }

    // Get the existing file and cover paths
    $existingCoverPath = $_POST['existingCover'];
    $existingFilePath = $_POST['existingFile'];

    // Initialize new paths for cover and file (if changed)
    $coverPath = $existingCoverPath;
    $filePath = $existingFilePath;

    // Handle new cover image upload
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
    }

    // Handle new file upload
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
                $filePath = 'uploads/' . $fileNewName;
            }
        } else {
            $_SESSION['error_file'] = "File type not allowed.";
            $hasError = true;
        }
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../all_files.php#editModal');
        exit();
    } else {
        // Save the updated file info to the database
        $mainClass->updateFileInfo($id, $adminId, $title, $description, $filePath, $coverPath, $status);

        // Redirect with success message
        $_SESSION['status'] = "File successfully updated!";
        $_SESSION['status_icon'] = "success";
        header('Location: ../all_files.php');
        exit();
    }
}
?>
