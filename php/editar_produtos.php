<?php
session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // O formulário usa 'id_produto' como hidden input; aceitar esse nome
    $id = 0;
    if (isset($_POST['id_produto'])) {
        $id = intval($_POST['id_produto']);
    } elseif (isset($_POST['id'])) {
        $id = intval($_POST['id']);
    }

    if ($id <= 0) {
        header("Location: ../pages/adm_fun.php?error=invalid_id");
        exit;
    }

    // Sanitização defensiva
    $nome = isset($_POST['nome']) ? mysqli_real_escape_string($conexao, $_POST['nome']) : '';
    $descricao = isset($_POST['descricao']) ? mysqli_real_escape_string($conexao, $_POST['descricao']) : '';
    $categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;
    $time_id = isset($_POST['time_id']) ? intval($_POST['time_id']) : 0;
    $qualidade_id = isset($_POST['qualidade_id']) ? intval($_POST['qualidade_id']) : 0;
    $tamanho_ids = (isset($_POST['tamanho_id']) && $_POST['tamanho_id'] !== '') ? explode(',', $_POST['tamanho_id']) : [];

    // Se enviou imagem nova
    // Tratar upload de imagem, se houver
    $imagem = null;
    if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])) {
        $imagem = basename($_FILES['imagem']['name']);
        $caminho = __DIR__ . "/../assets/imgs/produtos/" . $imagem;
        if (!is_dir(dirname($caminho))) {
            mkdir(dirname($caminho), 0755, true);
        }
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            error_log('Falha ao mover arquivo de imagem para: ' . $caminho);
            // não interrompe, mas não atualiza o campo imagem
            $imagem = null;
        }
    }

    if ($imagem !== null) {
        $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', imagem='$imagem',
                categoria_id=$categoria_id, time_id=$time_id, qualidade_id=$qualidade_id
                WHERE id=$id";
    } else {
        $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao',
                categoria_id=$categoria_id, time_id=$time_id, qualidade_id=$qualidade_id
                WHERE id=$id";
    }

    $res = mysqli_query($conexao, $sql);
    if ($res) {
        // Atualizar tamanhos: use casting seguro
        $del = mysqli_query($conexao, "DELETE FROM produtos_tamanhos WHERE id_produto=" . intval($id));
        if ($del === false) {
            error_log('Erro DELETE produtos_tamanhos: ' . mysqli_error($conexao));
        }
        foreach ($tamanho_ids as $tid) {
            $tid_int = intval($tid);
            if ($tid_int > 0) {
                $ins = mysqli_query($conexao, "INSERT INTO produtos_tamanhos (id_produto, id_tamanho) VALUES (" . intval($id) . ", $tid_int)");
                if ($ins === false) {
                    error_log('Erro INSERT produtos_tamanhos: ' . mysqli_error($conexao));
                }
            }
        }
        header("Location: ../pages/adm_fun.php?success=1");
        exit;
    } else {
        error_log('Erro UPDATE produto: ' . mysqli_error($conexao) . ' -- SQL: ' . $sql);
        echo "Erro ao atualizar o produto. Verifique os logs do servidor para mais detalhes.";
    }
}
