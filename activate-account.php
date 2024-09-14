<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php'; 

$main = new Main_class();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $token_hash = hash('sha256', $token);

    // Check if token is valid
    if ($main->is_token_valid($token_hash)) {
        // Update the account activation hash
        $main->update_activation_hash($token_hash);

        header("Location: get-start.php");
        exit;
    } else {
        die("Invalid activation link");
    }
} else {
    die("No activation token provided");
}
?>
