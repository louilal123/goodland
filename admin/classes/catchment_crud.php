<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['add_catchment'])) {
        $catchment_name = $_POST['catchment_name'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $catchment_img = $_POST['catchment_img'];

        $hasError = false;

           // Initialize variables
           $catchment_img = '';

           // Check if a file was uploaded
           if (isset($_FILES['catchment_img']) && $_FILES['catchment_img']['error'] === UPLOAD_ERR_OK) {
               $fileTmpPath = $_FILES['catchment_img']['tmp_name'];
               $fileName = $_FILES['catchment_img']['name'];
               $fileSize = $_FILES['catchment_img']['size'];
               $fileType = $_FILES['catchment_img']['type'];
   
               // Define a target directory and file path
               $uploadFileDir = '../uploads/';
               $dest_path = $uploadFileDir . $fileName;
   
               // Move the file to the target directory
               if (move_uploaded_file($fileTmpPath, $dest_path)) {
                   $catchment_img = $dest_path; // Store the file path to the database
               } else {
                   $_SESSION['error_catchment_img'] = "Error moving the uploaded file.";
               }
           } else {
               $_SESSION['error_catchment_img'] = "Catchment image is required.";
           }

        if (empty($catchment_name)) {
            $_SESSION['error_catchment_name'] = "Catchment name is required.";
            $hasError = true;
        }

        if (empty($description)) {
            $_SESSION['error_description'] = "Description is required.";
            $hasError = true;
        }

        if (empty($location)) {
            $_SESSION['error_location'] = "Location is required.";
            $hasError = true;
        }

        if ($hasError) {
            $_SESSION['form_data'] = $_POST;
            header('Location: ../manage_water_catchments.php#addItemModal');
            exit();
        }

        try {
            if ($mainClass->insert_catchment($catchment_name, $description, $location, $catchment_img)) {
                $_SESSION['status'] = "Catchment successfully added!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error adding catchment.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../manage_water_catchments.php');
        exit();
    }
     // Handle deletion
     if (isset($_POST['catchment_id'])) {
        $catchment_id = $_POST['catchment_id'];

        try {
            if ($mainClass->delete_catchment($catchment_id)) {
                $_SESSION['status'] = "Catchment successfully deleted!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error deleting catchment.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../manage_water_catchments.php');
        exit();
    }
}
?>
