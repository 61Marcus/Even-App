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
            <img src="./img/Bell.svg" alt="bell-icon" class="bell-icon">
            <img src="img/avatar.svg" alt="avatar" class="avatar">
                <h1 class="username">
                    <?php echo $_SESSION['nome'];?>
                </h1>
            <img src="img/Icons - chevron-down.svg" alt="chevron-down" class="chevron-down">
        </div>
    </div>
        
    <div class="sidebar">
        <nav class="nav-menu">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </div>

    <div class="wrapper">
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
    <script src="main.js"></script>
</body>
</html>
