<?php
session_start();
session_unset(); 
session_destroy(); 

$_SESSION['status1'] = "Logout Successulyy!";
$_SESSION['status_icon1'] = "success";
header("Location: ../index.php"); 
exit();
?>
