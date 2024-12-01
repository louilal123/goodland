<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

// Fetch all unread notifications
$notifications = $mainClass->get_unread_notifications(); 

// Get the count of unread notifications
$unread_notifications_count = $mainClass->get_unread_notification_count();

// Return notifications and count as JSON
echo json_encode([
    'notifications' => $notifications,
    'unread_notifications_count' => $unread_notifications_count
]);
?>
