<?php
session_start();
require_once "Main_class.php";
$mainClass = new Main_class();


if (isset($_POST['add_event'])) {
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $organizer = $_POST['organizer'];

    $hasError = false;

    if (empty($event_name)) {
        $_SESSION['error_event_name'] = "Event name is required.";
        $hasError = true;
    }

    if (empty($description)) {
        $_SESSION['error_description'] = "Description is required.";
        $hasError = true;
    }

    if (empty($event_date)) {
        $_SESSION['error_event_date'] = "Event date is required.";
        $hasError = true;
    }

    if (empty($location)) {
        $_SESSION['error_location'] = "Location is required.";
        $hasError = true;
    }
    if (empty($organizer)) {
        $_SESSION['error_organizer'] = "Organizer is required.";
        $hasError = true;
    }

    if ($mainClass->is_event_date_exists($event_date)) {
        $_SESSION['error_event_date'] = "An event is already scheduled for this date.";
        $hasError = true;
    }

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../manageevents.php#addEventModal');
        exit();
    }

    $photoPath = null;
    if (isset($_FILES['event_photo']) && $_FILES['event_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['event_photo']['tmp_name'];
        $fileName = $_FILES['event_photo']['name'];
        $fileSize = $_FILES['event_photo']['size'];
        $fileType = $_FILES['event_photo']['type'];
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
                header('Location: ../manageevents.php#addEventModal');
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            $_SESSION['status_icon'] = "error";
            header('Location: ../manageevents.php#addEventModal');
            exit();
        }
    }

    try {
        if ($mainClass->insert_event($event_name, $description, $event_date, $location, $photoPath, $status, $category, $organizer)) {
            $_SESSION['status'] = "Event successfully added!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error adding event.";
            $_SESSION['status_icon'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "Error: " . $e->getMessage();
        $_SESSION['status_icon'] = "error";
    }

    header('Location: ../manageevents.php');
    exit();
}

?>