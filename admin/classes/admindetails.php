<?php
session_start(); 

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
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
?>

