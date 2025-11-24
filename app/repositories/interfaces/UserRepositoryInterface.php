<?php 
declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\User;
use app\dtos\CreateUserDTO;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function existsByEmail(string $email): bool;
    public function save(CreateUserDTO $userDTO): ?User;
    public function findByEmail(string $email): ?User;
}