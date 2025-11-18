<?php
declare(strict_types=1);

namespace app\core;

use app\models\User;

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

    public static function destroySession(): void
    {
        session_unset();
        session_destroy();
    }

    public static function saveUserSession(User $user): void
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }
}