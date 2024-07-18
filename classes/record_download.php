<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$file_id = isset($_POST['file_id']) ? intval($_POST['file_id']) : 0;
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;

if ($file_id > 0) {
    $mainClass->recordDownload($file_id, $user_id);
}
?>
