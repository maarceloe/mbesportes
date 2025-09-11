<?php
include 'config.php';

$nome  = $_POST['name'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// 1. Verificar se já existe usuário com o mesmo e-mail
$sql_check = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql_check);

if (mysqli_num_rows($resultado) > 0) {
    // Já existe, não deixa cadastrar
    echo "<script>alert('Já existe uma conta com esse e-mail!'); window.location.href='../pages/cadastro.php';</script>";
} else {
    // 2. Criar novo usuário
    $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conexao, $sql_insert)) {
        // Cadastro feito com sucesso → chama modal
        echo "<script src='../js/main.js'></script>";
        echo "<script>mostrarModal(
            'Conta Criada!',
            'Muito bom ter você cadastrado em nosso site. Você será redirecionado para a tela de login.',
            'login.php'
        );</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!'); window.location.href='../pages/cadastro.php';</script>";
    }
}
?>