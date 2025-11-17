<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\dtos\CreateUserDTO;
use app\services\UserService;
use app\models\User;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function register()
    {
        if ($this->isUserLoggedIn()) {
            $this->redirectToHome();
        }

        $this->view('user/register');
    }

    public function save()
    {
        if (!$this->isPostRequest()) {
            $this->redirectToRegister();
        }

        $createUserDTO = $this->getCreateUserDTO();
        $user = $this->userService->save($createUserDTO);

        if ($this->hasErrors($user)) {
            $this->handleErrors($user['errors']);
            $this->redirectToRegister();
        }

        $this->clearSessionErrors();
        $this->saveUserSession($user);
        $this->redirectToHome();
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    private function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    private function redirectToRegister(): void
    {
        header('Location: /my-php-mvc-app/user/register');
        exit;
    }

    private function getCreateUserDTO(): CreateUserDTO
    {
        return new CreateUserDTO(
            \htmlspecialchars(trim($_POST['name'] ?? '')),
            \htmlspecialchars(trim($_POST['email'] ?? '')),
            \htmlspecialchars(trim($_POST['email_confirmation'] ?? '')),
            \htmlspecialchars(trim($_POST['password'] ?? '')),
            \htmlspecialchars(trim($_POST['password_confirmation'] ?? '')),
            \htmlspecialchars(trim($_POST['contact'] ?? ''))
        );
    }

    private function redirectToHome(): void
    {
        header('Location: /my-php-mvc-app/home/');
        exit;
    }

    private function hasErrors($user): bool
    {
        return is_array($user);
    }

    private function handleErrors(array $errors): void
    {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
    }

    private function clearSessionErrors(): void
    {
        unset($_SESSION['errors'], $_SESSION['old']);
    }

    private function saveUserSession(User $user): void
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }
}
