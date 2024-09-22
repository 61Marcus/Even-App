<?php
include 'config.php';
include('protect.php');
?>

<form method="POST" action="submit_order.php">
    <label for="car-model">Modelo do Carro:</label>
    <select id="car-model" name="car_model">
        <!-- Exemplo de opções de modelos de carro -->
        <option value="Modelo A">Modelo A</option>
        <option value="Modelo B">Modelo B</option>
        <option value="Modelo C">Modelo C</option>
    </select>

    <label for="fabric">Tecido:</label>
    <select id="fabric" name="fabric">
        <!-- Exemplo de opções de tecido -->
        <option value="Tecido 1">Tecido 1</option>
        <option value="Tecido 2">Tecido 2</option>
    </select>

    <label for="parts">Peças:</label>
    <input type="text" id="parts" name="parts" required>

    <label for="delivery-location">Local de Entrega:</label>
    <input type="text" id="delivery-location" name="delivery_location" required>

    <button type="submit">Enviar Pedido</button>
</form>
