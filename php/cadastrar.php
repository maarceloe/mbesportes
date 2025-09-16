<?php
include 'config.php';

$nome  = mysqli_real_escape_string($conexao, $_POST['name']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// 1. Verificar se já existe usuário com o mesmo e-mail
$sql_check = "SELECT id_usuario FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql_check);

if (mysqli_num_rows($resultado) > 0) {
    // Já existe, não deixa cadastrar
    header("Location: ..//pages/cadastro.php?erro=email");
    exit;
} else {
    // 2. Criar novo usuário
    $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaHash')";

    if (mysqli_query($conexao, $sql_insert)) {
        // Cadastro feito com sucesso → chama modal
        header("Location: ..//pages/cadastro.php?sucesso=1");
        exit;
    } else {
        header("Location: ..//pages/cadastro.php?erro=insert");
        exit;
    }
}
?>