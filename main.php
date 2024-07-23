<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se a data foi fornecida
if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Preparar a consulta SQL
    $sql = "SELECT id, status FROM pedidos WHERE DATE(data) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Buscar resultados
    $tickets = array();
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }

    // Retornar resultados em JSON
    echo json_encode($tickets);

    // Fechar a conexão
    $stmt->close();
}

$conn->close();
?>
