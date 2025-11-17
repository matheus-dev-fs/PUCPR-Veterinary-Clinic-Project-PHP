<?php
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

    public function save(CreateUserDTO $createUserDTO): User | array
    {
        $isAllFieldsValid = $this->isAllFieldsValid($createUserDTO);

        if ($isAllFieldsValid !== true) {
            return ['errors' => $isAllFieldsValid];
        }

        $createUserDTO = $createUserDTO->setPhone($this->convertPhoneToDatabaseFormat($createUserDTO->getPhone()));
        $createUserDTO = $createUserDTO->setPassword($this->password_hash($createUserDTO->getPassword()));

        return $this->userRepository->save($createUserDTO);
    }

    private function isAllFieldsValid(CreateUserDTO $createUserDTO): bool | array
    {
        $errors = [];

        if (!$this->isValidPassword($createUserDTO->getPassword())) {
            $errors['password'] = 'A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.';
        }

        if ($this->userExists($createUserDTO->getEmail())) {
            $errors['email'] = 'Email já cadastrado.';
        }

        if (!$this->isValidEmail($createUserDTO->getEmail())) {
            $errors['email'] = 'Formato de email inválido.';
        }

        if (!$this->isPhoneValid($createUserDTO->getPhone())) {
            $errors['phone'] = 'O número de telefone deve estar no formato (XX) XXXXX-XXXX.';
        }

        return empty($errors) ? true : $errors;
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

    private function convertPhoneToDatabaseFormat(string $phone): string
    {
        return preg_replace('/\D/', '', $phone);
    }

    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function password_hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
