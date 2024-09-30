<?php
session_start(); 

if (!isset($_SESSION['user_id'])) {
   
    http_response_code(404); 
    include('../404.html'); 
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

$get_all_files = $mainClass->fetch_current_contributor_files($user_id);

$pending_files =$mainClass->fetch_contributor_pending_files($user_id);
$approved_files =$mainClass->fetch_contributor_approved_files($user_id);
$declined_files =$mainClass->fetch_contributor_declined_files($user_id);
$deleted_files =$mainClass->fetch_contributor_recently_deleted_files($user_id);

$recent_submissions = $mainClass->fetch_contributor_recent_submissions($user_id);


?>


