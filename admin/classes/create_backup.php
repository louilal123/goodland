<?php
session_start();
include_once '../classes/Main_class.php';

// Create an instance of the Main_class
$mainClass = new Main_class();

// Create the database backup
try {
    $mainClass->createBackup();

    $_SESSION['status'] = "Database backup created successfully!";
    $_SESSION['status_icon'] = "success";

} catch (Exception $e) {
    // Handle any errors during backup creation
    $_SESSION['status'] = "Error: " . $e->getMessage();
    $_SESSION['status_icon'] = "danger";
}

header("Location: ../systemsetting.php");
exit;
?>
