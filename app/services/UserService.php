<?php
session_start();

declare(strict_types=1);

namespace app\services;

use app\dtos\CreateUserDTO;
use app\models\User;
use app\repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function save(CreateUserDTO $createUserDTO): ?User
    {
        if (!$this->isValidPassword($createUserDTO->getPassword())) {
            $_SESSION['errors']['password'] = 'A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.';
            return null;
        }

        if ($this->userExists($createUserDTO->getEmail())) {
            $_SESSION['errors']['email'] = 'Um usuário com este e-mail já existe.';
            return null;
        }

        if (!$this->isPhoneValid($createUserDTO->getPhone())) {
            $_SESSION['errors']['phone'] = 'Numero de telefone inválido.';
            return null;
        }

        $createUserDTO = $createUserDTO->setPhone($this->convertPhoneToDatabaseFormat($createUserDTO->getPhone()));
        $createUserDTO = $createUserDTO->setPassword($this->password_hash($createUserDTO->getPassword()));

        return $this->userRepository->save($createUserDTO);
    }

    private function isValidPassword(string $password): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password) === 1;
    }

    private function userExists(string $email): bool
    {
        return $this->userRepository->existsByName($email);
    }

    private function isPhoneValid(string $phone): bool
    {
        return preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $phone) === 1;
    }

    public function convertPhoneToDatabaseFormat(string $phone): string
    {
        return preg_replace('/\D/', '', $phone);
    }

    public function password_hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
