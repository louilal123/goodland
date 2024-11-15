<?php
// header('Content-Type: application/json');
include_once 'Main_class.php';


// Check if visitor_id is provided
if (isset($_GET['visitor_id'])) {
    $visitorId = $_GET['visitor_id'];

    // Create an instance of your class and fetch the sessions
    $visitor = new Visitor(); // Replace with your class name
    $sessions = $visitor->getSessionsByVisitorId($visitorId);

    // Return the sessions as JSON
    echo json_encode($sessions);
}
?>

