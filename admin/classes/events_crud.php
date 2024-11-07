<?php 
session_start();
require_once "Main_class.php";
$mainClass = new Main_class();

if (isset($_POST['add_event'])) {
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    // $event_date = $_POST['event_date'];  
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $location = $_POST['location'];
    $organizer = $_POST['organizer'];
    $photoPath = null;
    $hasError = false;

    // Validation
    if (empty($event_name)) {
        $_SESSION['error_event_name'] = "Event name is required.";
        $hasError = true;
    }
    if (empty($date_start)) {
        $_SESSION['error_date_start'] = "Start date is required.";
        $hasError = true;
    }

    if (empty($date_end)) {
        $_SESSION['error_date_end'] = "End date is required.";
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
    if ($photoPath === null) {
        $_SESSION['error_event_photo'] = "Event photo is required.";
    }
    
    if (empty($organizer)) {
        $_SESSION['error_organizer'] = "Organizer is required.";
        $hasError = true;
    }
 

    if ($hasError) {
        $_SESSION['form_data'] = $_POST;
        header('Location: ../events.php#addEventModal');
        exit();
    }

    $photoPath = null;
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
                header('Location: ../events.php#addEventModal');
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            $_SESSION['status_icon'] = "error";
            header('Location: ../events.php#addEventModal');
            exit();
        }
    }

    try {
        // Insert the event without category, organizer, or other fields not in the table
        if ($mainClass->insert_event($event_name, $description, $location, $photoPath, $date_start, $date_end, $organizer)) {
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

    header('Location: ../events.php');
    exit();
}
?>
