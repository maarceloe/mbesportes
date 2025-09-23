<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../php/config.php';

// Verifica se é admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}

// Busca todos os produtos com JOIN para categoria, time e qualidade
$sql = "SELECT p.*, c.nome AS categoria_nome, t.nome AS time_nome, q.qualidade AS qualidade_nome
        FROM produtos p
        JOIN categorias c ON p.categoria_id = c.id_categoria
        JOIN times t ON p.time_id = t.time_id
        JOIN qualidades q ON p.qualidade_id = q.id_qualidade
        ORDER BY p.id DESC";

$result = mysqli_query($conexao, $sql);
$produtos = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $produtos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MB Esportes | Funções do ADM</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">
    <?php include '../includes/navbar_index.php'; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'excluido'): ?>
        <div id="alertSucesso" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
            Produto excluído com sucesso!
        </div>
    <?php endif; ?>

    <div class="flex items-center justify-between p-2">
        <button type="button" onclick="window.location.href='/mbesportes/index.php'"
            class="w-12 h-12 ml-2 flex items-center justify-center rounded-full bg-[#ed3814] text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-[#ed3814] cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <div class="flex-1 text-center justify-center items-center">
            <h1 class="text-3xl font-bold">Funções do ADM</h1>
        </div>

        <button type="button" onclick="window.location.href='/mbesportes/pages/cadastro_produtos.php'"
            class="w-12 h-12 mr-2 flex items-center justify-center rounded-full bg-green-600 text-white shadow-xl transition-transform duration-300 hover:scale-110 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 cursor-pointer">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M16 6 V26" stroke="white" stroke-width="4" stroke-linecap="round" />
                <path d="M6 16 H26" stroke="white" stroke-width="4" stroke-linecap="round" />
            </svg>
        </button>
    </div>

    <main class="flex flex-col items-center justify-start flex-1 p-4 w-full">
        <?php
        $sql = "SELECT p.*, t.nome as time_nome, c.nome as categoria_nome, q.qualidade, GROUP_CONCAT(tm.tamanho SEPARATOR ', ') AS tamanhos
                FROM produtos p
                LEFT JOIN times t ON p.time_id = t.time_id
                LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
                LEFT JOIN qualidades q ON p.qualidade_id = q.id_qualidade
                LEFT JOIN produtos_tamanhos pt ON pt.id_produto = p.id
                LEFT JOIN tamanhos tm ON tm.id_tamanho = pt.id_tamanho
                GROUP BY p.id
                ORDER BY p.id DESC";
        $result = mysqli_query($conexao, $sql);
        if ($result && mysqli_num_rows($result) > 0):
            while ($produto = mysqli_fetch_assoc($result)):
        ?>
                <?php
                // Verifica se o produto está favoritado pelo usuário logado
                $favoritado = false;
                if (isset($_SESSION['id_usuario'])) {
                    $id_usuario = intval($_SESSION['id_usuario']);
                    $id_produto = intval($produto['id']);
                    $sql_fav = "SELECT 1 FROM favoritos WHERE id_usuario = $id_usuario AND id_produto = $id_produto LIMIT 1";
                    $res_fav = mysqli_query($conexao, $sql_fav);
                    $favoritado = mysqli_num_rows($res_fav) > 0;
                }
                ?>
                <div class="flex flex-row gap-4 bg-white border border-gray-300 p-5 mx-48 rounded-lg text-center shadow-xl transform transition-transform duration-500">
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
                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" loading="lazy" class=" w-fit max-h-[150px] object-contain rounded-md">
                    <h3 class="text-base"><?= htmlspecialchars($produto['nome']) ?></h3>
                    <p class="text-base text-gray-800"><span class="font-semibold">Categoria </span><span><?= htmlspecialchars($produto['categoria_nome']) ?></span></p>
                    <p class="text-base text-gray-800"><span class="font-semibold">Time: </span><span><?= htmlspecialchars($produto['time_nome']) ?></span></p>
                    <p class="text-base text-gray-800">
                        <span class="font-semibold">Tamanhos disponíveis: </span><span><?= htmlspecialchars($produto['tamanhos'] ?? '—') ?></span>
                    </p>
                    <p class="text-base text-gray-800"><span class="font-semibold">Qualidade: </span><span><?= htmlspecialchars($produto['qualidade']) ?></span></p>
                    <p class="text-base text-gray-800 text-left"><span class="font-semibold">Descrição: </span><span><?= htmlspecialchars($produto['descricao']) ?></span></p>

                    <!-- Botões de editar e excluir -->
                    <div class="flex flex-col gap-2 ml-auto">
                        <button type="button" onclick="window.location.href='/mbesportes/pages/edicao_produto.php?id=<?= $produto['id'] ?>'"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button type="button" data-id="<?= $produto['id'] ?>" data-nome="<?= htmlspecialchars($produto['nome'], ENT_QUOTES) ?>"
                            class="btn-delete-product w-10 h-10 flex items-center justify-center rounded-full bg-red-600 text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                    </div>
                <?php endwhile;
        else: ?>
                <p class="col-span-4 text-center text-gray-500">Nenhum produto cadastrado.</p>
            <?php endif; ?>
                </div>

                </div>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../js/main.js"></script>
</body>

</html>