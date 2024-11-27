<?php
require 'config.php'; // Include database connection

// Check if file ID is provided
if (isset($_GET['id'])) {
    $file_id = intval($_GET['id']); // Sanitize input

    // Fetch file details from the database
    $stmt = $pdo->prepare("SELECT file_path, title FROM studies WHERE id = ?");
    $stmt->execute([$file_id]);
    $file = $stmt->fetch();

    if ($file) {
        $file_path = __DIR__ . '/admin/' . $file['file_path']; // Construct secure path

        // Check if the file exists
        if (file_exists($file_path)) {
            // Serve the file
            header('Content-Type: application/pdf'); // Change MIME type as needed
            header('Content-Disposition: inline; filename="' . basename($file['file_path']) . '"');
            readfile($file_path);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Invalid file ID.";
    }
} else {
    echo "No file specified.";
}
?>
