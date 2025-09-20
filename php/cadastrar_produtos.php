<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'config.php';

// Verifica se é admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php");
    exit;
}

// Verifica se veio do formulário via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $categoria_id = intval($_POST['categoria_id']);
    $time_id = intval($_POST['time_id']);
    $qualidade_id = intval($_POST['qualidade_id']);

    // Upload de imagem
    $nome_imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = uniqid() . '.' . $extensao;
        $destino = '../assets/imgs/produtos/' . $nome_imagem;
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            die("Erro ao enviar a imagem.");
        }
    }

    // Inserção no banco de produtos
    $sql = "INSERT INTO produtos (nome, descricao, imagem, categoria_id, time_id, qualidade_id)
            VALUES ('$nome', '$descricao', '$nome_imagem', $categoria_id, $time_id, $qualidade_id)";
    if (!mysqli_query($conexao, $sql)) {
        die("Erro ao cadastrar produto: " . mysqli_error($conexao));
    }

    $id_produto = mysqli_insert_id($conexao);

    // Salva tamanhos selecionados (multiple tags)
    $tamanhos_selecionados = isset($_POST['tamanho_id']) ? explode(',', $_POST['tamanho_id']) : [];
    foreach ($tamanhos_selecionados as $id_tamanho) {
        $id_tamanho = intval($id_tamanho);
        $sql_tam = "INSERT INTO produtos_tamanhos (id_produto, id_tamanho) VALUES ($id_produto, $id_tamanho)";
        mysqli_query($conexao, $sql_tam);
    }

    // Redireciona com sucesso
    header("Location: ../pages/cadastro_produtos.php?success=1");
    exit;

} else {
    // Acesso direto via GET
    header("Location: ../pages/cadastro_produtos.php");
    exit;
}