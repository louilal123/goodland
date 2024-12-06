<?php
session_start();
session_unset(); 
session_destroy(); 

echo "<script>
    localStorage.setItem('loggedOut', 'true'); 
    window.location.href = 'index.php';  
</script>";
exit();
?>
