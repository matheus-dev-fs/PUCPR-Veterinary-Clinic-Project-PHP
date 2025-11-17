<?php 
declare(strict_types=1);

namespace app\models;

class User 
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $phone;
    private \DateTime $createdAt;

    public function __construct(int $id, string $name, string $email, string $password, string $phone, \DateTime $createdAt) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->createdAt = $createdAt;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }
}
?>