<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registro = $_POST['registro'];
    $senha = $_POST['senha'];

    // Anti SQL Injection
    $registro = stripslashes($registro);
    $senha = stripslashes($senha);
    $registro = $conn->real_escape_string($registro);
    $senha = $conn->real_escape_string($senha);

    // Consulta banco de dados
    $sql = "SELECT id FROM users WHERE registro = '$registro' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        $_SESSION['login_user'] = $registro;
        header("location: welcome.php");
    } else {
        $error = "Registro ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even App - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <p>NÃO REGISTRADO?</p>
        <a href="register.html">REGISTRAR</a>
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
            <button class="enter" type="submit">ENTRAR</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
