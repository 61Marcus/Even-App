<?php
include 'config.php';
include('protect.php');

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket = $_POST['ticket'];
    $registro = $_POST['registro'];
    $delivery_location = $_POST['delivery_location'];
    $status = $_POST['status'];
    
    // Inicializa variáveis de metragem e custo
    $metragem = null;
    $custo = null;

    // Verifica se o usuário tem permissão para editar a metragem
    if ($_SESSION['nivel'] >= 3 && isset($_POST['metragem']) && is_numeric($_POST['metragem'])) {
        $metragem = $_POST['metragem'];
        $fabric = $_POST['fabric']; // Fabric deve ser um valor enviado do formulário
        $custo = $metragem * $fabric; // Cálculo do custo
    }

    // Atualiza os dados no banco de dados
    $query = $mysqli->prepare("UPDATE orders SET registro = ?, delivery_location = ?, status = ?, metragem = ?, custo = ? WHERE ticket = ?");
    $query->bind_param("ssssds", $registro, $delivery_location, $status, $metragem, $custo, $ticket);

    if ($query->execute()) {
        header("Location: main.php?message=Pedido atualizado com sucesso.");
        exit;
    } else {
        echo "Erro ao atualizar o pedido: " . $mysqli->error;
    }
} else {
    echo "Método de requisição inválido.";
    exit;
}
?>
