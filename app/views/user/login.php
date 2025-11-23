<?php 
use app\utils\Sanitizer;
use app\core\AuthHelper;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="/my-php-mvc-app/public/assets/css/style.css?v=2.0.1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/my-php-mvc-app/public/assets/images/favicon.svg" type="image/svg+xml">
    <title>Cliníca Veterinária</title>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>

    <main class="login-user-page">
        <div class="overlay">
            <section class="form-section container">
                <h1>Login</h1>
                <form class="login-user-form" id="login-user-form" action="/my-php-mvc-app/user/authenticate" method="POST">
                    <?= AuthHelper::getCsrfInput() ?>
                    <div class="input-group email">
                        <div class="input-field">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" placeholder="example@mail.com" value="<?= Sanitizer::e($old['email'] ?? '') ?>">
                        </div>
                        <div class="error-area">
                            <p class="error-message required">Digite o <strong>Email</strong> para continuar.</p>
                        </div>
                    </div>
                    <div class="input-group password">
                        <div class="input-field">
                            <label for="password">Senha:</label>
                            <input type="password" id="password" name="password" placeholder="Digite sua senha">
                        </div>
                        <div class="error-area">
                            <p class="error-message required">Digite a <strong>Senha</strong> para continuar.</p>
                        </div>
                    </div>
                    <div class="error-area">
                        <p class="error-message <?= isset($errors['invalid_credentials']) ? 'show-error' :  '' ?>">Email ou senha incorretos. Tente novamente.</p>
                    </div>
                    <div class="submit-area">
                        <button type="submit" class="submit-button button">Logar-se</button>
                    </div>
                </form>
                <div class="register-link-area">
                    <p>Ainda não possui uma conta? <a href="/my-php-mvc-app/user/register">Registre-se</a></p>
                </div>
            </section>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/login-user/script.js?v=1.0.1"></script>
</body>

</html>