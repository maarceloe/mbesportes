<?php
include 'config.php';
// conectar ao banco, pegar email e senha do POST
$email = $_POST['email'];
$senha = $_POST['senha'];

// consulta ao banco para verificar usuário
$resultado = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'");

if (mysqli_num_rows($resultado) > 0) {
    // login bem-sucedido
    session_start();
    $_SESSION['usuario'] = $email;

    // chama o modal via JS
    echo "<script src='../js/main.js'></script>";


    if ($cadastro_sucesso) {
        echo "<script>mostrarModal('Conta Criada!', 'Muito bom ter você cadastrado em nosso site. Você será redirecionado para a tela de login', 'login.php');</script>";
    }
} else {
    echo "<script>alert('Email ou senha incorretos!');</script>";
}
