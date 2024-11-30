<?php
session_start(); // Start the session

require_once('Main_class.php'); 
$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize POST data
    $project_id = trim($_POST['project_id']);
    $title = trim($_POST['project_name']);
    $header = trim($_POST['project_header']);
    $summary = trim($_POST['project_description']);
    $banner_quote = trim($_POST['project_quotation']);
    $youtube_link = trim($_POST['youtube_link']);
    $current_image_path = trim($_POST['current_project_image']); // Current image

    // Validation: Check if required fields are empty
    if (empty($title) || empty($header) || empty($summary) || empty($banner_quote)) {
        $_SESSION['status'] = "All fields are required. Please fill in all fields.";
        $_SESSION['status_icon'] = "error";
        header('Location: ../projects.php'); 
        exit();
    }

    // Handle image upload
    $image_path = $current_image_path; // Default to current image path
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../../projects/";
        $image_name = basename($_FILES["project_image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Check for valid file upload
        if (move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file)) {
            $image_path = "projects/" . $image_name; // Update image path if successful
        } else {
            $_SESSION['status'] = "Error uploading the project image. Please try again.";
            $_SESSION['status_icon'] = "error";
            header('Location: ../projects.php');
            exit();
        }
    }

    // Update project in the database
    try {
        $rows_affected = $mainClass->editProject(
            $project_id,
            $title,
            $header,
            $image_path,
            $summary,
            $banner_quote,
            $youtube_link
        );

        if ($rows_affected > 0) {
            $_SESSION['status'] = "Project updated successfully!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "No changes were made to the project.";
            $_SESSION['status_icon'] = "info";
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "An error occurred while updating the project: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
    }

    header('Location: ../projects.php');
    exit();
}
?>
