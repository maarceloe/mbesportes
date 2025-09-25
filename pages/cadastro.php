<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Cadastro</title>
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
      <form action="../php/cadastrar.php" method="post" class="flex flex-col w-[400px] rounded-xl p-10 bg-gradient-to-br from-[#001329] via-[#23466d] to-[#5079a7] text-white shadow-xl/30">
        <h1 class="text-3xl flex justify-center items-center mb-[20px]">Crie sua conta</h1>
        <label for="name" class="flex flex-col">
          Nome:
          <input type="text" id="name" name="name" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]" autocomplete="off">
        </label>

        <label for="email" class="flex flex-col">
          Email:
          <input type="email" id="email" name="email" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]" autocomplete="off">
        </label>

        <label for="senha" class="flex flex-col">
          Senha:
          <input type="password" id="senha" name="senha" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]" autocomplete="new-password">
        </label>

        <label for="confirmaSenha" class="flex flex-col">
          Confirme a senha:
          <input type="password" id="confirmaSenha" name="confirmaSenha" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]" autocomplete="new-password">
        </label>

        <button type="submit" class="border-2 border-gray-300 border-solid rounded-xl p-2 shadow-xl hover:bg-[#ed3814] hover:border-[#ed3814] transition-all duration-200 ease-in mt-[15px]">Criar conta</button>
        <div class="mt-[30px] flex justify-center">
          <a href="login.php" class="btn border-2 border-gray-300 border-solid hover:bg-[#ed3814] hover:border-[#ed3814] text-white rounded-full p-2 transition-all duration-200 ease-in">Já tenho uma conta</a>
        </div>

        <div class="mt-[15px] flex justify-center">
          <a href="../index.php" class="btn border-2 border-gray-300 border-solid hover:bg-[#ed3814] hover:border-[#ed3814] text-white rounded-full p-2 transition-all duration-200 ease-in">Continuar como visitante</a>
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
        <img src="../assets/imgs/logo_mbesportes_new_2.png" alt="MB Esportes" style="max-width:120px;display:block;margin:0 auto 18px;border-radius:18px;">
        <h2 id="modal-title" class="text-xl font-semibold mb-4">Titulo do modal</h2>
        <p id="modal-message" class="text-gray-700 mb-2">Mensagem do modal</p>
        <button id="modal-close" class="bg-[#ed3814] text-white px-4 py-2 rounded-xl hover:bg-[#d72f0f] transition-colors">Fechar</button>
      </div>
    </div>
  </section>



  <?php include '../includes/footer.php'; ?>
  <script src="..//js/main.js"></script>
</body>

</html>