<?php
include 'config.php';

// Inicia a sessão
session_start();

// Verifica se as variáveis de sessão estão definidas
if (!isset($_SESSION['registro']) || !isset($_SESSION['nome'])) {
    echo "Erro: Usuário não autenticado!";
    exit();
}

// Armazena os dados da sessão em variáveis
$nome = $_SESSION['nome'];
$registro = $_SESSION['registro'];

// Recupera os dados do formulário
$car_model = $_POST['car_model'];
$fabric = $_POST['fabric'];
$parts = $_POST['parts'];
$delivery_location = $_POST['delivery_location'];

// Insere o pedido no banco de dados
$query = "INSERT INTO orders (nome, registro, car_model, fabric, parts, delivery_location, created_at) 
          VALUES ('$nome', '$registro', '$car_model', '$fabric', '$parts', '$delivery_location', NOW())";

if (mysqli_query($mysqli, $query)) {
    echo "Pedido enviado com sucesso!";
} else {
    echo "Erro ao enviar pedido: " . mysqli_error($mysqli);
}
?>