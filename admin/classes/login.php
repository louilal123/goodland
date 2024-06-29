<?php 
require_once "Main_class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $conn = new Main_class();
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $conn->login_user($email, $password);
    } else {
        echo "Email and Password are required.";
    }
}
?>
