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

// Pega ID do produto
if (!isset($_GET['id'])) {
    header("Location: adm_fun.php");
    exit;
}
$id = intval($_GET['id']);

// Busca dados do produto
$sql = "SELECT * FROM produtos WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    header("Location: adm_fun.php");
    exit;
}

// Busca dados auxiliares
$categorias = mysqli_query($conexao, "SELECT id_categoria, nome FROM categorias ORDER BY nome ASC");
$times = mysqli_query($conexao, "SELECT time_id, nome FROM times ORDER BY nome ASC");
$qualidades = mysqli_query($conexao, "SELECT id_qualidade, qualidade FROM qualidades ORDER BY qualidade ASC");
$tamanhos_result = mysqli_query($conexao, "SELECT id_tamanho, tamanho FROM tamanhos ORDER BY id_tamanho ASC");

$tamanhos = [];
while ($row = mysqli_fetch_assoc($tamanhos_result)) {
    $tamanhos[] = $row;
}

// tamanhos do produto já cadastrados
$tamanhos_produto = [];
$res_tam = mysqli_query($conexao, "SELECT id_tamanho FROM produtos_tamanhos WHERE id_produto = $id");
while ($row = mysqli_fetch_assoc($res_tam)) {
    $tamanhos_produto[] = $row['id_tamanho'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MB Esportes | Edição Produto</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
    <script src="../js/main.js"></script>
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800">
    <?php include '../includes/navbar_index.php'; ?>

    <main class="flex items-start gap-4 px-4 mt-4">
        <div class="inline-flex max-w-fit items-center">
            <button type="button" onclick="window.location.href='adm_fun.php'"
                class="w-12 h-12 ml-2 flex items-center justify-center rounded-full bg-[#ed3814] text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-[#ed3814] cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <section class="flex-1 max-w-[800px] mx-auto px-5 py-10 bg-white rounded-[2vw] shadow-2xl border border-gray-400 mb-6">
            <h1 class="text-2xl font-bold mb-6">Edição de Produto</h1>

            <form id="produtoForm" action="../php/editar_produto.php" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 ">
                <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">

                <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required class="p-2 border rounded outline-none">

                <textarea name="descricao" required class="p-2 border rounded outline-none" spellcheck="false"><?= htmlspecialchars($produto['descricao']) ?></textarea>

                <input type="file" name="imagem" accept="image/*" class="p-2 border rounded outline-none">
                <p class="text-sm text-gray-500">Imagem atual: <?= htmlspecialchars($produto['imagem']) ?></p>

                <select name="categoria_id" required class="p-2 border rounded outline-none">
                    <?php mysqli_data_seek($categorias, 0); while ($cat = mysqli_fetch_assoc($categorias)): ?>
                        <option value="<?= $cat['id_categoria'] ?>" <?= $cat['id_categoria'] == $produto['categoria_id'] ? 'selected' : '' ?>>
                            <?= $cat['nome'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <select name="time_id" required class="p-2 border rounded outline-none">
                    <?php mysqli_data_seek($times, 0); while ($time = mysqli_fetch_assoc($times)): ?>
                        <option value="<?= $time['time_id'] ?>" <?= $time['time_id'] == $produto['time_id'] ? 'selected' : '' ?>>
                            <?= $time['nome'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <div class="relative">
                    <div id="tagsContainer" class="flex flex-wrap gap-2 p-2 border rounded cursor-default bg-white">
                        <input id="tagInput" readonly type="text" placeholder="Selecione um tamanho..." class="cursor-pointer flex-1 outline-none placeholder:text-gray-800">
                    </div>
                    <ul id="optionsList" class="absolute left-0 right-0 bg-white border mt-1 max-h-40 overflow-auto hidden z-10"></ul>
                </div>
                <input type="hidden" name="tamanho_id" id="hiddenTamanhos" value="<?= implode(',', $tamanhos_produto) ?>">

                <select name="qualidade_id" required class="p-2 border rounded outline-none">
                    <?php mysqli_data_seek($qualidades, 0); while ($q = mysqli_fetch_assoc($qualidades)): ?>
                        <option value="<?= $q['id_qualidade'] ?>" <?= $q['id_qualidade'] == $produto['qualidade_id'] ? 'selected' : '' ?>>
                            <?= $q['qualidade'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <button type="submit" class="text-gray-800 p-2 rounded-full border border-gray-800 hover:bg-[#ed3814] hover:border-[#ed3814] hover:text-white transition duration-350 ease-in-out">Salvar Alterações</button>
            </form>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script>
        const tamanhos = <?= json_encode($tamanhos) ?>;
        let selected = <?= json_encode($tamanhos_produto) ?>;

        const tagInput = document.getElementById('tagInput');
        const tagsContainer = document.getElementById('tagsContainer');
        const optionsList = document.getElementById('optionsList');
        const hiddenTamanhos = document.getElementById('hiddenTamanhos');

        function renderOptions() {
            optionsList.innerHTML = '';
            const filtered = tamanhos.filter(t => !selected.includes(t.id_tamanho));
            filtered.forEach(t => {
                const li = document.createElement('li');
                li.textContent = t.tamanho;
                li.className = 'p-2 hover:bg-gray-200 cursor-pointer';
                li.addEventListener('click', () => selectTag(t));
                optionsList.appendChild(li);
            });
            optionsList.style.display = filtered.length ? 'block' : 'none';
        }

        function selectTag(tag) {
            selected.push(tag.id_tamanho);
            renderTags();
            updateHidden();
            renderOptions();
        }

        function removeTag(id) {
            selected = selected.filter(tid => tid !== id);
            renderTags();
            updateHidden();
            renderOptions();
        }

        function renderTags() {
            tagsContainer.innerHTML = '';
            selected.forEach(id => {
                const t = tamanhos.find(tt => tt.id_tamanho == id);
                if (t) {
                    const span = document.createElement('span');
                    span.className = 'bg-gray-200 rounded-full pl-3 flex items-center gap-1 border';
                    span.innerHTML = `${t.tamanho} <button type="button" class="text-gray-800 font-bold cursor-pointer rounded-full px-4 py-2 hover:bg-gray-300 transition" onclick="removeTag(${id})">&times;</button>`;
                    tagsContainer.appendChild(span);
                }
            });
            tagsContainer.appendChild(tagInput);
        }

        function updateHidden() {
            hiddenTamanhos.value = selected.join(',');
            tagInput.placeholder = selected.length > 0 ? '' : 'Selecione um tamanho...';
        }

        renderTags();
        updateHidden();

        tagInput.addEventListener('focus', renderOptions);
        document.addEventListener('click', e => {
            if (!tagsContainer.contains(e.target)) optionsList.style.display = 'none';
        });
    </script>
</body>
</html>
