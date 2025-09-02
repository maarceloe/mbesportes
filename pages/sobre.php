<?php
session_start();
require_once '../php/config.php';

$cards = [];
$sql = "SELECT nome, descricao, icone, url FROM redes_sociais";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cards[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MB Esportes | Vitrine</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .produto {
            display: flex;
            align-items: center;
            /* Garante alinhamento vertical */
            gap: 10px;
            /* Espaço entre ícone e texto */
            background: #fff;
            border-radius: 50px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
            padding: 12px 20px;
            cursor: pointer;
        }

        .produto img {
            height: 28px;
            /* Tamanho fixo para manter proporção */
            width: auto;
            /* Mantém proporção da imagem */
            margin: 14px 0;
        }

        .produto p {
            margin: 0;
            /* Remove margem padrão do parágrafo */
            font-size: 1.1em;
            line-height: 1;
            /* Centraliza melhor na altura */
        }

        .produto h3 {
            margin: 0;
            font-size: 1.2em;

            .produto img {
                display: flex;
                align-self: center;
                height: 2.2em;
                width: auto;
                object-fit: contain;
                border-radius: 8px;
            }
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid-produtos {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: 1fr 1fr;
            gap: 32px;
            justify-items: center;
            align-items: center;
            padding: 32px 0;
            max-width: 600px;
            margin: auto;
        }

        .grid-produtos>.produto:last-child {
            grid-column: 1 / span 2;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php include '../includes/navbar.php'; ?>

    <!-- PRODUTOS -->
    <main>
        <section class="produtos">
            <div class="grid-produtos">

                <!-- CARDS -->
                <div class="produto">
                    <img src="../assets/icons/instagram.png" alt="Instagram">
                    <p>Siga-nos no Instagram</p>
                </div>

                <div class="produto">
                    <img src="../assets/icons/facebook.png" alt="Facebook">
                    <p>Acompanhe-nos no Facebook</p>
                </div>

                <div class="produto">
                    <img src="../assets/icons/whatsapp.png" alt="Whatsapp">
                    <p>Mande-nos uma mensagem!</p>
                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>