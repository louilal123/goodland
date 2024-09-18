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
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
            // Full name validation
            $_SESSION['error_fullname1'] = "Full name should contain only letters and spaces.";
            $hasError = true;
        }

        if (empty($username)) {
            $_SESSION['error_username'] = "Username is required.";
            $hasError = true;
        }

        if (empty($email)) {
            $_SESSION['error_email'] = "Email is required.";
            $hasError = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_email_format'] = "Invalid email format.";
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

  // Handle the photo upload
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

          if(move_uploaded_file($fileTmpPath, $dest_path)) {
              $photoPath = 'uploads/' . $newFileName;
          } else {
              $_SESSION['status'] = "Error moving the uploaded file.";
              $_SESSION['status_icon'] = "error";
              header('Location: ../manageadmins.php#addItemModal');
              exit();
          }
      } else {
          $_SESSION['status'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
          $_SESSION['status_icon'] = "error";
          header('Location: ../manageadmins.php#addItemModal');
          exit();
      }
  }

        try {
            if ($mainClass->insert_admin($fullname, $username, $email, $password, $photoPath)) {
                $_SESSION['status'] = "Admin successfully added!";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status'] = "Error adding admin.";
                $_SESSION['status_icon'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['status'] = "Oops! Error: " . $e->getMessage();
            $_SESSION['status_icon'] = "error";
        }

        header('Location: ../manageadmins.php');
        exit();
    }

    if (isset($_POST['update_admin_status'])) {
        $username = $_POST['username'];
        $status = $_POST['status'];
    
        if ($mainClass->update_admin_status($username, $status)) {
            $_SESSION['status'] = "Admin status updated successfully!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Failed to update admin status!";
            $_SESSION['status_icon'] = "error";
        }
        header("Location: ../manageadmins.php");
        exit();
    }
    

}


