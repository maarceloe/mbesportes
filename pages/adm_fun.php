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
    <script src="../js/main.js"></script>
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">
    <?php include '../includes/navbar_index.php'; ?>

    <div class="flex items-center justify-between p-2">
        <!-- Botão esquerdo (seta de voltar) -->
        <button type="button" onclick="window.location.href='/mbesportes/index.php'"
            class="w-12 h-12 flex items-center justify-center rounded-full bg-[#ed3814] text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-[#ed3814]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <div class="flex-1 text-center justify-center items-center">
            <h1 class="text-3xl font-bold">Funções do ADM</h1>
        </div>

        <!-- Botão direito (símbolo de adição) -->
        <button type="button" onclick="window.location.href='/mbesportes/pages/cadastro_produtos.php'"
            class="w-12 h-12 flex items-center justify-center rounded-full bg-green-600 text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M16 6 V26" stroke="white" stroke-width="4" stroke-linecap="round" />
                <path d="M6 16 H26" stroke="white" stroke-width="4" stroke-linecap="round" />
            </svg>
        </button>
    </div>

    <main class="flex flex-col items-center justify-start flex-1 p-4 w-full">
        <?php if (count($produtos) === 0): ?>
            <p class="text-gray-500">Nenhum produto cadastrado.</p>
        <?php else: ?>
            <?php foreach ($produtos as $produto): ?>
                <div class="flex flex-row justify-between items-center bg-white shadow rounded p-4 mb-4 w-full max-w-4xl">
                    <!-- Informações do produto -->
                    <div class="flex flex-row justify-between items-center bg-white shadow rounded-lg p-3 mb-4 w-full max-w-5xl">

                        <!-- Imagem do produto -->
                        <div class="flex-shrink-0">
                            <?php if ($produto['imagem']): ?>
                                <img src="/mbesportes/assets/imgs/produtos/<?php echo htmlspecialchars($produto['imagem']); ?>"
                                    alt="<?php echo htmlspecialchars($produto['nome']); ?>"
                                    class="w-20 h-20 object-cover rounded-lg">
                            <?php else: ?>
                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-xs">
                                    Sem imagem
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Informações do produto -->
                        <div class="flex flex-col justify-center flex-1 px-4 space-y-0.5 text-sm">
                            <span class="font-semibold text-base"><?php echo htmlspecialchars($produto['nome']); ?></span>
                            <span class="text-gray-600">Categoria: <?php echo htmlspecialchars($produto['categoria_nome']); ?></span>
                            <span class="text-gray-600">Time: <?php echo htmlspecialchars($produto['time_nome']); ?></span>
                            <span class="text-gray-600">Qualidade: <?php echo htmlspecialchars($produto['qualidade_nome']); ?></span>
                            <span class="text-gray-600">Descrição: <?php echo htmlspecialchars($produto['descricao']); ?></span>
                        </div>

                        <!-- Botões de ação -->
                        <div class="flex flex-col space-y-2 ml-4">
                            <!-- Editar -->
                            <button type="button" onclick="window.location.href='/mbesportes/pages/editar_produto.php?id=<?php echo $produto['id']; ?>'"
                                class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487a2.121 2.121 0 113 3L7 20H4v-3L16.862 4.487z" />
                                </svg>
                            </button>

                            <!-- Deletar -->
                            <button type="button" onclick="if(confirm('Deseja realmente deletar este produto?')) window.location.href='/mbesportes/pages/deletar_produto.php?id=<?php echo $produto['id']; ?>'"
                                class="flex items-center justify-center w-9 h-9 rounded-full bg-red-600 text-white hover:bg-red-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>