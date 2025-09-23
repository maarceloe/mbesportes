<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
    $id = intval($_POST['id_produto']);

    mysqli_query($conexao, "DELETE FROM produtos_tamanhos WHERE id_produto=$id");
    mysqli_query($conexao, "DELETE FROM produtos WHERE id=$id");

    header("Location: ../pages/adm_fun.php?success=excluido");
    exit;
} else {
    header("Location: ../pages/adm_fun.php");
    exit;
}
