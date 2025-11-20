<?php
declare(strict_types=1);

namespace app\responses;

abstract class ResponseResult
{
    protected $entity;
    protected array $errors;

    public function __construct($entity = null, array $errors = [])
    {
        $this->entity = $entity;
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
    
    public function isSuccess(): bool
    {
        return $this->entity !== null;
    }
}
