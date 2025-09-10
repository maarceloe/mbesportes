<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Login</title>
  <link rel="stylesheet" href="../css/output.css">
</head>

<body class="font-sans w-screen min-h-screen flex flex-col bg-[#001329dc]">
  
  <section id="form" class="flex-1 grid grid-cols-3 items-center justify-center w-full">
    <div class="flex justify-center">
      <img src="../assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-[150px] w-auto hidden md:block" />
    </div>
    <form action="../index.php" class="flex flex-col w-[400px] rounded-xl p-10 bg-gradient-to-br from-[#001329] via-[#23466d] to-[#5079a7] text-white shadow-xl/30">
      <h1 class="text-3xl flex justify-center items-center mb-[20px]">Faça seu login</h1>
      <label for="email" class="flex flex-col">
        Email:
        <input type="email" id="email" name="email" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]">
      </label>

      <label for="senha" class="flex flex-col">
        Senha:
        <input type="password" id="senha" name="senha" required class="border-2 border-gray-300 border-solid rounded-xl py-1 px-2 outline-none appearance-none focus:border-[#ed3814] transition duration-350 ease-in-out mb-[20px]">
      </label>

  <div class="mb-[10px] flex justify-end">
    <a href="#" class="underline">Esqueci minha senha</a>
  </div>
      <button type="submit" class="border-2 border-gray-300 border-solid rounded-xl p-2 shadow-xl hover:bg-[#ed3814] hover:border-[#ed3814] transition-all duration-200 ease-in">Logar</button>
  <div class="mt-[30px] flex justify-center">
    <a href="cadastro.php" class="underline">Não tenho uma conta</a>
  </div>
    </form>
    <div class="flex justify-center">
      <img src="../assets/imgs/logo_mbesportes.png" alt="Logo MB Esportes" class="h-[150px] w-auto hidden md:block" />
    </div>
  </section>



  <?php include '../includes/footer.php'; ?>
</body>

</html>