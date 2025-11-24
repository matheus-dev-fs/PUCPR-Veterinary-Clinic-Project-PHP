<?php

use app\core\AuthHelper;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="/my-php-mvc-app/public/assets/css/style.css?v=1.0.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/my-php-mvc-app/public/assets/images/favicon.svg" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="appointments-page">
        <div class="overlay">
            <div class="appointments-list container">
                <div class="header-area">
                    <h1>Meus Agendamentos</h1>
                    <div class="new-appointment-button">
                        <button class="button"><a href="/my-php-mvc-app/appointment/new">Cadastrar Agendamento</a></button>
                    </div>
                </div>
                <div class="content-area">
                    <div class="no-appointments <?php echo (!isset($errors)) ? 'desactive' : '' ?>">
                        <h1 class="">Você não possui agendamentos cadastrados.</h1>
                    </div>
                    <ul class="appointment-items <?php echo (isset($errors) && $errors['no_appointments'] === true) ? 'desactive' : '' ?>">
                        <?php if (!empty($appointments)) : ?>
                            <?php foreach ($appointments as $appointment) : ?>
                                <li class="item">
                                    <div class=appointment-infos>
                                        <p><strong>Nome do Pet:</strong> <?= $appointment->getPetName() ?></p>
                                        <p><strong>Serviço:</strong> <?= $appointment->getServiceName() ?></p>
                                        <p><strong>Data:</strong> <?= $appointment->getAppointmentDate() ?></p>
                                    </div>
                                    <div class="appointment-actions">
                                        <button class="view-button">
                                            <a href="/my-php-mvc-app/appointment/summary/<?= $appointment->getId() ?>">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </button>
                                        <button class="delete-button" data-id="<?= $appointment->getId() ?>">
                                            <a>
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="delete-appointment-area desactive">
                    <div class="delete-appointment-box">
                        <h2 class="title">Tem certeza que deseja deletar este agendamento?</h2>
                        <p class="text">Essa ação não poderá ser desfeita!</p>
                        <form method="POST" class="delete-appointment-form" action="/my-php-mvc-app/appointment/delete/">
                            <?= AuthHelper::getCsrfInput() ?>
                            <input type="hidden" name="appointment-id" value="">
                            <div class="buttons-area">
                                <button type="button" class="cancel-button button">Cancelar</button>
                                <button type="submit" class="confirm-delete-button button">Deletar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/appointment-delete/script.js?v=3.0.0"></script>
</body>

</html>