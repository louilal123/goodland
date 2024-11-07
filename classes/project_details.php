<?php
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

if (isset($_GET['project_id'])) {
    $projectId = $_GET['project_id'];
    $projectDetails = $mainClass->getProjectById($projectId);

    if ($projectDetails) {
        // Project details from the first row
        $project = $projectDetails[0];
    }
}
        ?>