<?php
// require_once('geoplugin/geoplugin.class.php');
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

// user tracking 
$mainClass->trackVisitor();
//end
$projects = $mainClass->getAllPublishedProjects(); 

$approvedFiles = $mainClass->getPublishedFiles();
// $catchments = $mainClass->getAllCatchments();
$monthlyData = $mainClass->getMonthlyData();
$dailyData = $mainClass->getDailyData();
$hourlyData = $mainClass->getHourlyData();

$upcoming_events =  $mainClass->fetchUpcomingEvents();

$ongoing_events =  $mainClass->fetchOngoingEvents();

$finished_events =  $mainClass->fetchFinishedEvents();
// $ongoing
// $scheduledEvents = $mainClass->getScheduledEvents();
// $ongoingEvents = $mainClass->getOngoingEvents();
// $finishedEvents = $mainClass->getFinishedEvents();

?>

