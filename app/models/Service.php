<?php 
declare(strict_types=1);

namespace app\models;

class Service
{
    private int $id;
    private string $nome_servico;
    private string $descricao;

    public function __construct(int $id, string $nome_servico, string $descricao, float $preco, \DateTime $dataCriacao) {
        $this->id = $id;
        $this->nome_servico = $nome_servico;
        $this->descricao = $descricao;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNomeServico(): string {
        return $this->nome_servico;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }
}