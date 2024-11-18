<?php
session_start();
require_once 'Main_class.php'; // Include the class file

// Check if event ID is passed
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventId = $_GET['id'];

    // Instantiate the Main_class and delete the event
    $mainClass = new Main_class();
    
    // Call the deleteEvent method
    $deleted = $mainClass->deleteEvent($eventId);

    // Check if the deletion was successful
    if ($deleted) {
        $_SESSION['status'] = "Event deleted successfully.";
        $_SESSION['status_icon'] = "success";
        header('Location: ../events.php');
        exit();
    } else {
        $_SESSION['status'] = "Error deleting event.";
        $_SESSION['status_icon'] = "error";
        header('Location: ../events.php');
        exit();
    }
} else {
    $_SESSION['status'] = "Event does not exist.";
        $_SESSION['status_icon'] = "error";
    header('Location: ../events.php');
    exit();
}
?>
