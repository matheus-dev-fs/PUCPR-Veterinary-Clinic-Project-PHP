<?php

declare(strict_types=1);

namespace app\core;

use app\controllers\errors\HttpErrorController;
use app\controllers\PetController;
use app\utils\UrlHelper;

class RedirectHelper
{
    private static HttpErrorController $errorController;

    public static function redirectToRegister(): void
    {
        header('Location: ' . UrlHelper::to('user/register'));
        exit;
    }

    public static function redirectToLogin(): void
    {
        header('Location: ' . UrlHelper::to('user/login'));
        exit;
    }

    public static function redirectToWelcome(): void
    {
        header('Location: ' . UrlHelper::to('welcome/'));
        exit;
    }

    public static function redirectToHome(): void
    {
        header('Location: ' . UrlHelper::to('home/'));
        exit;
    }

    public static function redirectToPets($errors = []): void
    {
        $petController = new PetController();
        $petController->index($errors);
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
        header('Location: ' . UrlHelper::to('appointment/new'));
        exit;
    }

    public static function redirectToAppointmentSummary(int $appointmentId): void
    {
        header('Location: ' . UrlHelper::to('appointment/summary/' . $appointmentId));
        exit;
    }

    public static function redirectToAppointment(): void
    {
        header('Location: ' . UrlHelper::to('appointment/'));
        exit;
    }
}
