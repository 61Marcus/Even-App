<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even App - Bem-vindo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <p>Bem-vindo, <?php echo $_SESSION['login_user']; ?>!</p>
        <a href="logout.php">LOGOUT</a>
    </div>

    <div class="content">
        <h1>Bem-vindo ao Even App!</h1>
        <p>Você está logado como <?php echo $_SESSION['login_user']; ?>.</p>
    </div>
</body>
</html>
