<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\AuthHelper;
use app\core\RedirectHelper;
use app\mappers\UserMapper;
use app\services\UserService;


class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function register(): void
    {
        $this->redirectIfAuthenticated();

        $this->view('user/register', [
            'errors' => [],
            'old' => [],
            'view' => 'user/register'
        ]);
    }

    public function save(): void
    {
        $this->redirectIfAuthenticated();
        $this->ensurePostRequest(RedirectHelper::redirectToRegister(...));

        if (!AuthHelper::validateCsrfToken()) {
            RedirectHelper::redirectTo403();
            return;
        }

        $createUserDTO = UserMapper::toCreateUserDTO(
            $_POST['name'] ?? null,
            $_POST['email'] ?? null,
            $_POST['email_confirmation'] ?? null,
            $_POST['password'] ?? null,
            $_POST['password_confirmation'] ?? null,
            $_POST['phone'] ?? null
        );

        $userRegistrationResult = $this->userService->save($createUserDTO);

        if (!$userRegistrationResult->isSuccess()) {
            $this->view('user/register', [
                'errors' => $userRegistrationResult->getErrors(),
                'old' => $_POST,
                'view' => 'user/register'
            ]);
            return;
        }

        AuthHelper::saveUserSession($userRegistrationResult->getUser());
        RedirectHelper::redirectToWelcome();
    }

    public function login(): void
    {
        $this->redirectIfAuthenticated();

        $this->view('user/login', [
            'errors' => [],
            'old' => [],
            'view' => 'user/login'
        ]);
    }

    public function authenticate(): void
    {
        $this->redirectIfAuthenticated();
        $this->ensurePostRequest(RedirectHelper::redirectToLogin(...));

        if (!AuthHelper::validateCsrfToken()) {
            RedirectHelper::redirectTo403();
            return;
        }

        $loginUserDTO = UserMapper::toLoginUserDTO(
            $_POST['email'] ?? "",
            $_POST['password'] ?? ""
        );

        $authenticationResult = $this->userService->authenticate($loginUserDTO);

        if (!$authenticationResult->isSuccess()) {
            $this->view('user/login', [
                'errors' => $authenticationResult->getErrors(),
                'old' => $_POST,
                'view' => 'user/login'
            ]);
            return;
        }

        AuthHelper::saveUserSession($authenticationResult->getUser());
        RedirectHelper::redirectToWelcome();
    }

    public function logout(): void
    {
        if (AuthHelper::isUserLoggedIn()) {
            AuthHelper::destroySession();
        }

        RedirectHelper::redirectToHome();
    }
}
