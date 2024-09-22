<?php
include 'config.php';
include('protect.php');
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
            
            <!-- Dropdown de Notificações -->
            <div id="notification-menu" class="dropdown-menu">
                <h4>Notificações</h4>
                <ul id="notification-list">
                    <!-- Notificações serão carregadas aqui -->
                </ul>
            </div>

            <img src="img/avatar.svg" alt="avatar" class="avatar">
            <h1 class="username">
                <?php echo $_SESSION['nome']; ?>
            </h1>
            <input type="image" src="img/Icons - chevron-down.svg" alt="chevron-down" class="chevron-down" id="dropdown-button"/>

            <!-- Menu Dropdown -->
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
        <div class="filter-container">
            <button id="make-order-button">Fazer Pedido</button>
        </div>
    <nav class="main-nav">PEDIDOS</nav>
        <div class="filter-container">
            <input type="date" id="filter-date">
            <button id="filter-button">Filtrar</button>
        </div>
        <div class="ticket-list-wrapper">
            <h2>Lista de Pedidos</h2>
            <ul class="ticket-list" id="ticket-list">
            </ul>
        </div>
    </div>

    <div class="color1" id="color1"></div>
    <div class="color2" id="color2"></div>
    <div class="nav-container"></div>
    <script src="./main.js"></script>
</body>
</html>
