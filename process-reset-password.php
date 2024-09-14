<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php';

$main = new Main_class();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["token"])) {
    $token = $_POST["token"];
    $token_hash = hash("sha256", $token);

    // Find user with matching reset token
    $user = $main->get_user_by_reset_token($token_hash);

    if ($user === null) {
        die("Token not found");
    }

    // Check if the token has expired
    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        die("Token has expired");
    }

    // Validate the new password
    if (strlen($_POST["password"]) < 8) {
        die("Password must be at least 8 characters long");
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        die("Password must contain at least one letter");
    }

    if (!preg_match("/[0-9]/", $_POST["password"])) {
        die("Password must contain at least one number");
    }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        die("Passwords do not match");
    }

    // Hash the new password
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Update the password and clear the reset token
    if ($main->update_password($user['user_id'], $password_hash)) {
        echo "Password updated successfully. You can now log in.";
    } else {
        echo "Failed to update password.";
    }
} else {
    die("Invalid request.");
}
?>
