<?php

use app\utils\Sanitizer;
use app\utils\ViewHelper; 
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="/my-php-mvc-app/public/assets/css/style.css?v=2.0.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/my-php-mvc-app/public/assets/images/favicon.svg" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="edit-pet-page">
        <div class="overlay">
            <div class="edit-pet-area container">
                <div class="edit-pet">
                    <div class="left-area">
                        <div class="top-area">
                            <div class="img-area">
                                <i class="fa-regular fa-pen-to-square img"></i>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <h1 class="title">Edite seu pet!</h1>
                            <p class="subtitle">Preencha as informações do seu animalzinho para edição.</p>
                        </div>
                    </div>
                    <div class="right-area">
                        <form class="edit-pet-form" id="edit-pet-form" action="/my-php-mvc-app/pet/update" method="POST">
                            
                            <div class="input-group">
                                <label for="name">Nome do Pet</label>
                                <div class="input-area pet-name">
                                    <input class="input" type="text" id="name" name="name" placeholder="Rex" 
                                           value="<?= ViewHelper::val($old['name'] ?? null, $pet->getName()) ?>">
                                    
                                    <div class="error-area">
                                        <span class="error-msg required <?= isset($errors['name_required']) ? 'show-error' : '' ?>">O nome do pet é obrigatório.</span>
                                        <span class="error-msg invalid <?= isset($errors['name_length']) ? 'show-error' : '' ?>">Precisa de pelo menos 3 caracteres.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <label>Sexo do Pet</label>
                                <div class="input-area pet-gender">
                                    <div class="left">
                                        <input type="radio" id="male" name="gender" value="M" 
                                               <?= ViewHelper::checked('M', $old['gender'] ?? null, $pet->getGender()) ?>>
                                        <label for="male">Macho</label>
                                    </div>
                                    <div class="right">
                                        <input type="radio" id="female" name="gender" value="F" 
                                               <?= ViewHelper::checked('F', $old['gender'] ?? null, $pet->getGender()) ?>>
                                        <label for="female">Fêmea</label>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="type">Tipo do Pet</label>
                                <div class="input-area type">
                                    <select id="type" name="type">
                                        <option value="">Selecione</option>
                                        <option value="dog" <?= ViewHelper::selected('dog', $old['type'] ?? null, $pet->getType()) ?>>Cão</option>
                                        <option value="cat" <?= ViewHelper::selected('cat', $old['type'] ?? null, $pet->getType()) ?>>Gato</option>
                                        <option value="other" <?= ViewHelper::selected('other', $old['type'] ?? null, $pet->getType()) ?>>Outro</option>
                                    </select>
                                    <div class="error-area">
                                        <span class="error-msg required <?= isset($errors['type_required']) ? 'show-error' : '' ?>">Selecione um tipo.</span>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?= Sanitizer::e((string)$pet->getId()) ?>">
                            
                            <div class="submit-area">
                                <button type="submit" class="submit-button">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/edit-pet/script.js?v=3.0.0"></script>
</body>

</html>