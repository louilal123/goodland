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

$mainClass->mark_all_messages_as_read();

//for table events
$events_list = $mainClass->get_all_events();


$adminDetails = $mainClass->getAdminDetails($admin_id);

$count_files = $mainClass->count_all_files();
//FILES
$all_files = $mainClass->all_files();
$published_files = $mainClass->get_all_published_files();

$messages = $mainClass->get_all_messages();
//table populate
$admins = $mainClass->get_all_admins();
$adminCount = $mainClass->count_all_admins();


$mainClass->updateEventStatus();
//  msgs 
$unread_msgs_count = $mainClass->get_unread_message_count();
$unread_msgs = $mainClass->get_unread_messages();

$unread_notifications = $mainClass->get_notifications();
$unread_notifications_count = $mainClass->get_unread_notifications_count();
// end 
// projects 
$projects = $mainClass->getAllProjects(); 
$projectsCount = $mainClass->countAllProjects();

// Fetch the pie chart data  pie chart library files
$pieChartData = $mainClass->getStatusTypeData();


$events = $mainClass->get_all_events();
$events_count = $mainClass->count_all_events();
$request_count = $mainClass->count_all_request();

$visitors_count = $mainClass->countAllWebsiteVisitors();
$visitors = $mainClass->getAllVisitors();


$visitorDailyData = $mainClass->getVisitorDailyData();

$totalReturningVisitors = $mainClass->getTotalReturningVisitors();

$settings = $mainClass->fetchSettings();
$backups = $mainClass->fetchBackups();

$loginLogs = $mainClass->get_login_logs_with_admin_info();

$requests = $mainClass->getFileRequests();
// $pending_request = $mainClass->getFileRequests();

?>




