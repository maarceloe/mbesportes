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
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <!-- NAVBAR -->
  <?php include 'includes/navbar_index.php'; ?>

  <!-- BANNER -->
  <header class="hero">
    <h1>Bem-vindo à MB Esportes</h1>
    <p>Confira os melhores produtos esportivos em destaque!</p>
  </header>

  <!-- PRODUTOS -->
  <main>
    <section class="produtos">
      <h2>Produtos em Destaque</h2>
      <div class="grid-produtos">

        <!-- CARDS -->
        <div class="produto">
          <img src="assets/imgs/bola.png" alt="Bola de Futebol">
          <h3>Bola de Futebol Oficial</h3>
          <button class="btn-favorito" onclick="verificaLogin(this)">
            <span class="heart-icon">🤍</span>
          </button>
        </div>

        <div class="produto">
          <img src="assets/imgs/bola.png" alt="Bola de Futebol">
          <h3>Bola de Futebol Oficial</h3>
          <button class="btn-favorito" onclick="verificaLogin(this)">
            <span class="heart-icon">🤍</span>
          </button>
        </div>

        <div class="produto">
          <img src="assets/imgs/bola.png" alt="Bola de Futebol">
          <h3>Bola de Futebol Oficial</h3>
          <button class="btn-favorito" onclick="verificaLogin(this)">
            <span class="heart-icon">🤍</span>
          </button>
        </div>

        <div class="produto">
          <img src="assets/imgs/bola.png" alt="Bola de Futebol">
          <h3>Bola de Futebol Oficial</h3>
          <button class="btn-favorito" onclick="verificaLogin(this)">
            <span class="heart-icon">🤍</span>
          </button>
        </div>

        <div class="produto">
          <img src="assets/imgs/bola.png" alt="Bola de Futebol">
          <h3>Bola de Futebol Oficial</h3>
          <button class="btn-favorito" onclick="verificaLogin(this)">
            <span class="heart-icon">🤍</span>
          </button>
        </div>

        <div class="produto">
          <img src="assets/imgs/bola.png" alt="Bola de Futebol">
          <h3>Bola de Futebol Oficial</h3>
          <button class="btn-favorito" onclick="verificaLogin(this)">
            <span class="heart-icon">🤍</span>
          </button>
        </div>

      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include 'includes/footer.php'; ?>

  <script>
    window.usuarioLogado = <?php echo json_encode(isset($_SESSION['usuario_id'])); ?>;
    console.log('usuarioLogado:', window.usuarioLogado); // debug
  </script>

  <script src="js/main.js?v=<?= time() ?>"></script>
</body>

</html>