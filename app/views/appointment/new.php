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

    <main class="appointment-new-page">
        <div class="overlay">
            <div class="appointment-new-area container">
                <div class="appointment-new">
                    <div class="left-area">
                        <div class="top-area">
                            <div class="img-area">
                                <i class="fa-solid fa-dog img"></i>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <h1 class="title">Vamos cuidar do seu pet!</h1>
                            <p class="subtitle">Agende a consulta em poucos minutos e garanta o bem-estar do seu
                                animalzinho.</p>
                        </div>
                    </div>
                    <div class="right-area">
                        <form class="appointment-new-form" id="appointment-new-form" action="/my-php-mvc-app/formAction/" method="GET">
                            <div class="input-group">
                                <label for="pets">Selecione seu Pet:</label>
                                <div class="input-area pets">
                                    <select id="pets" name="pets">
                                        <option value="">Selecione</option>
                                        <?php foreach ($data['pets'] as $pet): ?>
                                            <option value="<?= $pet->getId(); ?>"><?= $pet->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="error-area">
                                        <span class="error-msg required">Selecione um pet.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="service">Serviço</label>
                                <div class="input-area service">
                                    <select id="service" name="service">
                                        <option value="">Selecione</option>
                                        <?php foreach ($data['services'] as $service): ?>
                                            <option value="<?= $service->getId(); ?>"><?= $service->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="error-area">
                                        <span class="error-msg required">Selecione um serviço.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="infos">Informações adicionais:</label>
                                <div class="input-area infos">
                                    <textarea id="infos" name="infos" placeholder="Escreva aqui..."></textarea>
                                    <div class="error-area">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="date">Data do Agendamento</label>
                                <div class="input-area date">
                                    <input type="date" id="date" name="date">
                                    <div class="error-area">
                                        <span class="error-msg required">A data é obrigatória.</span>
                                        <span class="error-msg invalid">Escolha uma data presente/futura.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-area">
                                <button type="submit" class="submit-button">Agendar Consulta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/appointment-new/script.js?v=2.0.0"></script>
</body>

</html>