<?php
session_start();
require_once __DIR__ . '/../classes/Main_class.php';
$main = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request is to delete a specific message
    if (!empty($_POST['delete_message_id'])) {
        $messageId = $_POST['delete_message_id'];
        try {
            $main->delete_message($messageId);
            $_SESSION['status'] = "Message deleted successfully!";
            $_SESSION['status_icon'] = "success";
            header("Location: ../messages.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['status'] = "Error: Could not delete the message. {$e->getMessage()}";
            $_SESSION['status_icon'] = "error";
            header("Location: ../messages.php");
            exit;
        }
    }
   
    // Check if the request is to delete all messages
    if (!empty($_POST['delete_all'])) {
        try {
            $main->delete_all_messages();
            $_SESSION['status'] = "All messages deleted successfully!";
            $_SESSION['status_icon'] = "success";
        } catch (Exception $e) {
            $_SESSION['status'] = "Error: Could not delete all messages. {$e->getMessage()}";
            $_SESSION['status_icon'] = "error";
        }
    }

    // Redirect back to the messages list page
    header("Location: ../messages.php");
    exit;
}
?>
