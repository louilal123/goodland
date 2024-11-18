<?php
session_start();
require_once "Main_class.php";
$mainClass = new Main_class();

if (isset($_POST['edit_event'])) {
    // Retrieve the form data
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $organizer = $_POST['organizer'];
    $photoPath = null;
    $hasError = false;

    // Validation checks
    if (empty($event_name)) {
        $_SESSION['error_event_name'] = "Event name is required.";
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

    if (empty($start_date)) {
        $_SESSION['error_start_date'] = "Start date is required.";
        $hasError = true;
    }

    if (empty($end_date)) {
        $_SESSION['error_end_date'] = "End date is required.";
        $hasError = true;
    }

    if (empty($organizer)) {
        $_SESSION['error_organizer'] = "Organizer is required.";
        $hasError = true;
    }

    // If there are errors, redirect to the edit modal with form data and error messages
    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        $_SESSION['photo_path'] = $photoPath; // Retain photo path if any
        header('Location: ../events.php#editModal');
        exit();
    }

    // File upload handling
    if (isset($_FILES['event_photo']) && $_FILES['event_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['event_photo']['tmp_name'];
        $fileName = $_FILES['event_photo']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../uploads/';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photoPath = 'uploads/' . $newFileName;
            } else {
                $_SESSION['status'] = "Error moving the uploaded file.";
                $_SESSION['status_icon'] = "error";
                header('Location: ../events.php#editModal');
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            $_SESSION['status_icon'] = "error";
            header('Location: ../events.php#editModal');
            exit();
        }
    } else {
        // If no new photo was uploaded, keep the old one (if exists)
        if (empty($photoPath) && isset($_SESSION['photo_path'])) {
            $photoPath = $_SESSION['photo_path'];
        }
    }

    try {
        // Call the update method (ensure the method is created in Main_class)
        if ($mainClass->update_event($event_id, $event_name, $description, $location, $photoPath, $start_date, $end_date, $organizer)) {
            $_SESSION['status'] = "Event successfully updated!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error updating event.";
            $_SESSION['status_icon'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "Error: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
    }

    // Redirect to the events page
    header('Location: ../events.php');
    exit();
}

?>
