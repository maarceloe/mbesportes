<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Cadastro</title>
  <link rel="stylesheet" href="../css/output.css">
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
  <main class="flex-grow flex items-center justify-center">
    <form action="../php/cadastrar.php" method="POST" 
      class="bg-white rounded shadow-md w-full max-w-md px-8 py-8 border border-gray-300">
      
      <h2 class="text-2xl font-bold mb-6 text-center">Cadastro</h2>
      
      <!-- Nome -->
      <div class="mb-4">
        <label for="nome" class="block text-gray-700 mb-2">Nome Completo</label>
        <input type="text" id="nome" name="nome" required 
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 mb-2">Email</label>
        <input type="email" id="email" name="email" required 
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Senha -->
      <div class="mb-6">
        <label for="senha" class="block text-gray-700 mb-2">Senha</label>
        <input type="password" id="senha" name="senha" required 
          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Botão -->
      <button type="submit" 
        class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
        Cadastrar
      </button>
    </form>
  </main>

  <!-- FOOTER -->
  <?php include '../includes/footer.php'; ?>
</body>
</html>
