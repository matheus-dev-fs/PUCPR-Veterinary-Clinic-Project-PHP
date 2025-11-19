<?php

declare(strict_types=1);

namespace app\services;

use app\dtos\CreateUserDTO;
use app\dtos\LoginUserDTO;
use app\repositories\UserRepository;
use app\responses\UserResponseResult;
use app\core\Database;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getInstance());
    }

    public function save(CreateUserDTO $createUserDTO): UserResponseResult
    {
        $isAllFieldsValid = $this->isAllFieldsValid($createUserDTO);

        if ($isAllFieldsValid !== true) {
            return new UserResponseResult(null, $isAllFieldsValid);
        }

        $createUserDTO = $createUserDTO->setPhone($this->convertPhoneToDatabaseFormat($createUserDTO->getPhone()));
        $createUserDTO = $createUserDTO->setPassword($this->password_hash($createUserDTO->getPassword()));

        $user = $this->userRepository->save($createUserDTO);
        return new UserResponseResult($user);
    }

    public function authenticate(LoginUserDTO $loginUserDTO): UserResponseResult
    {
        $user = $this->userRepository->findByEmail($loginUserDTO->getEmail());

        if ($user === null || !$this->password_verify($loginUserDTO->getPassword(), $user->getPassword())) {
            return new UserResponseResult(null, ['invalid_credentials' => true]);
        }

        return new UserResponseResult($user);
    }

    private function isAllFieldsValid(CreateUserDTO $createUserDTO): bool | array
    {
        $errors = [];

        if (empty($createUserDTO->getName())) {
            $errors['name_required'] = true;
        } elseif (strlen($createUserDTO->getName()) < 3) {
            $errors['name_length'] = true;
        }

        if (empty($createUserDTO->getEmail())) {
            $errors['email_required'] = true;
        } elseif (!$this->isValidEmail($createUserDTO->getEmail())) {
            $errors['email_invalid'] = true;
        } elseif ($this->emailExists($createUserDTO->getEmail())) {
            $errors['email_exists'] = true;
        }

        if (empty($createUserDTO->getEmailConfirmation())) {
            $errors['email_confirmation_required'] = true;
        } elseif (!$this->isBothFieldsSame($createUserDTO->getEmail(), $createUserDTO->getEmailConfirmation())) {
            $errors['email_confirmation_mismatch'] = true;
        }

        if (empty($createUserDTO->getPassword())) {
            $errors['password_required'] = true;
        } elseif (!$this->isValidPassword($createUserDTO->getPassword())) {
            $errors['password_invalid'] = true;
        }

        if (empty($createUserDTO->getPasswordConfirmation())) {
            $errors['password_confirmation_required'] = true;
        } elseif (!$this->isBothFieldsSame($createUserDTO->getPassword(), $createUserDTO->getPasswordConfirmation())) {
            $errors['password_confirmation_mismatch'] = true;
        }

        if (empty($createUserDTO->getPhone())) {
            $errors['phone_required'] = true;
        } elseif (!$this->isPhoneValid($createUserDTO->getPhone())) {
            $errors['phone'] = true;
        }

        return empty($errors) ? true : $errors;
    }

    private function isValidPassword(string $password): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password) === 1;
    }

    private function isBothFieldsSame(string $field, string $fieldConfirmation): bool
    {
        return $field === $fieldConfirmation;
    }

    private function emailExists(string $email): bool
    {
        return $this->userRepository->existsByEmail($email);
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

    private function password_verify(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}
