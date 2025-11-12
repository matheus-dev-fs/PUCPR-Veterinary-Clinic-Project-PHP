<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="/my-php-mvc-app/public/assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/my-php-mvc-app/public/assets/images/favicon.svg" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="schedule-confirmation-page">
        <div class="overlay">
            <div class="schedule-confirmation-area container">
                <div class="schedule-confirmation">
                    <div class="header-area">
                        <h1>Agendamento</h1>
                    </div>
                    <div class="content-area">
                        <div class="top-area">
                            <div class="icon-area">
                                <i class="fa-regular fa-square-check"></i>
                            </div>
                            <div class="text-area">
                                <h2>Agendamento realizado!</h2>
                                <p>Obrigado por escolher a nossa clínica veterinária. Seu agendamento foi confirmado e
                                    estamos ansiosos para cuidar do seu pet.</p>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <div class="schedule-infos-area">
                                <div class="schedule-infos">
                                    <div class="header">Detalhes do Agendamento</div>
                                    <div class="content">
                                        <div class="info-item tutorName">
                                            <span class="label">Nome do Tutor:</span>
                                            <span class="value" id="tutor-name">placeholder</span>
                                        </div>
                                        <div class="info-item email">
                                            <span class="label">Email do Tutor:</span>
                                            <span class="value" id="tutor-email">placeholder</span>
                                        </div>
                                        <div class="info-item phone">
                                            <span class="label">Telefone do Tutor:</span>
                                            <span class="value" id="tutor-phone">placeholder</span>
                                        </div>
                                        <div class="info-item petName">
                                            <span class="label">Nome do Pet:</span>
                                            <span class="value" id="pet-name">placeholder</span>
                                        </div>
                                        <div class="info-item sex">
                                            <span class="label">Sexo do Pet:</span>
                                            <span class="value" id="pet-sex">placeholder</span>
                                        </div>
                                        <div class="info-item service">
                                            <span class="label">Serviço Agendado:</span>
                                            <span class="value" id="service-name">placeholder</span>
                                        </div>
                                        <div class="info-item date">
                                            <span class="label">Data do Agendamento:</span>
                                            <span class="value" id="appointment-date">placeholder</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/form-action/script.js"></script>
</body>

</html>