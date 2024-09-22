<?php
include 'config.php';

$error = ''; // Variável para armazenar mensagem de erro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $registro = $mysqli->real_escape_string($_POST['registro']);

    // Verifica se o e-mail ou o registro já existem
    $sql = "SELECT * FROM usuarios WHERE email = '$email' OR registro = '$registro'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Verifica qual dos dois campos já existe e gera a mensagem de erro
        $row = $result->fetch_assoc();
        if ($row['email'] == $email) {
            $error = "E-mail já registrado.";
        } elseif ($row['registro'] == $registro) {
            $error = "Registro já cadastrado.";
        }
    } else {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (email, senha, nome, registro) VALUES ('$email', '$senha', '$nome', '$registro')";

        if ($mysqli->query($sql) === TRUE) {
            header("Location: main.php"); // Redireciona para página de sucesso
            exit();
        } else {
            $error = "Erro ao registrar: " . $mysqli->error; // Para ajudar a identificar o problema
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
        
        <!-- Formulário de Registro -->
        <form method="post" action="">
            <input class="reg" type="text" name="email" placeholder="E-mail" required>
            <div class="nav2"></div>
            <input class="nome" type="text" name="nome" placeholder="Primeiro Nome" required>
            <div class="nav2"></div>
            <input class="registro" type="text" name="registro" placeholder="Registro" required>
            <div class="nav2"></div>
            <input class="psw" type="password" name="senha" placeholder="Senha" required>
            <button class="enter" type="submit">REGISTRAR</button>
        </form>

        <!-- Exibir mensagem de erro, caso exista -->
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
