<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "mb_esportes";

// Cria a conexão
$conexao = mysqli_connect($host, $user, $pass, $db);

// Verifica se a conexão deu certo
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>