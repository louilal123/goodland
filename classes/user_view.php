<?php
// session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();


$members = $mainClass->get_all_members();

?>

