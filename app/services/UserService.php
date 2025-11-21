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
    private const MIN_NAME_LENGTH = 3;
    private const PASSWORD_PATTERN = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    private const PHONE_PATTERN = '/^\(\d{2}\) \d{4,5}-\d{4}$/';
    private const PHONE_DIGITS_PATTERN = '/\D/';

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getInstance());
    }

    public function save(CreateUserDTO $createUserDTO): UserResponseResult
    {
        $errors = $this->validateUserData($createUserDTO);

        if (!empty($errors)) {
            return new UserResponseResult(null, $errors);
        }

        $createUserDTO = $createUserDTO->setPhone(
            $this->convertPhoneToDatabaseFormat(
                $createUserDTO->getPhone()
            )
        );

        $createUserDTO = $createUserDTO->setPassword(
            $this->hashPassword(
                $createUserDTO->getPassword()
            )
        );

        $user = $this->userRepository->save($createUserDTO);
        return new UserResponseResult($user);
    }

    public function authenticate(LoginUserDTO $loginUserDTO): UserResponseResult
    {
        $user = $this->userRepository->findByEmail($loginUserDTO->getEmail());

        if (
            $user === null || 
            !$this->verifyPassword(
                $loginUserDTO->getPassword(), 
                $user->getPassword()
            )
        ) {
            return new UserResponseResult(null, ['invalid_credentials' => true]);
        }

        return new UserResponseResult($user);
    }

    private function validateUserData(CreateUserDTO $createUserDTO): array
    {
        $errors = [];

        $errors = array_merge($errors, $this->validateName($createUserDTO->getName()));
        $errors = array_merge($errors, $this->validateEmail($createUserDTO->getEmail()));
        $errors = array_merge($errors, $this->validateEmailConfirmation(
            $createUserDTO->getEmail(),
            $createUserDTO->getEmailConfirmation()
        ));
        $errors = array_merge($errors, $this->validatePassword($createUserDTO->getPassword()));
        $errors = array_merge($errors, $this->validatePasswordConfirmation(
            $createUserDTO->getPassword(),
            $createUserDTO->getPasswordConfirmation()
        ));
        $errors = array_merge($errors, $this->validatePhone($createUserDTO->getPhone()));

        return $errors;
    }

    private function validateName(string $name): array
    {
        $errors = [];

        if (empty($name)) {
            $errors['name_required'] = true;
        } elseif (strlen($name) < self::MIN_NAME_LENGTH) {
            $errors['name_length'] = true;
        }

        return $errors;
    }

    private function validateEmail(string $email): array
    {
        $errors = [];

        if (empty($email)) {
            $errors['email_required'] = true;
        } elseif (!$this->isValidEmail($email)) {
            $errors['email_invalid'] = true;
        } elseif ($this->emailExists($email)) {
            $errors['email_exists'] = true;
        }

        return $errors;
    }

    private function validateEmailConfirmation(string $email, string $emailConfirmation): array
    {
        $errors = [];

        if (empty($emailConfirmation)) {
            $errors['email_confirmation_required'] = true;
        } elseif ($email !== $emailConfirmation) {
            $errors['email_confirmation_mismatch'] = true;
        }

        return $errors;
    }

    private function validatePassword(string $password): array
    {
        $errors = [];

        if (empty($password)) {
            $errors['password_required'] = true;
        } elseif (!$this->isValidPassword($password)) {
            $errors['password_invalid'] = true;
        }

        return $errors;
    }

    private function validatePasswordConfirmation(string $password, string $passwordConfirmation): array
    {
        $errors = [];

        if (empty($passwordConfirmation)) {
            $errors['password_confirmation_required'] = true;
        } elseif ($password !== $passwordConfirmation) {
            $errors['password_confirmation_mismatch'] = true;
        }

        return $errors;
    }

    private function validatePhone(string $phone): array
    {
        $errors = [];

        if (empty($phone)) {
            $errors['phone_required'] = true;
        } elseif (!$this->isPhoneValid($phone)) {
            $errors['phone'] = true;
        }

        return $errors;
    }

    private function isValidPassword(string $password): bool
    {
        return preg_match(self::PASSWORD_PATTERN, $password) === 1;
    }

    private function emailExists(string $email): bool
    {
        return $this->userRepository->existsByEmail($email);
    }

    private function isPhoneValid(string $phone): bool
    {
        return preg_match(self::PHONE_PATTERN, $phone) === 1;
    }

    private function convertPhoneToDatabaseFormat(string $phone): string
    {
        return preg_replace(self::PHONE_DIGITS_PATTERN, '', $phone);
    }

    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function verifyPassword(string $password, string $hashedPassword): bool
    {
        if ($hashedPassword === null || $hashedPassword === '') {
            return false;
        }

        return password_verify($password, $hashedPassword);
    }
}