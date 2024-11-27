<?php
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$mainClass->trackVisitor();

$projects = $mainClass->getAllPublishedProjects(); 

$approvedFiles = $mainClass->getPublishedFiles();

$upcoming_events =  $mainClass->fetchUpcomingEvents();

$ongoing_events =  $mainClass->fetchOngoingEvents();

$finished_events =  $mainClass->fetchFinishedEvents();


?>

