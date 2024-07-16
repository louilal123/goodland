<?php

require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$userId = $_SESSION['user_id']; // Assuming you have the user ID in the session
$fileType = 'Documents';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

$mainClass = new MainClass(); // Assuming you have your main clas

$documents = $mainClass->get_user_documents($userId, $fileType, $statusFilter, $searchQuery);

header('Content-Type: application/json');
echo json_encode([
    'totalDocuments' => count($documents),
    'documents' => $documents
]);
