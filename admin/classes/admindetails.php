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

// Output JSON for FullCalendar
// header('Content-Type: application/json');
// echo json_encode($calendarEvents);


// $documents = $mainClass->get_all_documents();

$mainClass->updateEventStatus();
// notifications msgs 
$unread_msgs_count = $mainClass->get_unread_message_count();
$unread_msgs = $mainClass->get_unread_messages();
// end 
// projects 
$projects = $mainClass->getAllProjects(); 
$projectsCount = $mainClass->countAllProjects();

// Fetch the pie chart data  pie chart library files
$pieChartData = $mainClass->getStatusTypeData();

// $catchments = $mainClass->getAllCatchments();

// $catchments_count = $mainClass->countAllCatchments();

$events = $mainClass->get_all_events();
$events_count = $mainClass->count_all_events();

$visitors_count = $mainClass->countAllWebsiteVisitors();
$visitors = $mainClass->getAllVisitors();

// file requests start 
$request_count = $mainClass->getFileRequestsCount();
$pending_request = $mainClass->getAllFileRequests();//get pending

// $monthlyWaterLevels = $mainclass->getMonthlyAverageWaterLevel();
$monthlyData = $mainClass->getMonthlyData();

$data = $mainClass->getCatchmentData();
$visitorMonthlyData = $mainClass->getVisitorMonthlyData();
$totalReturningVisitors = $mainClass->getTotalReturningVisitors();

?>




