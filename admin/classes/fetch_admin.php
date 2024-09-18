<?php

// for the modal to populate for viweing and form to see
// require_once 'Main_class.php';

// if (isset($_POST['admin_id'])) {
//     $admin_id = $_POST['admin_id'];
//     $mainClass = new Main_class();
//     $adminDetails = $mainClass->getAdminDetails($admin_id);

//     if ($adminDetails) {
//         echo json_encode($adminDetails);
//     }
// }

require_once 'Main_class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_id'])) {
    $admin_id = $_POST['admin_id'];
    $mainClass = new Main_class();
    
    $adminDetails = $mainClass->getAdminDetails($admin_id);

    if ($adminDetails) {
        echo json_encode($adminDetails);
    } else {
        echo json_encode(['error' => 'Admin details not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
