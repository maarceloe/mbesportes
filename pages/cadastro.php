<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Cadastro</title>
  <link rel="stylesheet" href="../css/output.css">
</head>

<body class="font-sans w-screen h-screen">
  
  <section id="form" class="justify-center items-center flex flex-col">
    <h1 class="text-3xl flex justify-center items-center m-16">Crie sua conta</h1>
    <form action="login.php" class="flex flex-col">
      <label for="name">
        Nome:
        <input type="text" id="name" name="name" required class="border border-gray-200 rounded-full">
      </label>

      <label for="email">
        Email:
        <input type="email" id="email" name="email" required class="border border-gray-200 rounded-full">
      </label>

      <label for="senha">
        Senha:
        <input type="password" id="senha" name="senha" required class="border border-gray-200 rounded-full">
      </label>

      <button type="submit">Criar</button>
    </form>

  </section>   



  <?php include '../includes/footer.php'; ?>
</body>

</html>