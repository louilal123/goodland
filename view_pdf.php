<?php
if (isset($_GET['file_path'])) {
    $file_path = 'uploads/' . htmlspecialchars($_GET['file_path']);
    if (file_exists($file_path)) {
        header("Content-Type: application/pdf");
        readfile($file_path);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
