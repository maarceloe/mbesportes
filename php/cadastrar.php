<?php
include 'config.php';

$nome  = mysqli_real_escape_string($conexao, $_POST['name']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// 1. Verificar se já existe usuário com o mesmo e-mail
$sql_check = "SELECT id FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql_check);

if (mysqli_num_rows($resultado) > 0) {
    // Já existe, não deixa cadastrar
    echo "<script>
    window.onload = function() {
        mostrarModal(
            'Erro no cadastro!',
            'Já existe uma conta com esse e-mail.',
            '../pages/cadastro.php'
        );
    };
</script>";
} else {
    // 2. Criar novo usuário
    $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaHash')";

    if (mysqli_query($conexao, $sql_insert)) {
        // Cadastro feito com sucesso → chama modal
        echo "<script>
            window.onload = function() {
                mostrarModal(
                    'Conta Criada!',
                    'Muito bom ter você cadastrado em nosso site. Você será redirecionado para a tela de login.',
                    'login.php'
                );
            };
        </script>";
    } else {
        echo "<script>
            alert('Erro ao cadastrar!');
            window.location.href='../pages/cadastro.php';
        </script>";
    }
}
?>