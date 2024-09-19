<?php
session_start(); 

if (!isset($_SESSION['admin_id'])) {

    http_response_code(404); // Set the 404 status code
    include('../404.html'); // Include the 404 page content
    exit();
}

require_once 'Main_class.php';

$admin_id = $_SESSION['admin_id']; 
$mainClass = new Main_class();



$adminDetails = $mainClass->getAdminDetails($admin_id);

$count_files = $mainClass->count_all_files();
//FILES
$approved_files = $mainClass->get_all_approved_files();
$count_approved_files = $mainClass->count_all_approved_files();

$pending_files = $mainClass->get_all_pending_files();
$count_pending_files = $mainClass->count_all_pending_files();

$declined_files = $mainClass->get_all_declined_files();
$count_declined_files = $mainClass->count_all_declined_files();


$recycled_files = $mainClass->get_all_recycled_files();
$count_recycled_files = $mainClass->count_all_recycled_files();


//table populate
$admins = $mainClass->get_all_admins();
$adminCount = $mainClass->count_all_admins();

$members = $mainClass->get_all_members();
$memberCount = $mainClass->count_all_members();

$events = $mainClass->get_all_events();

$registeredUsersCount = $mainClass->count_registered_users();
$registeredUsers =$mainClass->get_all_registeredUsers();

$documents = $mainClass->get_all_documents();

$uploadedDocumentsCount =$mainClass->count_all_documents();
$downloadsCount = $mainClass->count_downloads();

// total visitors count 
$uniqueVisitorCount = $mainClass->get_unique_visitor_count();

$visitors = $mainClass->getVisitors();

$downloads =$mainClass->getDownloads();
//chart data
$chartData = $mainClass->getVisitorData();
// header('Content-Type: application/json');
return json_encode($chartData);
//end 
// pie chart data 
// Fetch data for the charts
$pieChartData = $mainClass->getFileTypeData();

// Encode the data as JSON for use in JavaScript
return json_encode($pieChartData);


?>

