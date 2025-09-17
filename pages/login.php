<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Login</title>
  <link rel="stylesheet" href="../css/output.css">
  <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
</head>

<body class="font-sans w-screen min-h-screen flex flex-col bg-[#001329dc] opacity-0 transition-opacity duration-2500">
  
  <section id="form" class="flex-1 grid grid-cols-3 items-center justify-center w-full">
    <div class="flex justify-center">
      <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
        <img src="../assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-[150px] w-auto hidden md:block" />
      </a>
    </div>
    <div class="flex justify-center">
      <form action="../php/fazer_login.php" method="post" class="flex flex-col w-[400px] rounded-xl p-10 bg-gradient-to-br from-[#001329] via-[#23466d] to-[#5079a7] text-white shadow-xl/30">
        <h1 class="text-3xl flex justify-center items-center mb-[20px]">Faça seu login</h1>
        <label for="login" class="flex flex-col">
          Email ou Nome de usuário:
          <input type="text" id="login" name="login" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]" autocomplete="off">
        </label>

        <label for="senha" class="flex flex-col">
          Senha:
          <input type="password" id="senha" name="senha" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]" autocomplete="off">
        </label>

        <div class="mb-[10px] flex justify-end">
          <a href="#" class="underline">Esqueci minha senha</a>
        </div>
        <button type="submit" class="border-2 border-gray-300 border-solid rounded-xl p-2 shadow-xl hover:bg-[#ed3814] hover:border-[#ed3814] transition-all duration-200 ease-in">Logar</button>
        <div class="mt-[30px] flex justify-center">
          <a href="cadastro.php" class="btn border-2 border-gray-300 border-solid hover:bg-[#ed3814] hover:border-[#ed3814] text-white rounded-full p-2 transition-all duration-200 ease-in">Não tenho uma conta</a>
        </div>
      </form>
    </div>
    <div class="flex justify-center">
      <a href="/mbesportes/index.php" class="flex items-center text-white no-underline">
        <img src="../assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-[150px] w-auto hidden md:block" />
      </a>
    </div>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
      <div class="bg-white rounded-xl p-8 text-center w-[300px] max-w-full shadow-lg">
        <img src="../assets/imgs/logo_mbesportes new 2.png" alt="MB Esportes" style="max-width:120px;display:block;margin:0 auto 18px;border-radius:18px;">
        <h2 id="modal-title" class="text-xl font-semibold mb-4">Logado!</h2>
        <p id="modal-message" class="text-gray-800 mb-2">Seja bem-vindo</p>
        <p id="modal-message" class="text-gray-800 mb-2">Aproveite e desfrute do catálogo da MB Esportes</p>
        <p id="modal-message" class="text-gray-800 mb-4">Você será redirecionado para a tela principal do site.</p>
        <button id="modal-close" class="bg-[#ed3814] text-white px-4 py-2 rounded-xl hover:bg-[#d72f0f] transition-colors">Fechar</button>
      </div>
  </section>

  

  <?php include '../includes/footer.php'; ?>
  <script src="..//js/main.js"></script>
</body>

</html>