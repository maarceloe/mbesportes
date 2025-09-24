<?php
// index.php
session_start();
require_once 'php/config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MB Esportes | Catálogo</title>
  <link rel="stylesheet" href="css/output.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
  <script src="js/main.js"></script>
</head>

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">

  <!-- NAVBAR -->
  <?php include 'includes/navbar_index.php'; ?>

  <!-- BANNER -->
  <header class="hero relative text-white p-16 text-center rounded-b-xl shadow-lg overflow-hidden">
    <h1 class="text-5xl mb-2 font-bold">Bem-vindo à MB Esportes</h1>
    <p class="text-xl">Confira nossos melhores produtos esportivos!</p>
  </header>

  <!-- PRODUTOS -->
  <main class="flex-1">
    <section class="max-w-[1200px] mx-auto px-4 py-10">
      <h2 class="text-3xl text-center mb-8 relative z-10">Todos os produtos</h2>

      <!-- FILTROS -->
      <div class="max-w-[1200px] mx-0 mt-4 mb-8 justify-center items-center">
        <form method="GET" action="index.php" class="flex flex-wrap justify-center items-center gap-2">

          <!-- Categoria -->
          <select name="categoria" class="border border-gray-300 rounded-lg px-3 py-2">
            <option value="">Todas as categorias</option>
            <?php
            $categorias = mysqli_query($conexao, "SELECT id_categoria, nome FROM categorias ORDER BY nome");
            if ($categorias && mysqli_num_rows($categorias) > 0) {
              while ($cat = mysqli_fetch_assoc($categorias)) {
                $selected = (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id_categoria']) ? 'selected' : '';
                echo "<option value='" . intval($cat['id_categoria']) . "' $selected>" . htmlspecialchars($cat['nome']) . "</option>";
              }
            }
            ?>
          </select>

          <!-- Time -->
          <select name="time" class="border border-gray-300 rounded-lg px-3 py-2">
            <option value="">Todos os times</option>
            <?php
            $times = mysqli_query($conexao, "SELECT time_id, nome FROM times ORDER BY nome");
            if ($times && mysqli_num_rows($times) > 0) {
              while ($t = mysqli_fetch_assoc($times)) {
                $selected = (isset($_GET['time']) && $_GET['time'] == $t['time_id']) ? 'selected' : '';
                echo "<option value='" . intval($t['time_id']) . "' $selected>" . htmlspecialchars($t['nome']) . "</option>";
              }
            }
            ?>
          </select>

          <!-- Qualidade -->
          <select name="qualidade" class="border border-gray-300 rounded-lg px-3 py-2">
            <option value="">Todas as qualidades</option>
            <?php
            $qualidades = mysqli_query($conexao, "SELECT id_qualidade, qualidade FROM qualidades ORDER BY qualidade");
            if ($qualidades && mysqli_num_rows($qualidades) > 0) {
              while ($q = mysqli_fetch_assoc($qualidades)) {
                $selected = (isset($_GET['qualidade']) && $_GET['qualidade'] == $q['id_qualidade']) ? 'selected' : '';
                echo "<option value='" . intval($q['id_qualidade']) . "' $selected>" . htmlspecialchars($q['qualidade']) . "</option>";
              }
            }
            ?>
          </select>

          <!-- Busca -->
          <input type="text" name="busca" placeholder="Buscar produtos..."
            value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>"
            class="border border-gray-300 rounded-lg px-4 py-2 w-48 m-2 outline-none">

          <!-- Botão -->
          <button type="submit"
            class="bg-[#ed3814] text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700 transition">
            Filtrar
          </button>
        </form>
      </div>

      <!-- LISTAGEM PRODUTOS -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center">
        <?php
        // ==== Filtros ====
        $where = [];

        if (!empty($_GET['busca'])) {
          $busca = mysqli_real_escape_string($conexao, $_GET['busca']);
          $where[] = "(p.nome LIKE '%$busca%' OR p.descricao LIKE '%$busca%')";
        }

        if (!empty($_GET['categoria'])) {
          $where[] = "p.categoria_id = " . intval($_GET['categoria']);
        }

        if (!empty($_GET['time'])) {
          $where[] = "p.time_id = " . intval($_GET['time']);
        }

        if (!empty($_GET['qualidade'])) {
          $where[] = "p.qualidade_id = " . intval($_GET['qualidade']);
        }

        $whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        // ==== Query ====
        $sql = "SELECT p.*, t.nome as time_nome, c.nome as categoria_nome, q.qualidade,
                GROUP_CONCAT(tm.tamanho SEPARATOR ', ') AS tamanhos
                FROM produtos p
                LEFT JOIN times t ON p.time_id = t.time_id
                LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
                LEFT JOIN qualidades q ON p.qualidade_id = q.id_qualidade
                LEFT JOIN produtos_tamanhos pt ON pt.id_produto = p.id
                LEFT JOIN tamanhos tm ON tm.id_tamanho = pt.id_tamanho
                $whereSQL
                GROUP BY p.id
                ORDER BY RAND()";

        $result = mysqli_query($conexao, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($produto = mysqli_fetch_assoc($result)) {
            // Verifica favoritos
            $favoritado = false;
            if (isset($_SESSION['id_usuario'])) {
              $id_usuario = intval($_SESSION['id_usuario']);
              $id_produto = intval($produto['id']);
              $sql_fav = "SELECT 1 FROM favoritos WHERE id_usuario = $id_usuario AND id_produto = $id_produto LIMIT 1";
              $res_fav = mysqli_query($conexao, $sql_fav);
              $favoritado = ($res_fav && mysqli_num_rows($res_fav) > 0);
            }
        ?>
            <div class="relative bg-white border border-gray-300 p-5 rounded-lg text-center shadow-lg transform transition-transform duration-500 hover:scale-110">
              <a href="/mbesportes/pages/view_card.php?id=<?= $produto['id'] ?>">
                <?php
                $defaultFallback = '/mbesportes/assets/imgs/bola.png';
                if (!empty($produto['imagem'])) {
                  $val = trim($produto['imagem']);
                  if (preg_match('#^https?://#i', $val)) {
                    $imgSrc = htmlspecialchars($val);
                  } else {
                    $imgSrc = '/mbesportes/assets/imgs/produtos/' . htmlspecialchars($val);
                  }
                } else {
                  $imgSrc = $defaultFallback;
                }
                ?>
                <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" loading="lazy"
                  class="w-full max-h-[180px] object-contain mb-4 rounded-md">
                <h3 class="font-semibold text-lg mb-2"><?= htmlspecialchars($produto['nome']) ?></h3>
                <p class="text-sm text-gray-600 mb-2">
                  Tamanhos disponíveis: <?= htmlspecialchars($produto['tamanhos'] ?? '—') ?>
                </p>
                <p class="text-sm text-gray-600 mb-2">Qualidade: <?= htmlspecialchars($produto['qualidade']) ?></p>
              </a>
              <button
                class="btn-favorito absolute top-2 right-2 w-10 h-10 rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 hover:scale-125 active:scale-95 border-2 border-gray-300 cursor-pointer <?= $favoritado ? 'favoritado bg-white' : 'bg-white' ?>"
                data-produto-id="<?= $produto['id'] ?>">
                <span class="heart-icon text-lg"><?= $favoritado ? '❤️' : '🤍' ?></span>
              </button>
            </div>
        <?php
          }
        } else {
          echo '<p class="col-span-4 text-center text-gray-500">Nenhum produto encontrado.</p>';
        }
        ?>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include 'includes/footer.php'; ?>

  <script>
    window.usuarioLogado = <?php echo json_encode(isset($_SESSION['id_usuario'])); ?>;
  </script>
  <script>
    window.addEventListener("load", () => {
      document.body.classList.add("opacity-100");
    });
  </script>
</body>

</html>