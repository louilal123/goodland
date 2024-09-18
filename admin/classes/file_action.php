<?php
session_start();
require_once 'Main_class.php';

$mainClass = new Main_class();

if (isset($_POST['file_id'])) {
    $file_id = $_POST['file_id'];
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : null; // Handle optional remarks

    if (isset($_POST['approveBtn'])) {
        $result = $mainClass->approveFile($file_id, $remarks);
        if ($result) {
            $_SESSION['status'] = "File approved successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error approving file";
            $_SESSION['status_icon'] = "error";
        }
        header('Location: ../pending_files.php');
        exit();
    } elseif (isset($_POST['declineBtn'])) {
        $result = $mainClass->declineFile($file_id, $remarks);
        if ($result) {
            $_SESSION['status'] = "File declined successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error declining file";
            $_SESSION['status_icon'] = "error";
        }
        header('Location: ../pending_files.php');
        exit();
    } elseif (isset($_POST['addToPendingBtn'])) {
        $result = $mainClass->addToPending($file_id, $remarks);
        if ($result) {
            $_SESSION['status'] = "File moved back to pending successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error moving the file";
            $_SESSION['status_icon'] = "error";
        }
        header('Location: ../approved_files.php');
        exit();
    } elseif (isset($_POST['recycleBtn'])) {
        $result = $mainClass->recycleFile($file_id);
        if ($result) {
            $_SESSION['status'] = "Declined file recycled successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error recycling the file";
            $_SESSION['status_icon'] = "error";
        }
        header('Location: ../declined_files.php');
        exit();
    } elseif (isset($_POST['restoreBtn'])) {
        $result = $mainClass->restoreFile($file_id);
        if ($result) {
            $_SESSION['status'] = "File restored successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error restoring the file";
            $_SESSION['status_icon'] = "error";
        }
        header('Location: ../recycled_files.php');
        exit();
    } elseif (isset($_POST['deleteBtn'])) {
        $result = $mainClass->deleteFile($file_id); // Assuming you have a method to delete a file
        if ($result) {
            $_SESSION['status'] = "File deleted successfully";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Error deleting the file";
            $_SESSION['status_icon'] = "error";
        }
        header('Location: ../recycled_files.php');
        exit();
    } else {
        $_SESSION['status'] = "Invalid action";
        $_SESSION['status_icon'] = "error";
        header('Location: ../pending_files.php');
        exit();
    }
} else {
    $_SESSION['status'] = "Missing file";
    $_SESSION['status_icon'] = "error";
    header('Location: ../pending_files.php');
    exit();
}
?>
