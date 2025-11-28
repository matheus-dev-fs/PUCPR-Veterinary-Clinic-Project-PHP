<!DOCTYPE html>
<html lang="pt-BR">

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

    <main class="about-page">
        <div class="overlay">
            <div class="about-area">
                <div class="about container">
                    <h1 class="title">SOBRE O PROJETO</h1>
                    <p class="credits">
                        Este projeto é uma aplicação web para uma clínica veterinária, desenvolvida utilizando a arquitetura
                        MVC (Model-View-Controller) em PHP. A aplicação permite o gerenciamento de pacientes, agendamentos
                        e serviços oferecidos pela clínica.
                    </p>
                    <p class="credits">
                        Este site foi desenvolvido como projeto acadêmico para a disciplina de Fundamentos de
                        Programação Web da PUC-PR. O objetivo é demonstrar habilidades em HTML, CSS, Javascript, PHP e MySQL,
                        criando uma aplicação web fullstack responsiva e funcional.
                    </p>
                    <p class="credits">Imagens utilizadas neste site foram obtidas gratuitamente em <a href="https://www.pexels.com/"
                        target="_blank">pexels.com</a></p>
                    <p class="credits">Ícones utilizados neste site foram obtidos gratuitamente em <a href="https://fontawesome.com/"
                        target="_blank">fontawesome.com</a></p>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/home/script.js"></script>
</body>

</html>