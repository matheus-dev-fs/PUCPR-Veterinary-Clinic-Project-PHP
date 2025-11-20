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

    <main class="register-user-page">
        <div class="overlay">
            <section class="form-section container">
                <form class="register-user-form" id="register-user-form" action="/my-php-mvc-app/user/save" method="POST">
                    <h1 class="title">Registro</h1>
                    <div class="input-group name">
                        <div class="input-field">
                            <label for="name">Nome completo:</label>
                            <input type="text" id="name" name="name" placeholder="fulano da silva" value="<?= htmlspecialchars(trim($old['name'] ?? '')) ?>">
                        </div>
                        <div class="error-area">
                            <span class="error-message required <?= isset($errors['name_required']) ? 'show-error' : '' ?>">O <strong>Nome Completo</strong> é obrigatório.</span>
                            <span class="error-message invalid <?= isset($errors['name_length']) ? 'show-error' : '' ?>">O <strong>Nome Completo</strong> precisa ter no mínimo 3 caracteres.</span>
                        </div>
                    </div>
                    <div class="input-group email">
                        <div class="input-field">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="fulano@example.com" value="<?= htmlspecialchars(trim($old['email'] ?? '')) ?>">
                        </div>
                        <div class="error-area">
                            <span class="error-message required <?= isset($errors['email_required']) ? 'show-error' : '' ?>">O <strong>Email</strong> é obrigatório.</span>
                            <span class="error-message invalid <?= isset($errors['email_invalid']) ? 'show-error' : '' ?>">O <strong>Email</strong> informado não é válido.</span>
                            <span class="error-message exists <?= isset($errors['email_exists']) ? 'show-error' : '' ?>">O <strong>Email</strong> informado já está em uso.</span>
                        </div>
                    </div>
                    <div class="input-group email-confirmation">
                        <div class="input-field">
                            <label for="email_confirmation">Confirmação do Email:</label>
                            <input type="email" id="email_confirmation" name="email_confirmation" placeholder="fulano@example.com" value="<?= htmlspecialchars(trim($old['email_confirmation'] ?? '')) ?>">
                        </div>
                        <div class="error-area">
                            <span class="error-message required <?= isset($errors['email_confirmation_required']) ? 'show-error' : '' ?>">A <strong>Confirmação do Email</strong> é obrigatório.</span>
                            <span class="error-message mismatch <?= isset($errors['email_confirmation_mismatch']) ? 'show-error' : '' ?>">O <strong>Email</strong> e a <strong>Confirmação do Email</strong> não coincidem.</span>
                        </div>
                    </div>
                    <div class="input-group password">
                        <div class="input-field">
                            <label for="password">Senha:</label>
                            <input type="password" id="password" name="password" placeholder="********">
                        </div>
                        <div class="error-area">
                            <span class="error-message required <?= isset($errors['password_required']) ? 'show-error' : '' ?>">A <strong>Senha</strong> é obrigatória.</span>
                            <span class="error-message invalid <?= isset($errors['password_invalid']) ? 'show-error' : '' ?>">
                                <strong>Senha:</strong> mínimo 8 caracteres, com maiúsculas, minúsculas, números e símbolos.
                            </span>
                        </div>
                    </div>
                    <div class="input-group password-confirmation">
                        <div class="input-field">
                            <label for="password_confirmation">Confirmação da Senha:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="********">
                        </div>
                        <div class="error-area">
                            <span class="error-message required <?= isset($errors['password_confirmation_required']) ? 'show-error' : '' ?>">A <strong>Confirmação de Senha</strong> é obrigatória.</span>
                            <span class="error-message mismatch <?= isset($errors['password_confirmation_mismatch']) ? 'show-error' : '' ?>">A <strong>Senha</strong> e a <strong>Confirmação da Senha</strong> não coincidem.</span>
                        </div>
                    </div>
                    <div class="input-group phone">
                        <div class="input-field">
                            <label for="phone">Contato:</label>
                            <input type="text" id="phone" name="phone" placeholder="(XX) XXXXX-XXXX ou (XX) XXXX-XXXX" value="<?= htmlspecialchars(trim($old['phone'] ?? '')) ?>">
                        </div>
                        <div class="error-area">
                            <span class="error-message required <?= isset($errors['phone_required']) ? 'show-error' : '' ?>">O <strong>Contato</strong> é obrigatório.</span>
                            <span class="error-message invalid <?= isset($errors['phone']) ? 'show-error' : '' ?>">
                                O <strong>Contato</strong> informado não é válido.
                            </span>
                        </div>
                    </div>
                    <div class="submit-area">
                        <button type="submit" class="submit-button button">Registrar-se</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/register-user/script.js?v=1.0.0"></script>
</body>

</html>