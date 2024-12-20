<?php
include 'config.php';

$erro = ''; // Variável para armazenar a mensagem de erro

if(isset($_POST['email']) && isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        $erro = "Preencha seu e-mail ou registro";
    } else if(strlen($_POST['senha']) == 0) {
        $erro = "Preencha sua senha";
    } else {

        $login = $mysqli->real_escape_string($_POST['email']);
        $senha = $_POST['senha']; // A senha enviada pelo usuário, sem encriptar

        // Verifica se o valor inserido é um e-mail ou um registro
        $sql_code = "SELECT * FROM usuarios WHERE (email = '$login' OR registro = '$login') LIMIT 1";
        $sql_query = $mysqli->query($sql_code);

        if (!$sql_query) {
            // Se a query falhar, mostra o erro
            $erro = "Falha na execução do código SQL: " . $mysqli->error;
        } else {

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {
                
                $usuario = $sql_query->fetch_assoc();
                // Verifica se a senha informada corresponde à senha criptografada no banco
                if (password_verify($senha, $usuario['senha'])){
                    session_start();

                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['registro'] = $usuario['registro'];
                    $_SESSION['nivel'] = $usuario['nivel'];

                    header("Location: main.php");
                    exit();
                } else {
                    $erro = "Falha ao logar! E-mail, registro ou senha incorretos.";
                }

            } else {
                // Exibe a mensagem de erro se o login falhar
                $erro = "Falha ao logar! E-mail, registro ou senha incorretos.";
            }
        }
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Exibe uma mensagem de erro se os campos estiverem vazios
    $erro = "Por favor, preencha todos os campos.";
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
        
        <!-- Formulário de Login -->
        <form method="post" action="">
            <input class="reg" type="text" name="email" placeholder="E-mail ou registro" required>
            <div class="nav2"></div>
            <input class="psw" type="password" name="senha" placeholder="Senha" required>
            <button class="enter" type="submit">ENTRAR</button>
        </form>

        <!-- Exibe a mensagem de erro se houver -->
        <?php if(!empty($erro)): ?>
            <p style="color: red; text-align: center;"><?php echo $erro; ?></p>
        <?php endif; ?>
        
    </div>
</body>
</html>
