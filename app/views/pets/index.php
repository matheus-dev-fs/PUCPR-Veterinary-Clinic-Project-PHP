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

    <main class="pets-page">
        <div class="overlay">
            <div class="pets-list container">
                <div class="header-area">
                    <h1>Meus Pets</h1>
                    <div class="new-pet-button">
                        <button class="button"><a href="/my-php-mvc-app/pets/new">Adicionar Pet</a></button>
                    </div> 
                </div>
                <div class="content-area">
                    <div class="no-pets">
                        <h1 class="">Você ainda não possui pets cadastrados.</h1>
                    </div>
                    <ul class="pet-items desactive">
                        <li class="item">
                            <div class=pet-infos>
                                <p><strong>Nome:</strong> Rex</p>
                                <p><strong>Tipo:</strong> Cão</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="pet-actions">
                                <button class="edit-button">
                                    <a href="/my-php-mvc-app/pets/edit/1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <button class="delete-button">
                                    <a href="/my-php-mvc-app/pets/delete/1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                        </li>
                        <li class="item">
                            <div class=pet-infos>
                                <p><strong>Nome:</strong> Rex</p>
                                <p><strong>Tipo:</strong> Cão</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="pet-actions">
                                <button class="edit-button">
                                    <a href="/my-php-mvc-app/pets/edit/1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <button class="delete-button">
                                    <a href="/my-php-mvc-app/pets/delete/1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                        </li>
                        <li class="item">
                            <div class=pet-infos>
                                <p><strong>Nome:</strong> Rex</p>
                                <p><strong>Tipo:</strong> Cão</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="pet-actions">
                                <button class="edit-button">
                                    <a href="/my-php-mvc-app/pets/edit/1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <button class="delete-button">
                                    <a href="/my-php-mvc-app/pets/delete/1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                        </li>
                        <li class="item">
                            <div class=pet-infos>
                                <p><strong>Nome:</strong> Rex</p>
                                <p><strong>Tipo:</strong> Cão</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="pet-actions">
                                <button class="edit-button">
                                    <a href="/my-php-mvc-app/pets/edit/1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <button class="delete-button">
                                    <a href="/my-php-mvc-app/pets/delete/1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                        </li>
                        <li class="item">
                            <div class=pet-infos>
                                <p><strong>Nome:</strong> Rex</p>
                                <p><strong>Tipo:</strong> Cão</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="pet-actions">
                                <button class="edit-button">
                                    <a href="/my-php-mvc-app/pets/edit/1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <button class="delete-button">
                                    <a href="/my-php-mvc-app/pets/delete/1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                        </li>
                        <li class="item">
                            <div class=pet-infos>
                                <p><strong>Nome:</strong> Rex</p>
                                <p><strong>Tipo:</strong> Cão</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="pet-actions">
                                <button class="edit-button">
                                    <a href="/my-php-mvc-app/pets/edit/1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <button class="delete-button">
                                    <a href="/my-php-mvc-app/pets/delete/1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/pets/script.js?v=2.0.0"></script>
</body>

</html>