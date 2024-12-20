<?php 
include 'config.php';
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even App - Criar Pedido</title>
    <link rel="stylesheet" href="create_order.css">
</head>
<body>
<section class="container">

    <!-- Seção de Informações do Usuário -->
    <header>Informações do Usuário</header>
    <div class="user-info">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" value="<?php echo $_SESSION['nome']; ?>" readonly>

        <label for="email">Email:</label>
        <input type="email" id="email" value="<?php echo $_SESSION['email']; ?>" readonly>

        <label for="registro">Registro:</label>
        <input type="text" id="registro" value="<?php echo $_SESSION['registro']; ?>" readonly>

<!--         Foto do Usuário 
        <div class="user-photo">
            <img src="path/to/user_photo.jpg" alt="Foto do Usuário">
        </div>
    </div>
-->
    <!-- Linha divisória -->
    <hr>

    <!-- Seção de Informações do Pedido -->
    <header>Informações do Pedido</header>
    <form method="POST" action="submit_order.php">
        <label for="car-model">Modelo do Carro:</label>
        <select id="car-model" name="car_model">
            <option value="Modelo A">Modelo A</option>
            <option value="Modelo B">Modelo B</option>
            <option value="Modelo C">Modelo C</option>
        </select>

        <label for="fabric">Tecido:</label>
        <select id="fabric" name="fabric">
            <option value="Tecido 1">Tecido 1</option>
            <option value="Tecido 2">Tecido 2</option>
        </select>

        <label for="parts">Peças:</label>
        <input type="text" id="parts" name="parts" required>

        <!-- Linha divisória -->
        <hr>

        <!-- Seção Local de Entrega -->
        <header>Local de Entrega</header>
        <label for="delivery-location">Local de Entrega:</label>
        <input type="text" id="delivery-location" name="delivery_location" required>

        <!-- Botões -->
        <div class="button-group">
            <button type="submit">Criar Pedido</button>
            <button type="button" onclick="window.location.href='main.php'">Cancelar</button>
        </div>
    </form>

</section>
</body>
</html>
