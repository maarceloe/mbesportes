<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'config.php';

// Verifica se é admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../pages/index.php");
    exit;
}

// Verifica se veio do formulário via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
    $categoria_id = mysqli_real_escape_string($conexao, $_POST['categoria_id']);
    $time_id = mysqli_real_escape_string($conexao, $_POST['time_id']);
    $tamanho_id = mysqli_real_escape_string($conexao, $_POST['tamanho_id']);
    $qualidade_id = mysqli_real_escape_string($conexao, $_POST['qualidade_id']);

    $nome_imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = uniqid() . '.' . $extensao;
        $destino = '../assets/imgs/produtos/' . $nome_imagem;
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            die("Erro ao enviar a imagem.");
        }
    }

    // Inserção no banco
    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem, categoria_id, time_id, tamanho_id, qualidade_id)
            VALUES ('$nome', '$descricao', '$preco', '$nome_imagem', '$categoria_id', '$time_id', '$tamanho_id', '$qualidade_id')";

    if (mysqli_query($conexao, $sql)) {
        // Sucesso → redireciona para o formulário com mensagem
        header("Location: ../pages/cadastro_produto.php?success=1");
        exit;
    } else {
        // Erro
        die("Erro ao cadastrar produto: " . mysqli_error($conexao));
    }

} else {
    // Acesso direto via GET
    header("Location: ../pages/cadastro_produto.php");
    exit;
}
