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

    <main class="register-user-page">
        <section class="form-section container">
            <form class="register-user-form" id="register-user-form" action="/my-php-mvc-app/user/save" method="POST">
                <div class="input-group">
                    <div class="input-field">
                        <label for="name">Nome completo:</label>
                        <input type="text" id="name" name="name" placeholder="fulano da silva">
                    </div>
                    <div class="error-area">
                        <span class="error-message required">O <strong>Nome Completo</strong> é obrigatório.</span>
                        <span class="error-message invalid">O <strong>Nome Completo</strong> precisa ter no mínimo 3 caracteres.</span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="fulano@example.com">
                    </div>
                    <div class="error-area">
                        <span class="error-message required">O <strong>Email</strong> é obrigatório.</span>
                        <span class="error-message invalid">O <strong>Email</strong> informado não é válido.</span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="email_confirmation">Confirmação do Email:</label>
                        <input type="email" id="email_confirmation" name="email_confirmation" placeholder="fulano@example.com">
                    </div>
                    <div class="error-area">
                        <span class="error-message required">A <strong>Confirmação do Email</strong> é obrigatório.</span>
                        <span class="error-message mismatch">O <strong>Email</strong> e a <strong>Confirmação do Email</strong> não coincidem.</span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" placeholder="********">
                    </div>
                    <div class="error-area">
                        <span class="error-message required">A <strong>Senha</strong> é obrigatória.</span>
                        <span class="error-message invalid">
                            <strong>Senha:</strong> mínimo 8 caracteres, com maiúsculas, minúsculas, números e símbolos.
                        </span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="password_confirmation">Confirmação da Senha:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="********">
                    </div>
                    <div class="error-area">
                        <span class="error-message required">A <strong>Senha</strong> é obrigatória.</span>
                        <span class="error-message mismatch">A <strong>Senha</strong> e a <strong>Confirmação da Senha</strong> não coincidem.</span>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="contact">Contato:</label>
                        <input type="text" id="contact" name="contact" placeholder="(XX) XXXXX-XXXX ou (XX) XXXX-XXXX">
                    </div>
                    <div class="error-area">
                        <span class="error-message required">O <strong>Contato</strong> é obrigatório.</span>
                        <span class="error-message invalid">
                            O <strong>Contato</strong> informado não é válido.
                        </span>
                    </div>
                </div>
                <div class="submit-area">
                    <button type="submit" class="submit-button button">Registrar-se</button>
                </div>
            </form>
        </section>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/home/script.js"></script>
</body>

</html>