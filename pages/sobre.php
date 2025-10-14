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

<body class="font-sans flex flex-col min-h-screen bg-gray-100 text-gray-800 opacity-0 transition-opacity duration-2500">

    <!-- NAVBAR -->
    <?php include '../includes/navbar_index.php'; ?>
    <div class="flex items-center gap-4 px-5 py-4">
        <button type="button" onclick="window.location.href='/mbesportes/index.php'"
            class="w-12 h-12 ml-2 flex items-center justify-center rounded-full bg-[#ed3814] text-white shadow-xl transition-transform duration-300 hover:-translate-x-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-[#ed3814] cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2.5" stroke="white" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
    </div>
    <!-- PRODUTOS -->
    <main class="flex flex-col items-center justify-center">
        <section class="w-full max-w-2xl mx-auto px-2 sm:px-4">
            <img src="/mbesportes/assets/imgs/logo_mbesportes_new_2.png" alt="MB Esportes" class="block mx-auto mb-5 rounded-[18px]" style="max-width:120px;">
            <?php foreach ($cards as $card): ?>
                <?php if (!empty($card['descricao'])): ?>
                    <p class="mb-8 text-lg text-gray-800 text-center px-2 sm:px-0"><?= nl2br(htmlspecialchars($card['descricao'])) ?></p>
                <?php endif; ?>
                <div class="flex flex-wrap justify-center gap-4 sm:gap-8 mb-4">
                    <?php if (!empty($card['instagram'])): ?>
                        <div class="flex items-center gap-4 bg-white rounded-2xl shadow-xl/30 p-4 sm:p-6 cursor-pointer hover:scale-105 transition-transform duration-300 max-w-[320px] w-full sm:w-auto border-gray-800" onclick="window.open('<?= htmlspecialchars($card['instagram']) ?>', '_blank')">
                            <img src="../assets/icons/instagram.png" alt="Instagram" class="h-10 w-10 object-contain rounded-lg" />
                            <p class="m-0 text-lg font-medium text-gray-800">Instagram</p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card['facebook'])): ?>
                        <div class="flex items-center gap-4 bg-white rounded-2xl shadow-xl/30 p-4 sm:p-6 cursor-pointer hover:scale-105 transition-transform duration-300 max-w-[320px] w-full sm:w-auto border-gray-800" onclick="window.open('<?= htmlspecialchars($card['facebook']) ?>', '_blank')">
                            <img src="../assets/icons/facebook.png" alt="Facebook" class="h-10 w-10 object-contain rounded-lg" />
                            <p class="m-0 text-lg font-medium text-gray-800">Facebook</p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card['whatsapp'])): ?>
                        <div class="flex items-center gap-4 bg-white rounded-2xl shadow-xl/30 p-4 sm:p-6 cursor-pointer hover:scale-105 transition-transform duration-300 max-w-[320px] w-full sm:w-auto border-gray-800" onclick="window.open('<?= htmlspecialchars($card['whatsapp']) ?>', '_blank')">
                            <img src="../assets/icons/whatsapp.png" alt="Whatsapp" class="h-10 w-10 object-contain rounded-lg" />
                            <p class="m-0 text-lg font-medium text-gray-800">Mande-nos uma mensagem!</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-6 text-center">
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