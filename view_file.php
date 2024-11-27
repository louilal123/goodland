<?php
if (isset($_GET['file'])) {
    // Use 'admin/uploads/' as the base directory for files
    $file = __DIR__ . '/admin/uploads/' . basename($_GET['file']);
    
    if (file_exists($file)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
