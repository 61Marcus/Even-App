<?php
include 'config.php';

// Inicia a sessão
session_start();

if (!isset($_SESSION['registro']) || !isset($_SESSION['nome'])) {
    echo "Erro: Usuário não autenticado!";
    exit();
}

$nome = $_SESSION['nome'];
$registro = $_SESSION['registro'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_model = $_POST['car_model'] ?? null;
    $fabric = $_POST['fabric'] ?? null;
    $parts = $_POST['parts'] ?? null;
    $delivery_location = $_POST['delivery_location'] ?? null;

    if (!$car_model || !$fabric || !$parts || !$delivery_location) {
        echo "Erro: Todos os campos são obrigatórios!";
        exit();
    }

    // Insere os dados no banco (o ticket será gerado automaticamente)
    $query = "INSERT INTO orders (nome, registro, car_model, fabric, parts, delivery_location, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ssssss', $nome, $registro, $car_model, $fabric, $parts, $delivery_location);

        if ($stmt->execute()) {
            // Recupera o ticket gerado automaticamente
            $ticket = $mysqli->insert_id;
            $mask_name = '#' . $ticket;

            // Atualiza o campo mask_name
            $update_query = "UPDATE orders SET mask_name = ? WHERE ticket = ?";
            $update_stmt = $mysqli->prepare($update_query);
            $update_stmt->bind_param('si', $mask_name, $ticket);
            $update_stmt->execute();

            // Exibe mensagem de sucesso e redireciona
            echo "Pedido enviado com sucesso! Ticket: $mask_name";
            echo "<br>Você será redirecionado para a página principal em 5 segundos.";
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "main.php";
                    }, 5000);
                  </script>';
        } else {
            echo "Erro ao enviar pedido: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Erro: Método de requisição inválido!";
    exit();
}
?>
