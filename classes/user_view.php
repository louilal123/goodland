<?php

require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();


$members = $mainClass->get_all_members();

$documents = $mainClass->get_all_documents();

$fileTypes = $mainClass->get_file_types();
// Track the visitor
// $mainClass->trackVisitor();


?>

