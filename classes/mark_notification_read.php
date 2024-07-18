<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

if ($mainClass->markNotificationAsRead($id)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>

