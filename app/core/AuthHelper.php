<?php
declare(strict_types=1);

namespace app\core;

class AuthHelper
{
    public static function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getUserId(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }
}