<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$user_id = $_SESSION['user_id'];

if ($mainClass->markAllNotificationsAsRead($user_id)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
