<?php
include 'config.php';

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen(string: $_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen(string: $_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string(string: $_POST['email']);
        $senha = $mysqli->real_escape_string(string: $_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query(query: $sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header(header: "Location: main.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

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
        <a href="register.php">REGISTRAR</a>
    </div>

    <img src="img/LEA-98acd8c0.png" alt="LEA Image" class="main-image">
    <div class="color1" id="color1"></div>
    <div class="color2" id="color2"></div>
    <div class="nav-container">
        <div class="nav1"></div>
        <form method="post" action="">
            <input class="reg" type="text" name="email" placeholder="E-mail ou registro" required>
            <div class="nav2"></div>
            <input class="psw" type="password" name="senha" placeholder="Senha" required>
            <button class="enter" type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>
