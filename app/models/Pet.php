<?php 
declare(strict_types=1);

namespace app\models;

class Pet {
    private int $id;
    private int $userId;
    private string $name;
    private string $type;
    private string $gender;

    public function __construct(int $id, int $userId, string $name, string $type, string $gender) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->type = $type;
        $this->gender = $gender;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getGender(): string {
        return $this->gender;
    }
}