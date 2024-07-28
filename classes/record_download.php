<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['file_id']) && isset($_POST['file_path'])) {
        $file_id = intval($_POST['file_id']);
        $file_path = $_POST['file_path']; // This should be relative to the document root
        $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;

        $mainClass = new Main_class(); // Make sure to use the correct class name
        
        // Check if the record already exists for logged-in users
        if ($user_id !== null) {
            if (!$mainClass->isDownloadRecorded($file_id, $user_id)) {
                // Insert the new record if it does not exist
                $mainClass->recordDownload($file_id, $user_id);
            }
        } else {
            // Insert the new record with null user_id for non-logged-in users
            $mainClass->recordDownload($file_id, $user_id);
        }
        
        // Determine the absolute path of the file
        $absolute_path = __DIR__ . '/../' . $file_path;

        // Check if file exists
        if (file_exists($absolute_path)) {
            // Start the file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($absolute_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($absolute_path));

            readfile($absolute_path);
            exit;
        } else {
            $_SESSION['status'] = "Error: File does not exist.";
            $_SESSION['status_icon'] = "error";
        }
    } else {
        $_SESSION['status'] = "Error: File ID or File Path is not set.";
        $_SESSION['status_icon'] = "error";
    }

    // Redirect back to library or some other page
    header('Location: ../library.php');
    exit();
}
?>
