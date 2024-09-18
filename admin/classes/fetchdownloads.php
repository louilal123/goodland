<?php
require_once 'Main_class.php';

header('Content-Type: application/json');

$mainClass = new Main_class();

$currentMonth = date('m');
$currentYear = date('Y');

try {
    $signedInDownloads = $mainClass->getDownloadData($currentMonth, $currentYear, true);
    $nonSignedInDownloads = $mainClass->getDownloadData($currentMonth, $currentYear, false);

    echo json_encode([
        'signedInDownloads' => $signedInDownloads,
        'nonSignedInDownloads' => $nonSignedInDownloads
    ]);
} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
