<?php
session_start();
include 'config.php';

$login = mysqli_real_escape_string($conexao, $_POST['login']); // pode ser email ou nome
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

// verifica se o campo é email ou nome
if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
    // se for email
    $sql = "SELECT * FROM usuarios WHERE email = '$login' LIMIT 1";
} else {
    // se for nome
    $sql = "SELECT * FROM usuarios WHERE nome = '$login' LIMIT 1";
}

$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($senha, $user['senha'])) {
        // Login OK → cria sessão
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['is_admin'] = $user['is_admin'];

        // Redireciona com sucesso
        header("Location: ../pages/login.php?login=ok");
        exit;
    } else {
        // Senha incorreta
        header("Location: ../pages/login.php?login=senha");
        exit;
    }
} else {
    // Usuário não encontrado
    header("Location: ../pages/login.php?login=nao_encontrado");
    exit;
}
