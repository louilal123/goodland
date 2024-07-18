<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$main = new Main_class();

$file_id = isset($_POST['file_id']) ? intval($_POST['file_id']) : 0;
$file_path = isset($_POST['file_path']) ? $_POST['file_path'] : '';
$file_name = isset($_POST['file_name']) ? $_POST['file_name'] : '';
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;

if ($file_id > 0 && $file_path && $file_name) {
    $main->recordDownload($file_id, $user_id);
    header('Location: library.php/' . $file_path);
    exit;
}
?>
