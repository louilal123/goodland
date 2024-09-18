<?php
session_start();
require_once "Main_class.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['add_member'])) {
        $member_name = $_POST['member_name'];
        $description = $_POST['description'];

        $hasError = false;

        if (empty($member_name)) {
            $_SESSION['error_member_name'] = "Member name is required.";
            $hasError = true;
        }

        if (empty($description)) {
            $_SESSION['error_description'] = "Description is required.";
            $hasError = true;
        }
        if ($mainClass->is_member_name_exists($member_name)) {
            $_SESSION['error_member_name'] = "Member name already exists.";
            $hasError = true;
        }

        if ($hasError) {
            $_SESSION['form_data'] = $_POST;
            header('Location: ../managemembers.php#addItemModal');
            exit();
        }
        $photoPath = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['photo']['tmp_name'];
            $fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $fileType = $_FILES['photo']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = '../uploads/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $photoPath = 'uploads/' . $newFileName;
                } else {
                    $_SESSION['status'] = "Error moving the uploaded file.";
                    $_SESSION['status_icon'] = "error";
                    header('Location: ../managemembers.php#addItemModal');
                    exit();
                }
            } else {
                $_SESSION['status'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                $_SESSION['status_icon'] = "error";
                header('Location: ../managemembers.php#addItemModal');
                exit();
            }
        }

        try {
            if ($mainClass->insert_member($member_name, $description, $photoPath)) {
                $_SESSION['status'] = "Member successfully added!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error adding member.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../managemembers.php');
        exit();
    }
    if (isset($_POST['update_member'])) {
        $member_id = $_POST['member_id'];
        $member_name = $_POST['member_name'];
        $description = $_POST['description'];
    
        $hasError = false;
    
        if (empty($member_name)) {
            $_SESSION['error_member_name'] = "Member name is required.";
            $hasError = true;
        }
    
        if (empty($description)) {
            $_SESSION['error_member_description'] = "Description is required.";
            $hasError = true;
        }
    
        // Check for duplicate member_name excluding the current member_id
        if ($mainClass->is_member_name_exists($member_name, $member_id)) {
            $_SESSION['error_member_name'] = "Member name already exists.";
            $hasError = true;
        }
    
        if ($hasError) {
            $_SESSION['form_data'] = $_POST;
            header('Location: ../managemembers.php#editMemberModal');
            exit();
        }
    
        $photoPath = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['photo']['tmp_name'];
            $fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $fileType = $_FILES['photo']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
    
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = '../uploads/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;
    
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $photoPath = 'uploads/' . $newFileName;
                } else {
                    $_SESSION['status'] = "Error moving the uploaded file.";
                    $_SESSION['status_icon'] = "error";
                    header('Location: ../managemembers.php#editMemberModal');
                    exit();
                }
            } else {
                $_SESSION['status'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                $_SESSION['status_icon'] = "error";
                header('Location: ../managemembers.php#editMemberModal');
                exit();
            }
        }
    
        try {
            if ($mainClass->update_member($member_id, $member_name, $description, $photoPath)) {
                $_SESSION['status'] = "Member successfully updated!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error updating member details.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }
    
        header('Location: ../managemembers.php');
        exit();
    }
    
    
}


