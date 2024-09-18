<?php
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin/");
    exit();
}

require_once '../admin/classes/Main_class.php';

$user_id = $_SESSION['user_id']; 
$mainClass = new Main_class();

$user_details = $mainClass->current_Loggedin_UserDetails($user_id);

// files cunt by the current user 
$fileCount = $mainClass->getUserFileCount($user_id);

$pending_file = $mainClass->getPendingFileCount($user_id);
$approved_file = $mainClass->getApprovedFileCount($user_id);
$declined_file = $mainClass->getDeclinedFileCount($user_id);


?>


