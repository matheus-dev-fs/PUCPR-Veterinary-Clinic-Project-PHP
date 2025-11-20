<?php use app\utils\Sanitizer; ?>
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

    <main class="new-pet-page">
        <div class="overlay">
            <div class="new-pet-area container">
                <div class="new-pet">
                    <div class="left-area">
                        <div class="top-area">
                            <div class="img-area">
                                <i class="fa-solid fa-dog img"></i>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <h1 class="title">Registre seu pet!</h1>
                            <p class="subtitle">Preencha as informações do seu animalzinho para cadastro.</p>
                        </div>
                    </div>
                    <div class="right-area">
                        <form class="new-pet-form" id="new-pet-form" action="/my-php-mvc-app/pet/create" method="POST">
                            <div class="input-group">
                                <label for="name">Nome do Pet</label>
                                <div class="input-area pet-name">
                                    <input class="input" type="text" id="name" name="name" placeholder="Rex" value="<?= Sanitizer::e($old['name'] ?? '') ?>">
                                    <div class="error-area">
                                        <span class="error-msg required <?= isset($errors['name_required']) && $errors['name_required'] ? 'show-error' : '' ?>">O nome do pet é obrigatório.</span>
                                        <span class="error-msg invalid <?= isset($errors['name_length']) && $errors['name_length'] ? 'show-error' : '' ?>">Precisa de pelo menos 3 caracteres.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Sexo do Pet</label>
                                <div class="input-area pet-gender">
                                    <div class="left">
                                        <input type="radio" id="male" name="gender" value="M" <?= (isset($old['gender']) && $old['gender'] === 'M' || !isset($old['gender'])) ? 'checked' : '' ?>>
                                        <label for="male">Macho</label>
                                    </div>
                                    <div class="right">
                                        <input type="radio" id="female" name="gender" value="F" <?= isset($old['gender']) && $old['gender'] === 'F' ? 'checked' : '' ?>>
                                        <label for="female">Fêmea</label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="type">Tipo do Pet</label>
                                <div class="input-area type">
                                    <select id="type" name="type" value="<?= Sanitizer::e($old['type'] ?? '') ?>">
                                        <option value="">Selecione</option>
                                        <option value="dog">Cão</option>
                                        <option value="cat">Gato</option>
                                        <option value="other">Outro</option>
                                    </select>
                                    <div class="error-area">
                                        <span class="error-msg required <?= isset($errors['type_required']) && $errors['type_required'] ? 'show-error' : '' ?>">Selecione um tipo.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-area">
                                <button type="submit" class="submit-button">Registrar Pet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/new-pet/script.js?v=1.0.0"></script>
</body>

</html>
