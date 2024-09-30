<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php'; 

$main = new Main_class();

if (isset($_GET['token'])) {

    $token_hash = urldecode(trim($_GET['token'], "'"));

    if ($main->is_token_valid($token_hash)) {
        $update_result = $main->update_activation_hash($token_hash);
        
        if ($update_result) {
            $_SESSION['status'] = "The admins will now review your registration entry. Please wait and Sorry for the inconvenience. ";
            $_SESSION['status_icon'] = "success";
            header("Location: c-login.php");
            exit;
        } else {
            echo "Error updating activation link. Please try again later.<br>";
            exit();
        }
    } else {
        echo "Invalid activation link. Please check the link and try again.<br>";
        exit();
    }
} else {
    echo "No activation token provided. Please use the correct activation link.<br>";
    exit();
}
?>
