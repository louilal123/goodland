<?php
// Include database connection and class
include_once 'Main_class.php'; // Update with actual path

$visitorId = $_GET['visitor_id'] ?? null;
if ($visitorId) {
    $fileRequests = $yourClassInstance->getFileRequestsByVisitorId($visitorId);
    echo json_encode($fileRequests);
}
?>
