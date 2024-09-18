<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_document'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publication_date = $_POST['publication_date'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $uploaded_by = $_SESSION['admin_id']; 
        $status = 'draft'; 
        $hasError = false;

        if (empty($title)) {
            $_SESSION['error_title'] = "Title is required.";
            $hasError = true;
        }

        $coverPath = null;
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $coverTmpPath = $_FILES['cover']['tmp_name'];
            $coverName = $_FILES['cover']['name'];
            $coverExtension = strtolower(pathinfo($coverName, PATHINFO_EXTENSION));
            $allowedCoverExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($coverExtension, $allowedCoverExtensions)) {
                $uploadDir = '../uploads/cover/';
                $coverDestPath = $uploadDir . $coverName;

                if (move_uploaded_file($coverTmpPath, $coverDestPath)) {
                    $coverPath = $coverName;
                } else {
                    $_SESSION['status'] = "Error moving the uploaded cover image.";
                    $_SESSION['status_icon'] = "error";
                    $hasError = true;
                }
            } else {
                $_SESSION['status'] = "Invalid cover file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                $_SESSION['status_icon'] = "error";
                $hasError = true;
            }
        }

        $filePath = null;
        if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['document_file']['tmp_name'];
            $fileName = $_FILES['document_file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedFileExtensions = ['pdf', 'zip'];

            if (in_array($fileExtension, $allowedFileExtensions)) {
                $uploadDir = '../uploads/documents/';
                $fileDestPath = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $fileDestPath)) {
                    $filePath = $fileName;
                } else {
                    $_SESSION['status'] = "Error moving the uploaded document.";
                    $_SESSION['status_icon'] = "error";
                    $hasError = true;
                }
            } else {
                $_SESSION['status'] = "Invalid document file type. Only PDF and ZIP files are allowed.";
                $_SESSION['status_icon'] = "error";
                $hasError = true;
            }
        } else {
            $_SESSION['error_document_file'] = "Document file is required.";
            $hasError = true;
        }
        if ($hasError) {
            $_SESSION['form_data'] = $_POST;
            header('Location: ../managedocuments.php#addDocumentModal');
            exit();
        }
        try {
            if ($mainClass->add_document($title, $coverPath, $filePath, $author, $publication_date, $category, $description, $uploaded_by, $status)) {
                $_SESSION['status'] = "Document successfully added!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error adding document.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../managedocuments.php');
        exit();
    }
}
?>
