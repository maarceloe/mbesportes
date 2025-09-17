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
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MB Esportes | Cadastro Produto</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-100 transition-opacity duration-2500">

    <!-- NAVBAR -->
    <?php include '../includes/navbar_index.php'; ?>

    <!-- FORMULÁRIO DE CADASTRO -->
    <main class="flex-1">
        <section class="max-w-[800px] mx-auto px-5 py-10 bg-white rounded shadow-md">
            <h1 class="text-2xl font-bold mb-6">Cadastrar Produto</h1>

            <!-- Mensagem de sucesso -->
            <?php if (isset($_GET['success'])): ?>
                <p id="successMsg" class="mb-4 text-green-600 font-semibold">Produto cadastrado com sucesso!</p>
            <?php endif; ?>

            <form id="produtoForm" action="../php/cadastrar_produto.php" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                <input type="text" name="nome" placeholder="Nome do Produto" required class="p-2 border rounded outline-none">
                <textarea name="descricao" placeholder="Descrição" required class="p-2 border rounded outline-none"></textarea>
                <input type="file" name="imagem" accept="image/*" class="p-2 border rounded outline-none">

                <select name="categoria_id" required class="p-2 border rounded outline-none">
                    <option value="">Selecione a Categoria</option>
                    <?php
                    $cats = mysqli_query($conexao, "SELECT id_categoria, nome FROM categorias");
                    while ($cat = mysqli_fetch_assoc($cats)) {
                        echo "<option value='{$cat['id_categoria']}'>{$cat['nome']}</option>";
                    }
                    ?>
                </select>

                <select name="time_id" required class="p-2 border rounded outline-none">
                    <option value="">Selecione o Time</option>
                    <?php
                    $times = mysqli_query($conexao, "SELECT time_id, nome FROM times");
                    while ($time = mysqli_fetch_assoc($times)) {
                        echo "<option value='{$time['time_id']}'>{$time['nome']}</option>";
                    }
                    ?>
                </select>

                <select name="tamanho_id" required class="p-2 border rounded outline-none">
                    <option value="">Selecione o Tamanho</option>
                    <?php
                    $tamanhos = mysqli_query($conexao, "SELECT id_tamanho, tamanho FROM tamanhos");
                    while ($tam = mysqli_fetch_assoc($tamanhos)) {
                        echo "<option value='{$tam['id_tamanho']}'>{$tam['tamanho']}</option>";
                    }
                    ?>
                </select>

                <select name="qualidade_id" required class="p-2 border rounded outline-none">
                    <option value="">Selecione a Qualidade</option>
                    <?php
                    $qualidades = mysqli_query($conexao, "SELECT id_qualidade, qualidade FROM qualidades");
                    while ($q = mysqli_fetch_assoc($qualidades)) {
                        echo "<option value='{$q['id_qualidade']}'>{$q['qualidade']}</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="text-gray-800 p-2 rounded-full border border-gray-800 hover:bg-[#ed3814] hover:border-[#ed3814] hover:text-white transition duration-350 ease-in-out">Cadastrar</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php'; ?>
    <script src="../js/main.js"></script>
</body>

</html>