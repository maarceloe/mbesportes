<?php
// index.php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Vitrine</title>
  <link rel="stylesheet" href="css/output.css">

  <style>
    /* Scrollbar personalizada */
    body::-webkit-scrollbar {
      width: 8px;
      background: none;
    }

    body::-webkit-scrollbar-thumb {
      background: #333;
      border-radius: 8px;
    }

    body::-webkit-scrollbar-thumb:hover {
      background: #646464;
    }

    /* Animações */
    @keyframes hero-gradient-roll {
      0% { background-position: 0% 50%; }
      100% { background-position: 200% 50%; }
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Hero gradient animation */
    .hero {
      background: linear-gradient(270deg, #001329, #23466d, #5079a7, #23466d, #001329);
      background-size: 200% 100%;
      animation: hero-gradient-roll 8s linear infinite;
    }

    .hero h1 { opacity: 0; animation: fadeInDown 1s ease forwards; }
    .hero p { opacity: 0; animation: fadeInUp 1s ease forwards; animation-delay: 0.5s; }

    /* Navbar hover underline animation */
    .nav-link {
      position: relative;
      display: inline-block;
      padding-bottom: 2px;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: white;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }
  </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 font-sfpro text-gray-800">

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
    window.usuarioLogado = <?php echo json_encode(isset($_SESSION['usuario_id'])); ?>;
    console.log('usuarioLogado:', window.usuarioLogado);
  </script>
  <script src="js/main.js?v=<?= time() ?>"></script>
</body>

</html>