<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
}