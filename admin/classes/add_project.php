<?php
session_start(); // Start the session at the top of the file

require_once('Main_class.php'); // Adjust path as needed
$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and validate inputs
    $title = trim($_POST['project_name']);
    $header = trim($_POST['project_header']);
    $summary = trim($_POST['project_description']);
    $banner_quote = trim($_POST['project_quotation']);
    $youtube_link = trim($_POST['youtube_link']);

    // Check if required fields are empty
    if (empty($title) || empty($header) || empty($summary) || empty($banner_quote) || empty($_FILES['project_image']['name'])) {
        $_SESSION['status'] = "All fields are required, please fill in all fields.";
        $_SESSION['status_icon'] = "error";
        header('Location: projects.php'); // Redirect back to the add project page with error message
        exit();
    }

    // Handle project image upload
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] == 0) {
        $target_dir = "../../projects/"; 
        $image_name = basename($_FILES["project_image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file)) {
            $image_path = "projects/" . $image_name; 

            // Insert project into the database
            $project_id = $mainClass->addProject($title, $header, $image_path, $summary, $banner_quote, $youtube_link);

            // Set the SweetAlert session variables for success
            $_SESSION['status'] = "Project added successfully!";
            $_SESSION['status_icon'] = "success";
            header('Location: ../projects.php'); // Redirect to the projects list page
            exit();
        } else {
            $_SESSION['status'] = "Sorry, there was an error uploading the project image.";
            $_SESSION['status_icon'] = "error";
            header('Location: projects.php'); // Stay on the add page
            exit();
        }
    } else {
        $_SESSION['status'] = "Please upload a project image.";
        $_SESSION['status_icon'] = "error";
        header('Location: projects.php'); // Stay on the add page
        exit();
    }
}
?>
