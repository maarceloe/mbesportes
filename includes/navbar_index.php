<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="sticky top-0 z-50 flex justify-between items-center bg-[#001329] px-8 py-4 shadow-md h-[130px] rounded-b-2xl">

  <div class="flex items-center gap-3">
    <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
      <img src="/mbesportes/assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-[100px] w-auto object-contain" />
      <span class="ml-2 text-[1.6rem] font-bold transition-colors duration-300 hover:text-[#ed3814]">MB ESPORTES</span>
    </a>
  </div>
  <ul class="hidden md:flex gap-6 list-none items-center">
    <li><a href="/mbesportes/index.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Home</a></li>
    <?php if (isset($_SESSION['id_usuario'])): ?>
      <li><a href="/mbesportes/pages/favoritos.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Favoritos</a></li>
    <?php endif; ?>
    <li><a href="/mbesportes/pages/sobre.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Contatos</a></li>

    <?php if (isset($_SESSION['id_usuario'])): ?>
      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
        <li><a href="/mbesportes/pages/adm_fun.php" class="nav-link text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Funções ADM</a></li>
      <?php endif; ?>
      <li class="flex items-center gap-2">
        <img src="/mbesportes/assets/icons/avatar.png" alt="Avatar" class="h-6 w-6">
        <span class="text-gray-200 font-semibold"><?= htmlspecialchars($_SESSION['nome']); ?></span>
        <a href="/mbesportes/php/logout.php" class="nav-link ml-4 text-gray-300 font-medium relative transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Sair</a>
      </li>
    <?php else: ?>
      <li><a href="/mbesportes/pages/login.php" class="nav-link text-gray-300 font-medium transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Login</a></li>
      <li><a href="/mbesportes/pages/cadastro.php" class="nav-link rounded-full text-gray-300 font-medium transition-transform duration-200 hover:text-[#ed3814] hover:scale-110">Cadastro</a></li>
    <?php endif; ?>
  </ul>

  <!-- Mobile hamburger -->
  <div class="md:hidden flex items-center gap-2">
    <button id="nav-open" aria-label="Abrir menu" class="text-gray-200 p-2 bg-transparent rounded-md hover:bg-white/5">
      <!-- simple hamburger icon -->
      <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
  </div>

  <!-- Mobile drawer + overlay -->
  <div id="nav-overlay" style="opacity:0; pointer-events:none;" class="fixed inset-0 bg-black/40 backdrop-blur-xl transition-opacity duration-300 z-40"></div>
  <aside id="nav-drawer" style="transform: translateX(100%);" class="fixed right-0 top-0 h-full w-72 bg-[#001329] transition-transform duration-500 z-50 shadow-2xl">
    <div class="p-6 flex flex-col h-full">
      <div class="flex items-center justify-between mb-6">
        <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
          <img src="/mbesportes/assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-12 w-auto object-contain" />
          <span class="ml-2 text-lg font-bold">MB ESPORTES</span>
        </a>
        <button id="nav-close" aria-label="Fechar menu" class="text-gray-200 p-2 rounded-md hover:bg-white/5">
          <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <nav class="flex-1 overflow-auto">
        <ul class="flex flex-col gap-4">
          <li><a href="/mbesportes/index.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Home</a></li>
          <?php if (isset($_SESSION['id_usuario'])): ?>
            <li><a href="/mbesportes/pages/favoritos.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Favoritos</a></li>
          <?php endif; ?>
          <li><a href="/mbesportes/pages/sobre.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Contatos</a></li>
          <?php if (isset($_SESSION['id_usuario'])): ?>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
              <li><a href="/mbesportes/pages/adm_fun.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Funções ADM</a></li>
            <?php endif; ?>
            <li class="flex items-center gap-2">
              <img src="/mbesportes/assets/icons/avatar.png" alt="Avatar" class="h-6 w-6">
              <span class="text-gray-200 font-semibold"><?= htmlspecialchars($_SESSION['nome']); ?></span>
            </li>
            <li><a href="/mbesportes/php/logout.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Sair</a></li>
          <?php else: ?>
            <li><a href="/mbesportes/pages/login.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Login</a></li>
            <li><a href="/mbesportes/pages/cadastro.php" class="nav-link text-gray-200 font-medium hover:text-[#ed3814]">Cadastro</a></li>
          <?php endif; ?>
        </ul>
      </nav>
      <div class="mt-6">
        <p class="text-xs text-gray-400">© <?= date('Y') ?> MB Esportes</p>
      </div>
    </div>
  </aside>

  <script>
    (function() {
      const open = document.getElementById('nav-open');
      const close = document.getElementById('nav-close');
      const overlay = document.getElementById('nav-overlay');
      const drawer = document.getElementById('nav-drawer');

      function openNav() {
        drawer.style.transform = 'translateX(0)';
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
      }

      function closeNav() {
        drawer.style.transform = 'translateX(100%)';
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0', 'pointer-events-none');
      }

      open?.addEventListener('click', openNav);
      close?.addEventListener('click', closeNav);
      overlay?.addEventListener('click', closeNav);
      // close on Esc
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeNav();
      });
    })();
  </script>
</nav>