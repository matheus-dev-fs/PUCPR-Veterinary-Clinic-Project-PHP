<?php 
use app\core\AuthHelper; 
use app\utils\ViewHelper;
use app\utils\UrlHelper;
?>

<header>
    <div class="container">
        <div class="left--area">
            <div class="logo-area">
                <div class="logo">
                    <a href="<?= UrlHelper::to() ?>"><img src="<?= UrlHelper::asset('images/favicon.svg') ?>" alt="Logo"></a>
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
                    <li class="<?= ViewHelper::menuSelected($view, "home/index") ?>"><a href="<?= UrlHelper::to() ?>">INÍCIO</a></li>
                    <li class="<?= ViewHelper::menuSelected($view, "home/index") ? "" : "" ?>"><a href="<?= UrlHelper::to() ?>#services">SERVIÇOS</a></li>
                    
                    <?php if (AuthHelper::isUserLoggedIn()): ?>
                        <li class="<?= ViewHelper::menuSelected($view, "appointment/index") ?>"><a href="<?= UrlHelper::to('appointment/') ?>">AGENDAMENTOS</a></li>
                        <li class="<?= ViewHelper::menuSelected($view, "pet/index") ?>"><a href="<?= UrlHelper::to('pet/') ?>">MEUS PETS</a></li>
                    <?php endif; ?>

                    <li class="<?= ViewHelper::menuSelected($view, "about/index") ?>"><a href="<?= UrlHelper::to('about/') ?>">SOBRE</a></li>
                    
                    <?php if (AuthHelper::isUserLoggedIn()): ?>
                        <li><a href="<?= UrlHelper::to('user/logout') ?>">SAIR</a></li>
                    <?php else: ?>
                        <li class="<?= ViewHelper::menuSelected($view, "user/login") ?>"><a href="<?= UrlHelper::to('user/login') ?>">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</header>