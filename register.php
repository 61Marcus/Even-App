<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registro = $_POST['registro'];
    $senha = $_POST['senha'];

    // Anti SQL Injection
    $registro = stripslashes($registro);
    $senha = stripslashes($senha);
    $registro = $mysqli->real_escape_string($registro);
    $senha = $mysqli->real_escape_string($senha);

    // Verifica se o usuário já existe
    $sql = "SELECT id FROM users WHERE registro = '$registro'";
    $result = $mysqli->query($sql);


    if ($result->num_rows > 0) {
        $error = "Usuário já registrado";
    } else {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO users (registro, senha) VALUES ('$registro', '$senha')";
        var_dump($registro,$senha);
        if ($mysqli->query($sql) === TRUE) {
            // Registro bem-sucedido
        } else {
            echo "Erro: " . $mysqli->error; // Para ajudar a identificar o problema
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even App - Registrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <p>JÁ REGISTRADO?</p>
        <a href="index.php">LOGIN</a>
    </div>

    <img src="img/LEA-98acd8c0.png" alt="LEA Image" class="main-image">
    <div class="color1" id="color1"></div>
    <div class="color2" id="color2"></div>
    <div class="nav-container">
        <div class="nav1"></div>
        <form method="post" action="">
            <input class="reg" type="text" name="registro" placeholder="REGISTRO" required>
            <div class="nav2"></div>
            <input class="psw" type="password" name="senha" placeholder="SENHA" required>
            <button class="enter" type="submit">REGISTRAR</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
