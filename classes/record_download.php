<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();


$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['file_id'])) {
    $file_id = $data['file_id'];
    $user_id = $_SESSION['user_id']; // Assuming you have user sessions

    $stmt = $pdo->prepare('INSERT INTO downloads (user_id, file_id, download_time) VALUES (:user_id, :file_id, NOW())');
    $stmt->execute(['user_id' => $user_id, 'file_id' => $file_id]);

    if ($stmt->rowCount()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>

