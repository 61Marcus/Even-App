<?php
// Conexão com o banco de dados
include 'config.php';

// Consulta para buscar as notificações
$query = "SELECT id, message, is_read FROM notifications WHERE id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notifications);
?>
