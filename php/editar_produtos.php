<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $categoria_id = intval($_POST['categoria_id']);
    $time_id = intval($_POST['time_id']);
    $qualidade_id = intval($_POST['qualidade_id']);
    $tamanho_ids = explode(',', $_POST['tamanho_id']);

    // Se enviou imagem nova
    if (!empty($_FILES['imagem']['name'])) {
        $imagem = basename($_FILES['imagem']['name']);
        $caminho = "../assets/imgs/produtos/" . $imagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);

        $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', imagem='$imagem',
                categoria_id=$categoria_id, time_id=$time_id, qualidade_id=$qualidade_id
                WHERE id=$id";
    } else {
        $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao',
                categoria_id=$categoria_id, time_id=$time_id, qualidade_id=$qualidade_id
                WHERE id=$id";
    }

    if (mysqli_query($conexao, $sql)) {
        // Atualizar tamanhos
        mysqli_query($conexao, "DELETE FROM produtos_tamanhos WHERE id_produto=$id");
        foreach ($tamanho_ids as $tid) {
            if ($tid !== '') {
                mysqli_query($conexao, "INSERT INTO produtos_tamanhos (id_produto, id_tamanho) VALUES ($id, $tid)");
            }
        }
        header("Location: ../pages/adm_fun.php?success=1");
        exit;
    } else {
        echo "Erro: " . mysqli_error($conexao);
    }
}
