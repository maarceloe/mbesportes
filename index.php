<?php
//index.php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Vitrine</title>
  <link rel="stylesheet" href="css/output.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
  <script src="/js/main.js"></script>
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">

  <!-- NAVBAR -->
  <?php include 'includes/navbar_index.php'; ?>

  <!-- BANNER / HERO -->
  <header class="hero text-white mt-[-10px] p-16 text-center rounded-lg shadow-lg">
    <h1 class="text-5xl mb-4 font-bold">Bem-vindo à MB Esportes</h1>
    <p class="text-xl">Confira os melhores produtos esportivos em destaque!</p>
  </header>

  <!-- PRODUTOS -->
  <main class="flex-1">
    <section class="max-w-[1200px] mx-auto px-5 py-10">
      <h2 class="text-3xl text-center mb-16 relative z-10">Produtos em Destaque</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center">
        <?php
        require_once 'php/config.php';
        $sql = "SELECT p.*, t.nome as time_nome, c.nome as categoria_nome, q.qualidade, tm.tamanho FROM produtos p
                LEFT JOIN times t ON p.time_id = t.time_id
                LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
                LEFT JOIN qualidades q ON p.qualidade_id = q.id_qualidade
                LEFT JOIN tamanhos tm ON p.tamanho_id = tm.id_tamanho
                ORDER BY p.id DESC LIMIT 12";
        $result = mysqli_query($conexao, $sql);
        if ($result && mysqli_num_rows($result) > 0):
          while ($produto = mysqli_fetch_assoc($result)):
        ?>
            <div class="relative bg-white border border-gray-300 p-5 rounded-lg text-center shadow-lg transform transition-transform duration-500 hover:scale-110">
              <a href="view.php?id=<?= $produto['id'] ?>">
                <img src="<?= !empty($produto['imagem']) ? htmlspecialchars($produto['imagem']) : 'assets/imgs/bola.png' ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" class="w-full max-h-[180px] object-contain mb-4 rounded-md">
                <h3 class="font-semibold text-lg mb-2"><?= htmlspecialchars($produto['nome']) ?></h3>
                <p class="text-sm text-gray-600 mb-2">Categoria: <?= htmlspecialchars($produto['categoria_nome']) ?></p>
                <p class="text-sm text-gray-600 mb-2">Time: <?= htmlspecialchars($produto['time_nome']) ?></p>
                <p class="text-sm text-gray-600 mb-2">Tamanho: <?= htmlspecialchars($produto['tamanho']) ?></p>
                <p class="text-sm text-gray-600 mb-2">Qualidade: <?= htmlspecialchars($produto['qualidade']) ?></p>
                <p class="text-sm text-gray-700 mb-2"><?= htmlspecialchars($produto['descricao']) ?></p>
              </a>
              <button class="btn-favorito absolute top-2 right-2 w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-md transition-transform duration-300 hover:scale-125 active:scale-95" onclick="verificaLogin(this)">
                <span class="heart-icon text-lg">🤍</span>
              </button>
            </div>
          <?php endwhile;
        else: ?>
          <p class="col-span-4 text-center text-gray-500">Nenhum produto cadastrado.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include 'includes/footer.php'; ?>

  <script>
    window.usuarioLogado = <?php echo json_encode(isset($_SESSION['id_usuario'])); ?>;
    console.log('usuarioLogado:', window.usuarioLogado);
  </script>
  <script src="js/main.js?v=<?= time() ?>"></script>
</body>

</html>