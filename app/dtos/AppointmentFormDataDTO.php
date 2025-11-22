<?php
declare(strict_types=1);

namespace app\dtos;

class AppointmentFormDataDTO 
{
    public function __construct(
        private readonly array $pets,
        private readonly array $services
    ) {}

    public function getPets(): array
    {
        return $this->pets;
    }

    public function getServices(): array
    {
        return $this->services;
    }
}