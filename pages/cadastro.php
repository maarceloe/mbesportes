<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Cadastro</title>
  <link rel="stylesheet" href="../css/output.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 font-Sf Pro Display">
  <main class="flex-grow flex items-center justify-center">
    <form action="../php/cadastrar.php" method="POST" 
      class="bg-white rounded shadow-md border border-gray-300 px-8 pt-8 pb-12 space-y-8">
      
      <h2 class="text-2xl font-bold text-center mb-6">Cadastro</h2>
      

      <!-- Nome -->
      <div class="mb-6">
        <label for="nome" class="block text-gray-700 mb-3">Nome Completo</label>
        <input type="text" id="nome" name="nome" required 
          class="w-full px-5 py-3 border rounded-full focus:outline-none ">
      </div>

      <!-- Email -->
      <div class="mb-6">
        <label for="email" class="block text-gray-700 mb-3">Email</label>
        <input type="email" id="email" name="email" required 
          class="w-full px-5 py-3 border rounded-full focus:outline-none">
      </div>

      <!-- Senha -->
      <div class="mb-8">
        <label for="senha" class="block text-gray-700 mb-3">Senha</label>
        <input type="password" id="senha" name="senha" required 
          class="w-full px-5 py-3 border rounded-full focus:outline-none ">
      </div>

      <!-- Botão -->
      <button type="submit" 
        class="w-full bg-[#001329] text-white font-semibold py-2 px-4 hover:bg-blue-700 transition rounded-full">
        Cadastrar
      </button>
    </form>
  </main>

  <!-- FOOTER -->
  <?php include '../includes/footer.php'; ?>
</body>
</html>
