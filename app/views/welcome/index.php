<?php

use app\core\AuthHelper;
use app\utils\Sanitizer;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="/my-php-mvc-app/public/assets/css/style.css?v=3.0.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/my-php-mvc-app/public/assets/images/favicon.svg" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="welcome-page">
        <div class="overlay">
            <div class="welcome-area">
                <div class="welcome-content container">
                    <i class="fa-solid fa-face-grin-beam icon"></i>
                    <div class="text-area">
                        <h1 class="title">Boas-vindas, <span><?= Sanitizer::e(AuthHelper::getUserName()) ?></span>!</h1>
                        <div class="subtitle">
                            <p>Comece agora mesmo a explorar nossos serviços e garantir o bem-estar do seu pet!</p>
                        </div>
                    </div>
                    <div class="buttons-area">
                        <button class="button"><a href="/my-php-mvc-app/pet/index">Meus Pets</a></button>
                        <button class="button secondary"><a href="/my-php-mvc-app/appointment/new">Agendar Consulta</a></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/home/script.js"></script>
</body>

</html>