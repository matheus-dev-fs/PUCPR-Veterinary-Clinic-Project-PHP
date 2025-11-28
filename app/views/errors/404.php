<?php use app\utils\UrlHelper; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="<?= UrlHelper::asset('css/style.css?v=0.2') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= UrlHelper::asset('images/favicon.svg') ?>" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="page-404">
        <div class="page-404-area container">
            <h1 class="title">404</h1>
            <p>Desculpe, a página que você está procurando não existe ou foi movida.</p>
            <button class="button"><a href="<?= UrlHelper::to() ?>">Voltar para a Página Inicial</a></button>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="<?= UrlHelper::asset('js/home/script.js') ?>"></script>
</body>

</html>