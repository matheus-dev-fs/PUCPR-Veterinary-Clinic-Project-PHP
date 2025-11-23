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

    public static function getUserLoggedId(): ?int
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
        session_regenerate_id(true);

        unset($_SESSION['csrf_token']);
        self::generateCsrfToken();

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }

    public static function generateCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function getCsrfInput(): string
    {
        $token = self::generateCsrfToken();
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }

    public static function validateCsrfToken(): bool
    {
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
            return false;
        }
        
        // hash_equals previne ataques de timing
        return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }
}