<?php 
declare(strict_types=1);

namespace app\models;

class Pet {
    private int $id;
    private int $id_cliente;
    private string $nome_pet;
    private string $sexo;

    public function __construct(int $id, int $id_cliente, string $nome_pet, string $sexo) {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->nome_pet = $nome_pet;
        $this->sexo = $sexo;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdCliente(): int {
        return $this->id_cliente;
    }

    public function getNomePet(): string {
        return $this->nome_pet;
    }

    public function getSexo(): string {
        return $this->sexo;
    }
}