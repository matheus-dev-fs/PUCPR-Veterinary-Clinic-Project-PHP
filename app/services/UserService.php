<?php

declare(strict_types=1);

namespace app\services;

use app\dtos\CreateUserDTO;
use app\repositories\UserRepository;
use app\responses\UserRegistrationResult;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function save(CreateUserDTO $createUserDTO): UserRegistrationResult
    {
        $isAllFieldsValid = $this->isAllFieldsValid($createUserDTO);

        if ($isAllFieldsValid !== true) {
            return new UserRegistrationResult(null, $isAllFieldsValid);
        }

        $createUserDTO = $createUserDTO->setPhone($this->convertPhoneToDatabaseFormat($createUserDTO->getPhone()));
        $createUserDTO = $createUserDTO->setPassword($this->password_hash($createUserDTO->getPassword()));

        $user = $this->userRepository->save($createUserDTO);
        return new UserRegistrationResult($user);
    }

    private function isAllFieldsValid(CreateUserDTO $createUserDTO): bool | array
    {
        $errors = [];

        if (empty($createUserDTO->getName())) {
            $errors['name_required'] = 'O nome é obrigatório.';
        } elseif (strlen($createUserDTO->getName()) < 3) {
            $errors['name_length'] = 'O nome deve ter pelo menos 3 caracteres.';
        }

        if (empty($createUserDTO->getEmail())) {
            $errors['email_required'] = 'O email é obrigatório.';
        } elseif (!$this->isValidEmail($createUserDTO->getEmail())) {
            $errors['email_invalid'] = 'Formato de email inválido.';
        } elseif ($this->emailExists($createUserDTO->getEmail())) {
            $errors['email_exists'] = 'O email informado já está em uso.';
        }

        if (empty($createUserDTO->getEmailConfirmation())) {
            $errors['email_confirmation_required'] = 'A confirmação de email é obrigatória.';
        } elseif (!$this->isBothFieldsSame($createUserDTO->getEmail(), $createUserDTO->getEmailConfirmation())) {
            $errors['email_confirmation_mismatch'] = 'O email e a confirmação de email não coincidem.';
        }

        if (empty($createUserDTO->getPassword())) {
            $errors['password_required'] = 'A senha é obrigatória.';
        } elseif (!$this->isValidPassword($createUserDTO->getPassword())) {
            $errors['password_invalid'] = 'A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.';
        }

        if (empty($createUserDTO->getPasswordConfirmation())) {
            $errors['password_confirmation_required'] = 'A confirmação de senha é obrigatória.';
        } elseif (!$this->isBothFieldsSame($createUserDTO->getPassword(), $createUserDTO->getPasswordConfirmation())) {
            $errors['password_confirmation_mismatch'] = 'A senha e a confirmação de senha não coincidem.';
        }

        if (empty($createUserDTO->getPhone())) {
            $errors['phone_required'] = 'O número de telefone é obrigatório.';
        } elseif (!$this->isPhoneValid($createUserDTO->getPhone())) {
            $errors['phone'] = 'O número de telefone deve estar no formato (XX) XXXXX-XXXX.';
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
}
