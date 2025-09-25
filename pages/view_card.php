<?php
// view_card.php
session_start();
require_once '../php/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo '<p class="text-center text-red-500 mt-10">Produto não encontrado.</p>';
    exit;
}

$sql = "SELECT p.*, t.nome as time_nome, c.nome as categoria_nome, q.qualidade FROM produtos p
    LEFT JOIN times t ON p.time_id = t.time_id
    LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
    LEFT JOIN qualidades q ON p.qualidade_id = q.id_qualidade
    LEFT JOIN produtos_tamanhos pt ON p.id = pt.id_produto
    WHERE p.id = $id LIMIT 1";
$result = mysqli_query($conexao, $sql);
$produto = mysqli_fetch_assoc($result);

// Buscar tamanhos do produto
$tamanhos = [];
$sql_tam = "SELECT tm.tamanho FROM produtos_tamanhos pt LEFT JOIN tamanhos tm ON tm.id_tamanho = pt.id_tamanho WHERE pt.id_produto = $id ORDER BY tm.id_tamanho ASC";
$result_tam = mysqli_query($conexao, $sql_tam);
while ($row = mysqli_fetch_assoc($result_tam)) {
    $tamanhos[] = $row['tamanho'];
}
$result = mysqli_query($conexao, $sql);
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    echo '<p class="text-center text-red-500 mt-10">Produto não encontrado.</p>';
    exit;
}

// Buscar informações da seção "Sobre nós"
$sql = "SELECT descricao, telefone, email, instagram, facebook, whatsapp FROM sobre";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

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
    <script src="/mbesportes/js/main.js"></script>
</head>

<body class="font-sans min-h-screen flex flex-col bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">
    <?php include '../includes/navbar_index.php'; ?>
    <!-- Botão de voltar no canto superior esquerdo -->
    <div class="w-full flex items-start p-2">
        <button type="button" onclick="window.location.href='/mbesportes/index.php'"
            class="w-12 h-12 ml-2 flex items-center justify-center rounded-full bg-[#ed3814] text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-[#ed3814] cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
    </div>
    <main class="flex-1 flex flex-col items-center justify-center py-10">
        <section class="w-full max-w-4xl mx-auto">
            <?php
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
            <div class="flex flex-col md:flex-row items-center md:items-start gap-10">
                <div class="flex-shrink-0 flex justify-center items-center w-full md:w-[50%]">
                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" loading="lazy" class="w-full max-w-[500px] max-h-[500px] object-contain rounded-xl">
                </div>
                <div class="w-full md:w-[50%] flex flex-col justify-start items-start">
                    <h2 class="font-bold text-3xl mb-4 text-gray-900 text-left w-full"><?= htmlspecialchars($produto['nome']) ?></h2>
                    <p class="text-base text-gray-800 mb-2">Categoria: <span class="font-semibold"><?= htmlspecialchars($produto['categoria_nome']) ?></span></p>
                    <p class="text-base text-gray-800 mb-2">Time: <span class="font-semibold"><?= htmlspecialchars($produto['time_nome']) ?></span></p>
                    <p class="text-base text-gray-800 mb-2">Tamanhos disponíveis:
                        <span class="font-semibold">
                            <?= $tamanhos ? htmlspecialchars(implode(', ', $tamanhos)) : '—' ?>
                        </span>
                    </p>
                    <p class="text-base text-gray-800 mb-2">Qualidade: <span class="font-semibold"><?= htmlspecialchars($produto['qualidade']) ?></span></p>
                    <p class="text-base text-gray-800 mb-6 text-left w-full"><?= htmlspecialchars($produto['descricao']) ?></p>
                    <?php
                    // Verifica se o usuário está logado e se o produto está favoritado
                    $favoritado = false;
                    if (isset($_SESSION['id_usuario'])) {
                        $id_usuario = intval($_SESSION['id_usuario']);
                        $id_produto = intval($produto['id']);
                        $sql_fav = "SELECT 1 FROM favoritos WHERE id_usuario = $id_usuario AND id_produto = $id_produto LIMIT 1";
                        $res_fav = mysqli_query($conexao, $sql_fav);
                        $favoritado = mysqli_num_rows($res_fav) > 0;
                    }
                    ?>
                    <button
                        class="btn-favorito mt-2 px-6 py-2 rounded-full text-gray-800 font-semibold shadow-xl border-2 border-gray-300 transition duration-300 flex items-center justify-center text-lg hover:text-white hover:border-[#ed3814] <?= $favoritado ? 'favoritado bg-white' : 'bg-white' ?>"
                        style="min-width:150px; min-height:48px;"
                        data-produto-id="<?= $produto['id'] ?>"
                        onclick="verificaLogin(this)">
                        <span class="heart-icon text-2xl"><?= $favoritado ? '❤️' : '🤍' ?></span>
                    </button>
                    <a href="<?php echo $row['whatsapp']; ?>" target="_blank"
                        class="px-4 py-2 mt-4 bg-green-600 text-white rounded-full hover:bg-green-700 transition duration-300 hover:scale-110 shadow-xl">
                        Falar no WhatsApp
                    </a>
                </div>
            </div>
        </section>
    </main>
    <?php include '../includes/footer.php'; ?>

    <script>
        window.usuarioLogado = <?php echo json_encode(isset($_SESSION['id_usuario'])); ?>;
        console.log('usuarioLogado:', window.usuarioLogado);
    </script>

    <script>
        window.addEventListener("load", () => {
            document.body.classList.add("opacity-100");
        });
    </script>
</body>

</html>