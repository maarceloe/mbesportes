<?php
// view_card.php
session_start();
require_once '../php/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo '<p class="text-center text-red-500 mt-10">Produto não encontrado.</p>';
    exit;
}

$sql = "SELECT p.*, t.nome as time_nome, c.nome as categoria_nome, q.qualidade, tm.tamanho FROM produtos p
        LEFT JOIN times t ON p.time_id = t.time_id
        LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
        LEFT JOIN qualidades q ON p.qualidade_id = q.id_qualidade
        LEFT JOIN tamanhos tm ON p.tamanho_id = tm.id_tamanho
        WHERE p.id = $id LIMIT 1";
$result = mysqli_query($conexao, $sql);
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    echo '<p class="text-center text-red-500 mt-10">Produto não encontrado.</p>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Produto | MB Esportes</title>
    <link rel="stylesheet" href="/mbesportes/css/output.css">
    <link rel="stylesheet" href="/mbesportes/css/custom.css">
    <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
</head>
<body class="font-sans min-h-screen flex flex-col bg-gray-100 text-gray-800">
    <?php include '../includes/navbar_index.php'; ?>
    <main class="flex-1 flex flex-col items-center justify-center py-10">
        <section class="w-full max-w-md mx-auto">
            <div class="relative bg-white border border-gray-300 p-8 rounded-2xl text-center shadow-xl">
                <img src="<?= !empty($produto['imagem']) ? htmlspecialchars($produto['imagem']) : '../assets/imgs/bola.png' ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" class="w-full max-h-[250px] object-contain mb-6 rounded-md">
                <h2 class="font-bold text-2xl mb-2 text-gray-900"><?= htmlspecialchars($produto['nome']) ?></h2>
                <p class="text-base text-gray-700 mb-2">Categoria: <span class="font-semibold"><?= htmlspecialchars($produto['categoria_nome']) ?></span></p>
                <p class="text-base text-gray-700 mb-2">Time: <span class="font-semibold"><?= htmlspecialchars($produto['time_nome']) ?></span></p>
                <p class="text-base text-gray-700 mb-2">Tamanho: <span class="font-semibold"><?= htmlspecialchars($produto['tamanho']) ?></span></p>
                <p class="text-base text-gray-700 mb-2">Qualidade: <span class="font-semibold"><?= htmlspecialchars($produto['qualidade']) ?></span></p>
                <p class="text-base text-gray-700 mb-4"><?= htmlspecialchars($produto['descricao']) ?></p>
                <button class="btn-favorito w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-md transition-transform duration-300 hover:scale-110 active:scale-95 mx-auto mb-2" onclick="verificaLogin(this)">
                    <span class="heart-icon text-2xl">🤍</span>
                </button>
                <a href="/mbesportes/index.php" class="inline-block mt-4 text-[#ed3814] font-semibold hover:underline hover:scale-105 transition-transform duration-200">Voltar para Vitrine</a>
            </div>
        </section>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="/mbesportes/js/main.js"></script>
</body>
</html>