<header>
    <div class="container">
        <div class="left--area">
            <div class="logo-area">
                <div class="logo">
                    <a href="/my-php-mvc-app/"><img src="/my-php-mvc-app/public/assets/images/favicon.svg" alt="Logo"></a>
                </div>
            </div>
            <div class="mobile-menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
        <div class="right--area desactive">
            <div class="menu-area ">
                <ul class="menu">
                    <li class="<?= $view === "home/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/">INÍCIO</a></li>
                    <li class="<?= $view === "home/index" ? "" : "" ?>"><a href="/my-php-mvc-app/#services">SERVIÇOS</a></li>
                    <li class="<?= $view === "schedule/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/schedule/">AGENDAMENTOS</a></li>
                    <li class="<?= $view === "pet/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/pet/">MEUS PETS</a></li>
                    <li class="<?= $view === "about/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/about/">SOBRE</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="/my-php-mvc-app/user/logout">SAIR</a></li>
                    <?php else: ?>
                        <li class="<?= $view === "user/login" ? "selected" : "" ?>"><a href="/my-php-mvc-app/user/login">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</header>