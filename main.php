<?php
include 'config.php';
include('protect.php');

// Obtém a data e o termo de pesquisa da URL
$selectedDate = isset($_GET['date']) ? $_GET['date'] : '';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Construir a consulta SQL
$query = "SELECT * FROM orders WHERE 1=1"; // Começa com um verdadeiro

// Adiciona filtros de data se a data estiver definida
if ($selectedDate) {
    $query .= " AND DATE(created_at) = '$selectedDate'";
}

// Adiciona filtro de pesquisa se o termo de pesquisa estiver definido
if ($searchTerm) {
    $query .= " AND (ticket LIKE '%$searchTerm%' OR registro LIKE '%$searchTerm%')";
}

// Ordena os resultados por data de criação em ordem decrescente
$query .= " ORDER BY created_at DESC";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even App</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="img/LEA-98acd8c0.png" alt="LEA Image" class="main-image">
            <h1>EVEN-UP</h1>
        </div>
        <div class="header-right">
            <img src="./img/Bell.svg" alt="bell-icon" class="bell-icon" id="bell-button">
            <div id="notification-menu" class="dropdown-menu">
                <h4>Notificações</h4>
                <ul id="notification-list">
                    <!-- Notificações serão carregadas aqui -->
                </ul>
            </div>

            <img src="img/avatar.svg" alt="avatar" class="avatar">
            <h1 class="username"><?php echo $_SESSION['nome']; ?></h1>
            <input type="image" src="img/Icons - chevron-down.svg" alt="chevron-down" class="chevron-down" id="dropdown-button"/>
            <div id="dropdown-menu" class="dropdown-menu">
                <ul>
                    <li><a href="profile.php">Configurações</a></li>
                    <li><a href="info.php">Informações</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <nav class="nav-menu">
            <ul>
                <li><a href="#home">Início</a></li>
                <li><a href="#services">Pedidos</a></li>
                <li><a href="#about">Gestão</a></li>
                <li><a href="#contact">Contato</a></li>
            </ul>
        </nav>
    </div>

    <div class="wrapper">
        <nav class="main-nav">
            <span>Lista de pedidos</span>
            <div class="button-container">
                <button id="make-order-button">Fazer Pedido</button>
            </div>
        </nav>
        <div class="filter-container">
            <div class="filter-left">
                <input type="date" id="filter-date">
                <button id="filter-button">Filtrar</button>
            </div>
            <div class="search-container">
                <input type="text" id="search-ticket" placeholder="Buscar por Ticket ou Registro">
                <button id="search-button">Pesquisar</button>
            </div>
        </div>
        <div class="ticket-list-wrapper">
            <ul class="ticket-list" id="ticket-list">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <li>
                            <span>Ticket: <?php echo $order['ticket']; ?></span>
                            <span>Registro: <?php echo $order['registro']; ?></span>
                            <span>Data: <?php echo $order['created_at']; ?></span>
                            <span>Local de Entrega: <?php echo $order['delivery_location']; ?></span>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>Nenhum pedido encontrado.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="color1" id="color1"></div>
    <div class="color2" id="color2"></div>
    <div class="nav-container"></div>
    <script src="./main.js"></script>
</body>
</html>
