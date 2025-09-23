<?php
session_start();
include '../php/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["status" => "error", "message" => "Usuário não logado"]);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_produto = $_POST['id_produto'] ?? null;

if (!$id_produto) {
    echo json_encode(["status" => "error", "message" => "Produto inválido"]);
    exit;
}

// Verifica se já existe
$sql = "SELECT 1 FROM favoritos WHERE id_usuario = ? AND id_produto = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ii", $id_usuario, $id_produto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Remove favorito
    $sql = "DELETE FROM favoritos WHERE id_usuario = ? AND id_produto = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_produto);
    $stmt->execute();
    echo json_encode(["status" => "unfavorited"]);
} else {
    // Adiciona favorito
    $sql = "INSERT INTO favoritos (id_usuario, id_produto, data_adicao) VALUES (?, ?, NOW())";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_produto);
    $stmt->execute();
    echo json_encode(["status" => "favorited"]);
}
