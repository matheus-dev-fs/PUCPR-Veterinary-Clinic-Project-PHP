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

    public function save()
    {
        $createUserDTO = $this->getCreateUserDTO();

        $user = $this->userService->save($createUserDTO);

        if (is_array($user) ) {
            $_SESSION['errors'] = $user['errors'];
            dd($user);
        }

        $this->view('home/index');
    }

    private function getCreateUserDTO(): CreateUserDTO
    {
        return new CreateUserDTO(
            'teste5',
            'teste5@gmail.com',
            'Peperaio123#',
            '(41) 99999-9959'
        );
    }
}
