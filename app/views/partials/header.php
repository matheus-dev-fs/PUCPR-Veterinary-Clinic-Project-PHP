<header>
    <div class="container">
        <div class="left--area">
            <div class="logo-area">
                <div class="logo">
                    <a href="index.html"><img src="/my-php-mvc-app/public/assets/images/favicon.svg" alt="Logo"></a>
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
                    <li class="<?= $view === "home/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/home">INÍCIO</a></li>
                    <li class="<?= $view === "home/index" ? "" : "" ?>"><a href="/my-php-mvc-app/home#services">SERVIÇOS</a></li>
                    <li class="<?= $view === "schedule/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/schedule/">AGENDAMENTO</a></li>
                    <li class="<?= $view === "about/index" ? "selected" : "" ?>"><a href="/my-php-mvc-app/about/">SOBRE</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>