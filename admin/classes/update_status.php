<?php
require_once 'Main_class.php';
session_start();

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = $_POST['admin_id'];
    $status = $_POST['status'];

    $conn = new Main_class();

    try {
        if ($conn->update_admin_status($admin_id, $status)) {
            $_SESSION['status11'] = "Admin status has been updated successfully.";
            $_SESSION['status_icon11'] = "success";
            $response['success'] = true;
        } 
        
    } catch (Exception $e) {
        $_SESSION['status11'] = "Oops! Error: " . $e->getMessage();
        $_SESSION['status_icon11'] = "error";
        $response['error'] = $e->getMessage();
    }
}

echo json_encode($response);
?>
