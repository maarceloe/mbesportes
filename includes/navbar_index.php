<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<nav class="sticky top-0 z-50 bg-[#001329] shadow-md">
  <div class="max-w-[1200px] mx-auto flex justify-between items-center px-4 py-3 sm:py-4">
    <!-- Logo -->
    <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
      <img src="/mbesportes/assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-12 sm:h-16 md:h-20 lg:h-24 w-auto object-contain">
      <span class="ml-2 text-[1.4rem] sm:text-[1.6rem] font-bold transition-colors duration-300 hover:text-[#ed3814]">MB ESPORTES</span>
    </a>

    <!-- Botão hamburguer (mobile) -->
    <button id="menu-btn" class="sm:hidden text-white text-2xl focus:outline-none relative z-50">
      <span id="hamburger-icon">☰</span>
    </button>

    <!-- Menu links -->
    <ul id="menu" class="hidden sm:flex gap-6 list-none items-center">
      <li><a href="/mbesportes/index.php" class="nav-link text-gray-300 font-medium transition hover:text-[#ed3814]">Home</a></li>
      <?php if (isset($_SESSION['id_usuario'])): ?>
        <li><a href="/mbesportes/pages/favoritos.php" class="nav-link text-gray-300 font-medium transition hover:text-[#ed3814]">Favoritos</a></li>
      <?php endif; ?>
      <li><a href="/mbesportes/pages/sobre.php" class="nav-link text-gray-300 font-medium transition hover:text-[#ed3814]">Contatos</a></li>

      <?php if (isset($_SESSION['id_usuario'])): ?>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
          <li><a href="/mbesportes/pages/adm_fun.php" class="nav-link text-gray-300 font-medium transition hover:text-[#ed3814]">Funções ADM</a></li>
        <?php endif; ?>
        <li class="flex items-center gap-2">
          <img src="/mbesportes/assets/icons/avatar.png" alt="Avatar" class="h-6 w-6">
          <span class="text-gray-200 font-semibold"><?= htmlspecialchars($_SESSION['nome']); ?></span>
          <a href="/mbesportes/php/logout.php" class="ml-4 text-gray-300 font-medium transition hover:text-[#ed3814]">Sair</a>
        </li>
      <?php else: ?>
        <li><a href="/mbesportes/pages/login.php" class="nav-link text-gray-300 font-medium transition hover:text-[#ed3814]">Login</a></li>
        <li><a href="/mbesportes/pages/cadastro.php" class="nav-link rounded-full text-gray-300 font-medium transition hover:text-[#ed3814]">Cadastro</a></li>
      <?php endif; ?>
    </ul>
  </div>

  <!-- Menu Mobile (vertical) -->
  <div id="mobile-menu" class="fixed top-0 left-0 w-full h-screen bg-[#001329] flex flex-col items-center justify-center gap-6 text-lg text-gray-300 hidden z-40 sm:hidden">
    <a href="/mbesportes/index.php" class="transition hover:text-[#ed3814]">Home</a>
    <?php if (isset($_SESSION['id_usuario'])): ?>
      <a href="/mbesportes/pages/favoritos.php" class="transition hover:text-[#ed3814]">Favoritos</a>
    <?php endif; ?>
    <a href="/mbesportes/pages/sobre.php" class="transition hover:text-[#ed3814]">Contatos</a>
    <?php if (isset($_SESSION['id_usuario']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
      <a href="/mbesportes/pages/adm_fun.php" class="transition hover:text-[#ed3814]">Funções ADM</a>
    <?php endif; ?>
    <?php if (isset($_SESSION['id_usuario'])): ?>
      <div class="flex flex-col items-center gap-2">
        <img src="/mbesportes/assets/icons/avatar.png" alt="Avatar" class="h-8 w-8">
        <span class="font-semibold text-gray-200"><?= htmlspecialchars($_SESSION['nome']); ?></span>
        <a href="/mbesportes/php/logout.php" class="transition hover:text-[#ed3814]">Sair</a>
      </div>
    <?php else: ?>
      <a href="/mbesportes/pages/login.php" class="transition hover:text-[#ed3814]">Login</a>
      <a href="/mbesportes/pages/cadastro.php" class="transition hover:text-[#ed3814]">Cadastro</a>
    <?php endif; ?>
  </div>
</nav>

<script>
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const hamburgerIcon = document.getElementById('hamburger-icon');

  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    // Troca o ícone ☰ <-> X
    hamburgerIcon.textContent = mobileMenu.classList.contains('hidden') ? '☰' : '✖';
  });
</script>
