<?php
session_start();
require_once '../php/config.php';

$cards = [];
$sql = "SELECT descricao, telefone, email, instagram, facebook, whatsapp FROM sobre";
$result = mysqli_query($conexao, $sql);
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
    <title>MB Esportes | Sobre</title>
    <link rel="stylesheet" href="/mbesportes/css/output.css">
    <link rel="stylesheet" href="/mbesportes/css/custom.css">
    <link rel="shortcut icon" href="/mbesportes/assets/imgs/logo_mbesportes_new_2.ico" type="image/x-icon">
</head>

<body class="font-sans w-screen min-h-screen flex flex-col justify-center bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">

    <!-- NAVBAR -->
    <?php include '../includes/navbar_index.php'; ?>

    <!-- PRODUTOS -->
    <main class="flex-1 flex flex-col items-center justify-center py-10">
        <section class="w-full max-w-2xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- CARDS: Instagram, Facebook, Mensagem WhatsApp -->
                <?php foreach ($cards as $card): ?>
                    <?php if (!empty($card['instagram'])): ?>
                        <div class="flex items-center gap-4 bg-white rounded-2xl shadow-xl/30 p-6 cursor-pointer hover:scale-105 transition-transform duration-300 w-full h-full border-gray-800" onclick="window.open('<?= htmlspecialchars($card['instagram']) ?>', '_blank')">
                            <img src="../assets/icons/instagram.png" alt="Instagram" class="h-10 w-10 object-contain rounded-lg" />
                            <p class="m-0 text-lg font-medium text-gray-800">Instagram</p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card['facebook'])): ?>
                        <div class="flex items-center gap-4 bg-white rounded-2xl shadow-xl/30 p-6 cursor-pointer hover:scale-105 transition-transform duration-300 w-full h-full border-gray-800" onclick="window.open('<?= htmlspecialchars($card['facebook']) ?>', '_blank')">
                            <img src="../assets/icons/facebook.png" alt="Facebook" class="h-10 w-10 object-contain rounded-lg" />
                            <p class="m-0 text-lg font-medium text-gray-800">Facebook</p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card['whatsapp'])): ?>
                        <div class="flex items-center gap-4 bg-white rounded-2xl shadow-xl/30 p-6 cursor-pointer hover:scale-105 transition-transform duration-300 w-full h-full border-gray-800" onclick="window.open('<?= htmlspecialchars($card['whatsapp']) ?>', '_blank')">
                            <img src="../assets/icons/whatsapp.png" alt="Whatsapp" class="h-10 w-10 object-contain rounded-lg" />
                            <p class="m-0 text-lg font-medium text-gray-800">Mande-nos uma mensagem!</p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <!-- fim dos cards -->
            </div>
            <!-- Informações de contato abaixo dos cards -->
            <?php foreach ($cards as $card): ?>
                <div class="mt-8 text-center">
                    <?php if (!empty($card['telefone'])): ?>
                        <p class="text-lg text-gray-800">Telefone: <?= htmlspecialchars($card['telefone']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($card['email'])): ?>
                        <p class="text-lg text-gray-800">Email: <?= htmlspecialchars($card['email']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <!-- FOOTER -->
    <div class="fixed bottom-0 left-0 w-full z-40">
        <?php include '../includes/footer.php'; ?>
    </div>
    <script src="/mbesportes/js/main.js"></script>

</body>
</html>