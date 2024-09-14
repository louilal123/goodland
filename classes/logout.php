<?php
session_start();
session_unset(); 
session_destroy(); 

$_SESSION['status'] = "Logout Success!";
$_SESSION['status_icon'] = "success";
header("Location: ../index.php"); 
exit();
?>
