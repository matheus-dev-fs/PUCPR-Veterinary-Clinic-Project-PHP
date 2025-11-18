<?php
declare(strict_types=1);

namespace app\responses;

use app\models\User;

class UserResponseResult
{
    private ?User $user;
    private array $errors;

    public function __construct(?User $user = null, array $errors = [])
    {
        $this->user = $user;
        $this->errors = $errors;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
    
    public function isSuccess(): bool
    {
        return $this->user !== null;
    }
}