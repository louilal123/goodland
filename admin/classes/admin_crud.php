<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['add_admin'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cPassword = $_POST['cPassword'];

        $hasError = false;

        // Check for empty fields
        if (empty($fullname)) {
            $_SESSION['error_fullname'] = "Full name is required.";
            $hasError = true;
        }

        if (empty($username)) {
            $_SESSION['error_username'] = "Username is required.";
            $hasError = true;
        }

        if (empty($email)) {
            $_SESSION['error_email'] = "Email is required.";
            $hasError = true;
        }

        if (empty($password)) {
            $_SESSION['error_pswd'] = "Password is required.";
            $hasError = true;
        }

        if (empty($cPassword)) {
            $_SESSION['error_cpswd'] = "Confirm password is required.";
            $hasError = true;
        }

        // Full name validation
        if (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
            $_SESSION['error_fullname'] = "Full name should contain only letters and spaces.";
            $hasError = true;
        }

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_email_format'] = "Invalid email format.";
            $hasError = true;
        }

        if ($password !== $cPassword) {
            $_SESSION['error_pswd_match'] = "Passwords do not match.";
            $hasError = true;
        }

        if ($mainClass->usernameExists($username)) {
            $_SESSION['error_username'] = "Username already exists.";
            $hasError = true;
        }

        if ($mainClass->emailExists($email)) {
            $_SESSION['error_email_exists'] = "Email already exists.";
            $hasError = true;
        }

        if ($hasError) {
            $_SESSION['form_data'] = $_POST;
            header('Location: ../manageadmins.php#addItemModal');
            exit();
        }

        $photoPath = null;

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $photoName = basename($_FILES['photo']['name']);
            $uploadFile = $uploadDir . $photoName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                $photoPath = $uploadFile;
            } else {
                $_SESSION['status2'] = "Oops! Error uploading photo.";
                $_SESSION['status_icon2'] = "error";
                header('Location: ../manageadmins.php#addItemModal');
                exit();
            }
        }

        try {
            if ($mainClass->insert_admin($fullname, $username, $email, $password, $photoPath)) {
                $_SESSION['status1'] = "Admin successfully added!";
                $_SESSION['status_icon1'] = "success";
            } else {
                $_SESSION['status1'] = "Error adding admin.";
                $_SESSION['status_icon1'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status1'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon1'] = "error";
        }

        header('Location: ../manageadmins.php');
        exit();
    }

    if (isset($_POST['update_admin_status'])) {
        $username = $_POST['username'];
        $status = $_POST['status'];
    
        if ($mainClass->update_admin_status($username, $status)) {
            $_SESSION['status1'] = "Admin status updated successfully!";
            $_SESSION['status_icon1'] = "success";
        } else {
            $_SESSION['status1'] = "Failed to update admin status!";
            $_SESSION['status_icon1'] = "error";
        }
        header("Location: ../manageadmins.php");
        exit();
    }
    

}


