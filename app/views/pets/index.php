<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="/my-php-mvc-app/public/assets/css/style.css?v=4.0.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/my-php-mvc-app/public/assets/images/favicon.svg" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="pets-page">
        <div class="overlay">
            <div class="pets-list container">
                <div class="header-area">
                    <h1>Meus Pets</h1>
                    <div class="new-pet-button">
                        <button class="button"><a href="/my-php-mvc-app/pets/new">Adicionar Pet</a></button>
                    </div>
                </div>
                <div class="content-area">
                    <div class="no-pets <?php echo (!empty($pets)) ? 'desactive' : '' ?>">
                        <h1 class="">Você ainda não possui pets cadastrados.</h1>
                    </div>
                    <ul class="pet-items <?php echo (empty($pets)) ? 'desactive' : '' ?>">
                        <?php if (!empty($pets)) : ?>
                            <?php foreach ($pets as $pet) : ?>
                                <li class="item">
                                    <div class=pet-infos>
                                        <p><strong>Nome:</strong> <?= $pet->getName() ?></p>
                                        <p><strong>Tipo:</strong> <?= $pet->getType() ?></p>
                                        <p><strong>Sexo:</strong> <?= $pet->getGender() ?></p>
                                    </div>
                                    <div class="pet-actions">
                                        <button class="edit-button">
                                            <a href="/my-php-mvc-app/pets/edit/<?= $pet->getId() ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </button>
                                        <button class="delete-button">
                                            <a href="/my-php-mvc-app/pets/delete/<?= $pet->getId() ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/pets/script.js?v=2.0.0"></script>
</body>

</html>