<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\dtos\CreateUserDTO;
use app\mappers\UserMapper;
use app\services\UserService;
use app\core\AuthHelper;
use app\core\RedirectHelper;

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
            RedirectHelper::redirectToHome();
        }

        $this->view('user/register', [
            'errors' => [],
            'old' => []
        ]);
    }

    public function save()
    {
        if (AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToHome();
        }

        if (!$this->isPostRequest()) {
            RedirectHelper::redirectToRegister();
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
        RedirectHelper::redirectToHome();
    }

    public function login()
    {
        if (AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToHome();
        }

        $this->view('user/login', [
            'errors' => [],
            'old' => []
        ]);
    }

    public function authenticate()
    {
        if (AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToHome();
        }

        if (!$this->isPostRequest()) {
            RedirectHelper::redirectToLogin();
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
        RedirectHelper::redirectToHome();
    }

    public function logout(): void
    {
        if (AuthHelper::isUserLoggedIn()) {
            AuthHelper::destroySession();
        }

        RedirectHelper::redirectToHome();
    }

    private function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
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
}
