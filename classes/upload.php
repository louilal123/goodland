<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file_type = $_POST['file_type'];
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

    // Validate file type
    if (empty($file_type)) {
        $_SESSION['error_file_type'] = "File type is required.";
        $hasError = true;
    }

    // Validate file
    if (empty($_FILES['file']['name'])) {
        $_SESSION['error_file'] = "File is required.";
        $hasError = true;
    } else {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = [
            'Documents' => ['pdf', 'doc', 'docx', 'xls', 'xlsx'],
            'Images' => ['jpg', 'jpeg', 'png', 'gif'],
            'Audio' => ['mp3'],
            'Maps' => ['zip', 'rar'],
            'Arts' => ['jpg', 'jpeg', 'png', 'gif']
        ];

        if (!array_key_exists($file_type, $allowedExtensions) || !in_array($fileExtension, $allowedExtensions[$file_type])) {
            $_SESSION['error_file'] = "Invalid file type for selected file type.";
            $hasError = true;
        } else {
            $uploadFileDir = '../uploads/';
            $destPath = $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                if (!$mainClass->saveFileInfo($userId, $title, $description, $file_type, $fileName, $destPath)) {
                    $_SESSION['error_file'] = "Error saving file information.";
                    $hasError = true;
                }
            } else {
                $_SESSION['error_file'] = "Error moving the uploaded file.";
                $hasError = true;
            }
        }
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../upload_file.php');
        exit();
    } else {
        unset($_SESSION['form_data']);
        $_SESSION['status'] = "File successfully uploaded!";
        $_SESSION['status_icon'] = "success";
        header('Location: ../upload_file.php');
        exit();
    }
}
?>
