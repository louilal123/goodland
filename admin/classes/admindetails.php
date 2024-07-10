<?php
session_start(); 

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../error/index.php");
    exit();
}

require_once 'Main_class.php';

$admin_id = $_SESSION['admin_id']; // Retrieve admin_id from session
$mainClass = new Main_class();

// specific admin currenly login 
$adminDetails = $mainClass->getAdminDetails($admin_id);

//table populate
$admins = $mainClass->get_all_admins();
$adminCount = $mainClass->count_all_admins();

$members = $mainClass->get_all_members();
$memberCount = $mainClass->count_all_members();

$events = $mainClass->get_all_events();

$registeredUsersCount = $mainClass->count_registered_users();

$documents = $mainClass->get_all_documents();

?>

