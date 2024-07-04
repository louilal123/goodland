<?php
require_once "Main_class.php";

$mainClass = new Main_class();
$takenDates = $mainClass->get_taken_event_dates();

echo json_encode($takenDates);
?>
