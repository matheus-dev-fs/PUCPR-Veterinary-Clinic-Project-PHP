<?php

declare(strict_types=1);

namespace app\core;

class RedirectHelper
{
    public static function redirectToRegister(): void
    {
        header('Location: /my-php-mvc-app/user/register');
        exit;
    }

    public static function redirectToLogin(): void
    {
        header('Location: /my-php-mvc-app/user/login');
        exit;
    }

    public static function redirectToHome(): void
    {
        header('Location: /my-php-mvc-app/home/');
        exit;
    }
}
