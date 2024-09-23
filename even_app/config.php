<?php
// config.php
$hostname = "localhost";
$bancodedados = "login";
$usuario = "root";
$senha = "";


// Cria a conexão
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_error) {
    die ("Falha ao conectar ao banco de dados: (". $mysqli->connect_errno.")" . $mysqli->connect_error);

}

?>