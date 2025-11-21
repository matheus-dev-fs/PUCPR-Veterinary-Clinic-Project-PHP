<?php
declare(strict_types=1);

namespace app\dtos;

class UpdatePetDTO
{
    public function __construct(
        private readonly ?int $id = null,
        private readonly ?string $name = null,
        private readonly ?string $type = null,
        private readonly ?string $gender = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }
}