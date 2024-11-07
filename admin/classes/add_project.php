<?php
session_start(); // Start the session at the top of the file

require_once('Main_class.php'); // Adjust path as needed
$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Existing project fields
    $title = $_POST['project_name'];
    $header = $_POST['project_header'];
    $summary = $_POST['project_description'];
    $banner_quote = $_POST['project_quotation'];
    $youtube_link = $_POST['youtube_link'];

    // Handle project image
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] == 0) {
        $target_dir = "../../projects/"; 
        $image_name = basename($_FILES["project_image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file)) {
            $image_path = "projects/" . $image_name; 

            // Insert project
            $project_id = $mainClass->addProject($title, $header, $image_path, $summary, $banner_quote, $youtube_link);

            // Handle sections
            if (isset($_POST['content_type']) && isset($_POST['content'])) {
                foreach ($_POST['content_type'] as $index => $content_type) {
                    $order = $index + 1; // Order of the section
                    
                    if ($content_type == 'text') {
                        // For text content, just save the text
                        $content = $_POST['content'][$index];
                        $mainClass->addProjectSection($project_id, 'text', $content, $order);
                    } elseif ($content_type == 'image') {
                        // For image content, handle the file upload
                        if (isset($_FILES['images']['name'][$index]) && $_FILES['images']['error'][$index] == 0) {
                            $section_image_name = basename($_FILES['images']['name'][$index]);
                            $section_target_file = $target_dir . $section_image_name;

                            if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $section_target_file)) {
                                $section_image_path = "projects/" . $section_image_name;
                                $mainClass->addProjectSection($project_id, 'image', $section_image_path, $order);
                            } else {
                                echo "Error uploading image for section $order.";
                            }
                        }
                    }
                }
            }

            // Set the SweetAlert session variables
            $_SESSION['status'] = "Project added successfully!";
            $_SESSION['status_icon'] = "success";
            header('Location: ../projects.php'); // Redirect to another page
            exit();
        } else {
            echo "Sorry, there was an error uploading the project image.";
        }
    } else {
        echo "Please upload a project image.";
    }
}
?>
