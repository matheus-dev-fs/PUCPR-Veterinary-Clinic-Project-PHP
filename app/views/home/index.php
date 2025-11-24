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

    <main class="home-page">
        <div class="banner-area">
        </div>

        <div class="services" id="services">
            <div class="container">
                <h2 class="title">Nossos Serviços</h2>
                <div class="content">
                    <div class="item">
                        <div class="left-side">
                            <h1>Consulta</h1>
                            <p>
                                O serviço de <strong>Consulta</strong> veterinária oferece uma avaliação completa da
                                saúde do seu animal de estimação. Durante a consulta, profissionais qualificados
                                realizam exames clínicos detalhados, escutam as necessidades do tutor e orientam sobre
                                prevenção, diagnóstico e tratamento de diversas condições. O atendimento é
                                personalizado, considerando o histórico do animal, alimentação, comportamento e
                                possíveis sintomas apresentados. Além disso, são fornecidas recomendações sobre
                                vacinação, vermifugação, controle de parasitas e acompanhamento periódico, promovendo o
                                bem-estar e a qualidade de vida do seu pet. O objetivo é garantir que cada animal receba
                                atenção individualizada e cuidados adequados em todas as fases da vida, desde filhotes
                                até a terceira idade, prevenindo doenças e promovendo uma vida longa e saudável.
                            </p>
                            <button class="button"><a href="/my-php-mvc-app/appointment/new">Agendar</a></button>
                        </div>
                        <div class="right-side">
                            <img src="/my-php-mvc-app/public/assets/images/services/dog-1.jpg" alt="Consulta Veterinária">
                        </div>
                    </div>
                    <div class="item">
                        <div class="left-side">
                            <h1>Banho</h1>
                            <p>
                                O serviço de <strong>Banho</strong> é realizado por profissionais experientes,
                                utilizando produtos específicos para cada tipo de pelagem e necessidade do animal. O
                                banho proporciona higiene, conforto e bem-estar, ajudando a manter a pele e o pelo
                                saudáveis, além de prevenir odores e possíveis infecções. Durante o procedimento, são
                                observados sinais de alergias, irritações ou parasitas, permitindo a identificação
                                precoce de problemas de saúde. O ambiente é preparado para garantir a segurança e o
                                mínimo de estresse ao pet, com atenção especial ao manejo e à temperatura da água. O
                                serviço inclui secagem adequada, escovação e, se necessário, aplicação de produtos
                                antipulgas ou hidratantes, promovendo uma experiência agradável e completa para o animal
                                e tranquilidade para o tutor.
                            </p>
                            <button class="button"><a href="/my-php-mvc-app/appointment/new">Agendar</a></button>
                        </div>
                        <div class="right-side">
                            <img src="/my-php-mvc-app/public/assets/images/services/dog-2.jpg" alt="Banho em Pets">
                        </div>
                    </div>
                    <div class="item">
                        <div class="left-side">
                            <h1>Tosa</h1>
                            <p>
                                O serviço de <strong>Tosa</strong> é fundamental para manter a pelagem do seu pet
                                bonita, saudável e adequada ao clima. Realizamos diferentes estilos de tosa, desde a
                                higiênica até a completa, sempre respeitando as características da raça e as
                                preferências do tutor. O procedimento é feito com equipamentos esterilizados e técnicas
                                seguras, visando o conforto e a segurança do animal. Durante a tosa, são observados
                                possíveis problemas de pele, nódulos ou feridas, que podem ser comunicados ao tutor para
                                acompanhamento veterinário. Além do aspecto estético, a tosa contribui para a saúde,
                                prevenindo nós, acúmulo de sujeira e proliferação de parasitas. O atendimento é
                                realizado em ambiente tranquilo, com profissionais capacitados para lidar com diferentes
                                temperamentos e necessidades.
                            </p>
                            <button class="button"><a href="/my-php-mvc-app/appointment/new">Agendar</a></button>
                        </div>
                        <div class="right-side">
                            <img src="/my-php-mvc-app/public/assets/images/services/dog-1.jpg" alt="Tosa em Pets">
                        </div>
                    </div>
                    <div class="item">
                        <div class="left-side">
                            <h1>Vacinação</h1>
                            <p>
                                O serviço de <strong>Vacinação</strong> é essencial para proteger seu animal de
                                estimação contra diversas doenças infecciosas. Realizamos a aplicação de vacinas
                                obrigatórias e recomendadas, seguindo o protocolo adequado para cada espécie, idade e
                                histórico de saúde. Durante a vacinação, o animal passa por uma avaliação clínica para
                                garantir que está apto a receber a dose, minimizando riscos de reações adversas. O
                                controle rigoroso da carteira de vacinação assegura que todas as doses estejam em dia,
                                contribuindo para a imunização individual e coletiva. Orientamos os tutores sobre a
                                importância da vacinação, possíveis efeitos colaterais e cuidados pós-aplicação,
                                promovendo a saúde e a longevidade do pet. A vacinação é um ato de responsabilidade e
                                amor, fundamental para prevenir doenças graves e garantir uma vida mais segura ao seu
                                companheiro.
                            </p>
                            <button class="button"><a href="/my-php-mvc-app/appointment/new">Agendar</a></button>
                        </div>
                        <div class="right-side">
                            <img src="/my-php-mvc-app/public/assets/images/services/dog-2.jpg" alt="Vacinação de Pets">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script type="module" src="/my-php-mvc-app/public/assets/js/home/script.js"></script>
</body>

</html>