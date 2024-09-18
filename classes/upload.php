<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

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
            'Documents' => ['pdf'],
            'Images' => ['jpg', 'jpeg', 'png'],
            'Arts' => ['jpg', 'jpeg', 'png'],
            'Audio' => ['mp3'],
            'Maps' => ['jpg', 'jpeg', 'png']
        ];

     
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
