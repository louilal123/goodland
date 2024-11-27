<?php
session_start();
require_once 'Main_class.php';

if (isset($_GET['id'])) {
    $backupId = $_GET['id'];

    // Initialize the Main_class object
    $mainClass = new Main_class();

    // Call the deleteBackup method for deleting the file
    if ($mainClass->deleteBackup($backupId)) {
        $_SESSION['status'] = "Backup successfully deleted!";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting backup.";
        $_SESSION['status_icon'] = "error";
    }
    header("Location: ../systemsetting.php");
    exit;
}
?>
