<?php
session_start();
include '../php/config.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Puxa apenas os produtos favoritados pelo usuário
$sql = "SELECT p.*, t.nome as time_nome, c.nome as categoria_nome, q.qualidade, GROUP_CONCAT(tm.tamanho SEPARATOR ', ') AS tamanhos
        FROM produtos p
        INNER JOIN favoritos f ON p.id = f.id_produto
        LEFT JOIN times t ON p.time_id = t.time_id
        LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
        LEFT JOIN qualidades q ON p.qualidade_id = q.id_qualidade
        LEFT JOIN produtos_tamanhos pt ON pt.id_produto = p.id
        LEFT JOIN tamanhos tm ON tm.id_tamanho = pt.id_tamanho
        WHERE f.id_usuario = ?
        GROUP BY p.id
        ORDER BY p.id DESC";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>MB Esportes | Meus Favoritos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/mbesportes/css/output.css">
    <link rel="stylesheet" href="/mbesportes/css/custom.css">
    <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
    <script src="/mbesportes/js/main.js" defer></script>
    <script>
        window.usuarioLogado = <?php echo json_encode(isset($_SESSION['id_usuario'])); ?>;
    </script>
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">

    <?php include '../includes/navbar_index.php'; ?>

    <main class="flex-1">
        <div class="flex items-center gap-4 px-5 py-4">
            <button type="button" onclick="window.location.href='/mbesportes/index.php'"
                class="w-12 h-12 ml-2 flex items-center justify-center rounded-full bg-[#ed3814] text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-[#ed3814] cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="flex-1 text-center text-3xl font-bold mb-0">Meus Favoritos</h1>
        </div>


        <section class="max-w-[1200px] mx-auto px-5 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($produto = $result->fetch_assoc()): ?>
                        <?php
                        $favoritado = true; // já são todos favoritados

                        $defaultFallback = '/mbesportes/assets/imgs/bola.png';
                        if (!empty($produto['imagem'])) {
                            $val = trim($produto['imagem']);
                            if (preg_match('#^https?://#i', $val)) {
                                $imgSrc = htmlspecialchars($val);
                            } else {
                                $imgSrc = '/mbesportes/assets/imgs/produtos/' . htmlspecialchars($val);
                            }
                        } else {
                            $imgSrc = $defaultFallback;
                        }
                        ?>
                        <div class="relative bg-white border border-gray-300 p-5 rounded-lg text-center shadow-lg transform transition-transform duration-500 hover:scale-110">
                            <a href="/mbesportes/pages/view_card.php?id=<?= $produto['id'] ?>">
                                <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" loading="lazy" class="w-full max-h-[180px] object-contain mb-4 rounded-md">
                                <h3 class="font-semibold text-lg mb-2"><?= htmlspecialchars($produto['nome']) ?></h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    Tamanhos disponíveis: <?= htmlspecialchars($produto['tamanhos'] ?? '—') ?>
                                </p>
                                <p class="text-sm text-gray-600 mb-2">Qualidade: <?= htmlspecialchars($produto['qualidade']) ?></p>
                            </a>
                            <button
                                class="btn-favorito absolute top-2 right-2 w-10 h-10 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 hover:scale-125 active:scale-95 border-2 border-gray-300 cursor-pointer favoritado bg-white"
                                data-produto-id="<?= $produto['id'] ?>">
                                <span class="heart-icon text-lg">❤️</span>
                            </button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="col-span-4 text-center text-gray-500">Você ainda não favoritou nenhum produto.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>