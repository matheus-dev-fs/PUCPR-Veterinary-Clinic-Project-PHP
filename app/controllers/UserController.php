<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\dtos\CreateUserDTO;
use app\mappers\UserMapper;
use app\services\UserService;
use app\models\User;
use app\core\AuthHelper;

class UserController extends Controller
{
    private UserService $userService;
    private UserMapper $userMapper;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->userMapper = new UserMapper();
    }

    public function register()
    {
        if (AuthHelper::isUserLoggedIn()) {
            $this->redirectToHome();
        }

        $this->view('user/register', [
            'errors' => [],
            'old' => []
        ]);
    }

    public function save()
    {
        if (AuthHelper::isUserLoggedIn()) {
            $this->redirectToHome();
        }

        if (!$this->isPostRequest()) {
            $this->redirectToRegister();
        }

        $createUserDTO = $this->getCreateUserDTO();
        $userRegistrationResult = $this->userService->save($createUserDTO);

        if (!$userRegistrationResult->isSuccess()) {
            $this->view('user/register', [
                'errors' => $userRegistrationResult->getErrors(),
                'old' => $_POST
            ]);
            return;
        }

        AuthHelper::saveUserSession($userRegistrationResult->getUser());
        $this->redirectToHome();
    }

    public function login()
    {
        if (AuthHelper::isUserLoggedIn()) {
            $this->redirectToHome();
        }

        $this->view('user/login', [
            'errors' => [],
            'old' => []
        ]);
    }

    public function authenticate()
    {
        if (AuthHelper::isUserLoggedIn()) {
            $this->redirectToHome();
        }

        if (!$this->isPostRequest()) {
            $this->redirectToLogin();
        }

        $loginUserDTO = $this->userMapper->toLoginUserDTO(
            $_POST['login'] ?? "",
            $_POST['password'] ?? ""
        );

        $authenticationResult = $this->userService->authenticate($loginUserDTO);

        if (!$authenticationResult->isSuccess()) {
            $this->view('user/login', [
                'errors' => $authenticationResult->getErrors(),
                'old' => $_POST
            ]);
            return;
        }

        AuthHelper::saveUserSession($authenticationResult->getUser());
        $this->redirectToHome();
    }

    public function logout(): void
    {
        if (AuthHelper::isUserLoggedIn()) {
            AuthHelper::destroySession();
        }

        $this->redirectToHome();
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

    private function redirectToLogin(): void
    {
        header('Location: /my-php-mvc-app/user/login');
        exit;
    }

    private function getCreateUserDTO(): CreateUserDTO
    {
        return $this->userMapper->toCreateUserDTO(
            $_POST['name'],
            $_POST['email'],
            $_POST['email_confirmation'],
            $_POST['password'],
            $_POST['password_confirmation'],
            $_POST['contact']
        );
    }

    private function redirectToHome(): void
    {
        header('Location: /my-php-mvc-app/home/');
        exit;
    }
}
