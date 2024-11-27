<?php
session_start();
require_once "Main_class.php"; // Ensure your main class is included

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['update_settings'])) {
        // Get POST data
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $facebook_url = $_POST['facebook_url'];

        $hasError = false;

        // Validation checks

        // Address is required
        if (empty($address)) {
            $_SESSION['error_address'] = "Address is required.";
            $hasError = true;
        }

        // Validate contact number (phone number)
        if (!empty($contact) && !preg_match('/^\+?[0-9]{10,15}$/', $contact)) {
            $_SESSION['error_contact'] = "Please enter a valid contact number (10-15 digits).";
            $hasError = true;
        }

        // Validate email
        if (empty($email)) {
            $_SESSION['error_email'] = "Email is required.";
            $hasError = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_email_format'] = "Invalid email format.";
            $hasError = true;
        }

        // If any error, redirect back to the form with error messages
        if ($hasError) {
            $_SESSION['form_data'] = $_POST;
            header('Location: ../systemsetting.php#editSettingsModal'); // Adjust the location as necessary
            exit();
        }

        // If validation passes, proceed with updating settings
        try {
            if ($mainClass->updateSettings($address, $contact, $email, $facebook_url)) {
                $_SESSION['status'] = "Settings successfully updated!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error updating settings.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../systemsetting.php'); // Adjust the location to your page
        exit();
    }
}
?>
