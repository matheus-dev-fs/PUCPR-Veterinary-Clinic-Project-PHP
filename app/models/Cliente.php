<?php 
declare(strict_types=1);

namespace app\models;

class Cliente 
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $telefone;
    private \DateTime $dataCadastro;

    public function __construct(int $id, string $nome, string $email, string $senha, string $telefone, \DateTime $dataCadastro) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $telefone;
        $this->dataCadastro = $dataCadastro;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function getDataCadastro(): \DateTime {
        return $this->dataCadastro;
    }
}
?>