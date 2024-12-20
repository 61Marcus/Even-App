<?php
include 'config.php';
include('protect.php');

// Verifica se o ticket foi passado na URL
if (!isset($_GET['ticket'])) {
    echo "Ticket não especificado.";
    exit;
}

// Obtém o ticket da URL
$ticket = $_GET['ticket'];

// Consulta os dados do pedido com base no ticket
$query = $mysqli->prepare("SELECT * FROM orders WHERE ticket = ?");
$query->bind_param("s", $ticket);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Pedido não encontrado.";
    exit;
}

$order = $result->fetch_assoc();

// Verifica se o usuário tem permissão para editar o pedido
$can_edit = ($_SESSION['nivel'] >= 10) || ($_SESSION['registro'] === $order['registro']);
$can_change_status = ($_SESSION['nivel'] >= 10);  // Alterado aqui

// Verifica se o usuário pode editar campos específicos (car_model, fabric, parts, delivery_location)
$can_edit_specific_fields = ($_SESSION['nivel'] == 2 || $_SESSION['registro'] === $order['registro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link rel="stylesheet" href="edit_order.css">
</head>
<body>
    <div class="edit-form-container">
        <h1>Editar Pedido</h1>

        <!-- Verifica se o parâmetro readonly está presente na URL -->
        <?php if (isset($_GET['readonly']) && $_GET['readonly'] === 'true'): ?>
            <div class="permission-card" style="background-color: yellow; padding: 10px; border-radius: 5px; position: fixed; top: 20px; right: 20px;">
                <h3>Você não tem permissão para editar este pedido.</h3>
                <p>Entre em contato com um administrador ou com o criador do pedido para solicitar alterações.</p>
            </div>
        <?php endif; ?>

        <!-- Formulário de edição -->
        <form action="update_order.php" method="POST">
            <input type="hidden" name="ticket" value="<?php echo $order['ticket']; ?>">

            <!-- Desabilitar o campo de registro se o usuário não tiver permissão -->
            <label for="registro">Registro:</label>
            <input type="text" id="registro" name="registro" value="<?php echo $order['registro']; ?>" 
                <?php echo !$can_edit ? 'disabled' : ''; ?> required>

            <!-- Campos que o usuário pode editar se tiver permissão -->
            <label for="delivery_location">Local de Entrega:</label>
            <input type="text" id="delivery_location" name="delivery_location" value="<?php echo $order['delivery_location']; ?>" 
                <?php echo isset($_GET['readonly']) || !$can_edit_specific_fields ? 'disabled' : ''; ?> required>

            <label for="car_model">Modelo do Carro:</label>
            <input type="text" id="car_model" name="car_model" value="<?php echo $order['car_model']; ?>" 
                <?php echo isset($_GET['readonly']) || !$can_edit_specific_fields ? 'disabled' : ''; ?> required>

            <label for="fabric">Fabric:</label>
            <input type="number" id="fabric" name="fabric" value="<?php echo $order['fabric']; ?>" 
                <?php echo isset($_GET['readonly']) || !$can_edit_specific_fields ? 'disabled' : ''; ?> required>

            <label for="parts">Partes:</label>
            <input type="text" id="parts" name="parts" value="<?php echo $order['parts']; ?>" 
                <?php echo isset($_GET['readonly']) || !$can_edit_specific_fields ? 'disabled' : ''; ?> required>

            <label for="status">Status:</label>
            <select id="status" name="status" <?php echo isset($_GET['readonly']) || !$can_change_status ? 'disabled' : ''; ?> required>
                <option value="Aberto" <?php echo $order['status'] === 'Aberto' ? 'selected' : ''; ?>>Aberto</option>
                <option value="Cortado" <?php echo $order['status'] === 'Cortado' ? 'selected' : ''; ?>>Cortado</option>
                <option value="Entregue" <?php echo $order['status'] === 'Entregue' ? 'selected' : ''; ?>>Entregue</option>
                <option value="Plotado" <?php echo $order['status'] === 'Plotado' ? 'selected' : ''; ?>>Plotado</option>
                <option value="Liberado" <?php echo $order['status'] === 'Liberado' ? 'selected' : ''; ?>>Liberado</option>
                <option value="Cancelado" <?php echo $order['status'] === 'Cancelado' ? 'selected' : ''; ?>>Cancelado</option>
            </select>

            <!-- Campo de metragem (visível apenas para usuários de nível 3) -->
            <?php if ($_SESSION['nivel'] >= 3): ?>
                <label for="metragem">Metragem:</label>
                <input type="number" id="metragem" name="metragem" value="<?php echo $order['metragem']; ?>" 
                    <?php echo isset($_GET['readonly']) ? 'disabled' : ''; ?>>

                <label for="custo">Custo:</label>
                <input type="text" id="custo" name="custo" value="<?php echo $order['custo']; ?>" disabled>
            <?php endif; ?>

            <button type="submit" <?php echo isset($_GET['readonly']) || !$can_edit ? 'disabled' : ''; ?>>Atualizar</button>
        </form>

    </div>

    <script>
        // Bloqueia os campos de edição se o parâmetro 'readonly' estiver presente
        if (window.location.search.indexOf('readonly=true') > -1) {
            document.querySelector('form').querySelectorAll('input, select, button').forEach(function(element) {
                element.disabled = true;
            });
        }
    </script>
</body>
</html>
