<?php
declare(strict_types=1);

namespace app\responses;

use app\models\Pet;

class PetResponseResult
{
    private ?Pet $pet;
    private array $errors;

    public function __construct(?Pet $pet = null, array $errors = [])
    {
        $this->pet = $pet;
        $this->errors = $errors;
    }

    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
    
    public function isSuccess(): bool
    {
        return $this->pet !== null;
    }
}