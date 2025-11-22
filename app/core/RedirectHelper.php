<?php

declare(strict_types=1);

namespace app\core;

use app\controllers\errors\HttpErrorController;

class RedirectHelper
{
    private static HttpErrorController $errorController;

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

    public static function redirectToPets(): void
    {
        header('Location: /my-php-mvc-app/pet/');
        exit;
    }

    public static function redirectTo403(): void
    {
        self::getErrorController()->forbidden();
        exit;
    }

    private static function getErrorController(): HttpErrorController
    {
        if (!isset(self::$errorController)) {
            self::$errorController = new HttpErrorController();
        }
        return self::$errorController;
    }

    public static function redirectToAppointmentNew(): void
    {
        header('Location: /my-php-mvc-app/appointment/new');
        exit;
    }
}
