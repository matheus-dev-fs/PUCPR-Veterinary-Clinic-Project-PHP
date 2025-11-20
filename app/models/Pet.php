<?php 
declare(strict_types=1);

namespace app\models;

class Pet {
    private int $id;
    private int $id_user;
    private string $name;
    private string $type;
    private string $gender;

    public function __construct(int $id, int $id_user, string $name, string $type,string $gender) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->name = $name;
        $this->type = $type;
        $this->gender = $gender;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdUser(): int {
        return $this->id_user;
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