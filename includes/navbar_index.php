<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="sticky top-0 z-50 flex justify-between items-center bg-[#001329] px-8 py-4 shadow-md h-[130px]">
  <!-- Logo -->
  <div class="flex items-center gap-3">
    <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
      <img src="assets/imgs/logo_mbesportes.png" alt="MB Esportes" class="h-[100px] w-auto object-contain" />
      <span class="ml-2 text-[1.6rem] font-bold transition-colors duration-300 hover:text-[#ed3814]">MB ESPORTES</span>
    </a>
  </div>

  <!-- Links da navbar -->
  <ul class="flex gap-6 list-none">
    <li><a href="/mbesportes/index.php" class="text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Home</a></li>
    <li><a href="/mbesportes/pages/favoritos.php" class="text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Favoritos</a></li>
    <li><a href="/mbesportes/pages/sobre.php" class="text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Sobre</a></li>

    <?php if (isset($_SESSION['usuario_id'])): ?>
      <li><a href="/mbesportes/php/logout.php" class="text-red-600 font-semibold transition-colors duration-300 hover:text-red-400">Sair</a></li>
    <?php else: ?>
      <li><a href="/mbesportes/pages/login.php" class="text-gray-300 font-medium transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Login</a></li>
      <li><a href="/mbesportes/pages/cadastro.php" class="py-1 rounded-full text-gray-300 font-semibold transition-colors duration-300 hover:text-[#ed3814]">Cadastro</a></li>
    <?php endif; ?>
  </ul>
</nav>
