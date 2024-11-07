<?php
require_once 'Main_class.php';
$mainClass = new Main_class();
// $mainClass = new Main_class();
$events = $mainClass->getEvents();

// Format events for FullCalendar
$calendarEvents = array_map(function($event) {
    return [
        'id' => $event['event_id'],
        'title' => $event['event_name'],
        'start' => $event['date_start'],
        'end' => $event['date_end'],
        'description' => $event['description'],
        'location' => $event['location'],
        'photo' => $event['event_photo']
    ];
}, $events);

// Return events as JSON
header('Content-Type: application/json');
echo json_encode($calendarEvents);
exit();

?>
