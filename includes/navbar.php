<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="navbar">
  <div class="navbar-logo">
    <a href="/mbesportes/index.php" class="logo">
      <img src="..//assets/imgs/logo_mbesportes.png" alt="MB Esportes" />
      <span>MB ESPORTES</span>
    </a>
  </div>
  <ul class="navbar-links">
    <li><a href="/mbesportes/index.php">Home</a></li>
    <li><a href="/mbesportes/pages/favoritos.php">Favoritos</a></li>
    <li><a href="/mbesportes/pages/sobre.php">Sobre</a></li>

    <?php if (isset($_SESSION['usuario_id'])): ?>
      <li><a href="/mbesportes/php/logout.php" class="btn-logout">Sair</a></li>
    <?php else: ?>
      <li><a href="/mbesportes/pages/login.php">Login</a></li>
      <li><a href="/mbesportes/pages/cadastro.php" class="btn-cadastro">Cadastro</a></li>
    <?php endif; ?>
  </ul>
</nav>