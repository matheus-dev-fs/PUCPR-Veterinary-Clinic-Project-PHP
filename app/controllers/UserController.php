<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\dtos\CreateUserDTO;
use app\services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function register()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /my-php-mvc-app/home/');
            exit;
        }

        $this->view('user/register');
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /my-php-mvc-app/user/register');
            exit;
        }

        $createUserDTO = $this->getCreateUserDTO();

        $user = $this->userService->save($createUserDTO);

        if (is_array($user) ) {
            $_SESSION['errors'] = $user['errors'];
            $_SESSION['old'] = $_POST;
            header('Location: /my-php-mvc-app/user/register');
            exit;
        }

        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];

        header('Location: /my-php-mvc-app/home/');
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
}
