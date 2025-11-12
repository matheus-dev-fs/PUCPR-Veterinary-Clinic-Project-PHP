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

    <main class="schedule-page">
        <div class="overlay">
            <div class="schedule-area container">
                <div class="schedule">
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
                        <form class="schedule-form" id="schedule-form" action="formAction.html" method="GET">
                            <div class="input-group">
                                <label for="tutorName">Nome do Tutor</label>
                                <div class="input-area name">
                                    <input type="text" id="tutorName" name="tutorName" placeholder="fulano da silva">
                                    <div class="error-area">
                                        <span class="error-msg required">O nome do tutor é obrigatório.</span>
                                        <span class="error-msg invalid">Precisa ter pelo menos 3 caracteres.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="email">Email</label>
                                <div class="input-area email">
                                    <input type="email" id="email" name="email" placeholder="fulano@exemplo.com">
                                    <div class="error-area">
                                        <span class="error-msg required">O email é obrigatório.</span>
                                        <span class="error-msg invalid">Email invalido.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="phone">Número para contato</label>
                                <div class="input-area phone">
                                    <input type="tel" id="phone" name="phone" placeholder="(XX) XXXXX-XXXX">
                                    <div class="error-area">
                                        <span class="error-msg required">O telefone é obrigatório.</span>
                                        <span class="error-msg invalid">Telefone inválido.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="petName">Nome do Pet</label>
                                <div class="input-area pet-name">
                                    <input class="input" type="text" id="petName" name="petName" placeholder="Rex">
                                    <div class="error-area">
                                        <span class="error-msg required">O nome do pet é obrigatório.</span>
                                        <span class="error-msg invalid">Precisa de pelo menos 3 caracteres.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Sexo do Pet</label>
                                <div class="input-area pet-sex">
                                    <div class="left">
                                        <input type="radio" id="male" name="sex" value="macho" checked>
                                        <label for="male">Macho</label>
                                    </div>
                                    <div class="right">
                                        <input type="radio" id="female" name="sex" value="femea">
                                        <label for="female">Fêmea</label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="service">Serviço</label>
                                <div class="input-area service">
                                    <select id="service" name="service">
                                        <option value="">Selecione</option>
                                        <option value="consulta">Consulta</option>
                                        <option value="banho">Banho</option>
                                        <option value="tosa">Tosa</option>
                                        <option value="vacina">Vacinação</option>
                                    </select>
                                    <div class="error-area">
                                        <span class="error-msg required">Selecione um serviço.</span>
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

    <script type="module" src="/my-php-mvc-app/public/assets/js/schedule/script.js"></script>
</body>

</html>