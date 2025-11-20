<?php
declare(strict_types=1);

namespace app\responses;

use app\models\User;

class UserResponseResult extends ResponseResult
{
    public function getUser(): ?User
    {
        return $this->entity;
    }
}
