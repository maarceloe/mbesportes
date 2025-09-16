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
  <script src="/js/main.js"></script>
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 font-sfpro text-gray-800 opacity-0 transition-opacity duration-2500">

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

        <!-- CARD PRODUTO -->
        <?php for ($i = 0; $i < 6; $i++): ?>
          <div class="relative bg-white border border-gray-300 p-5 rounded-lg text-center shadow-lg transform transition-transform duration-500 hover:scale-110">
            <img src="assets/imgs/bola.png" alt="Bola de Futebol" class="w-full max-h-[180px] object-contain mb-4 rounded-md">
            <h3 class="font-semibold text-lg mb-2">Bola de Futebol Oficial</h3>
            <button class="btn-favorito absolute top-2 right-2 w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-md transition-transform duration-300 hover:scale-125 active:scale-95" onclick="verificaLogin(this)">
              <span class="heart-icon text-lg">🤍</span>
            </button>
          </div>
        <?php endfor; ?>

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