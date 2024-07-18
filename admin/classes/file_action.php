<?php
session_start();
require_once 'Main_class.php';

$mainClass = new Main_class();

if (isset($_POST['file_id'])) {
    $file_id = $_POST['file_id'];
    $remarks = $_POST['remarks'];

    if (isset($_POST['approveBtn'])) {
        $result = $mainClass->approveFile($file_id, $remarks);
        if ($result) {
            $_SESSION['status'] = "File approved successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error approving file";
            $_SESSION['status_icon'] = "error";
        }
    } elseif (isset($_POST['declineBtn'])) {
        $result = $mainClass->declineFile($file_id, $remarks);
        if ($result) {
            $_SESSION['status'] = "File declined successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error declining file";
            $_SESSION['status_icon'] = "error";
        }
    } else {
        $_SESSION['status'] = "Invalid action";
        $_SESSION['status_icon'] = "error";
    }
} else {
    $_SESSION['status'] = "Missing parameters";
    $_SESSION['status_icon'] = "error";
}

header('Location: ../pending_files.php');
exit();
?>
