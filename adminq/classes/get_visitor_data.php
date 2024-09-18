<?php
require 'Main_class.php';

class VisitorData {
    private $mainClass;

    public function __construct() {
        $this->mainClass = new Main_class();
    }

    public function getVisitorData() {
        return $this->mainClass->getVisitorData();
    }
}

$visitorData = new VisitorData();
$data = $visitorData->getVisitorData();

// Convert the data to JSON and print it
header('Content-Type: application/json');
echo json_encode($data);
?>
