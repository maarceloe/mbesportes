<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="sticky top-0 z-50 flex justify-between items-center bg-[#001329] px-8 py-4 shadow-md h-[130px]">
  <!-- Logo -->
  <div class="flex items-center gap-3">
    <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
      <img src="/mbesportes/assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-[100px] w-auto object-contain" />
      <span class="ml-2 text-[1.6rem] font-bold transition-colors duration-300 hover:text-[#ed3814]">MB ESPORTES</span>
    </a>
  </div>

  <!-- Links da navbar -->
  <ul class="flex gap-6 list-none items-center">
    <li><a href="/mbesportes/index.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Home</a></li>
    <li><a href="/mbesportes/pages/favoritos.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Favoritos</a></li>
    <li><a href="/mbesportes/pages/sobre.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Sobre</a></li>

    <?php if (isset($_SESSION['id_usuario'])): ?>
      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
        <li><a href="/mbesportes/pages/cadastro_produtos.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Cadastrar Produto</a></li>
      <?php endif; ?>
      <li class="flex items-center gap-2">
        <img src="/mbesportes/assets/icons/avatar.png" alt="Avatar" class="h-6 w-6">
        <span class="text-gray-200 font-semibold"><?= htmlspecialchars($_SESSION['nome']); ?></span>
        <a href="/mbesportes/php/logout.php" class="nav-link ml-4 text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Sair</a>
      </li>
    <?php else: ?>
      <!-- Usuário não logado: Login / Cadastro -->
      <li><a href="/mbesportes/pages/login.php" class="nav-link text-gray-300 font-medium transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Login</a></li>
      <li><a href="/mbesportes/pages/cadastro.php" class="nav-link rounded-full text-gray-300 font-medium transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Cadastro</a></li>
    <?php endif; ?>
  </ul>
</nav>