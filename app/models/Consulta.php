<?php 
declare(strict_types=1);

namespace app\models;

class Consulta 
{
    private int $id;
    private int $id_pet;
    private int $id_servico;
    private \DateTime $data_consulta;
    private string $status_consulta;
    private string $observacoes;

    public function __construct(int $id, int $id_pet, int $id_servico, \DateTime $data_consulta, string $status_consulta, string $observacoes) {
        $this->id = $id;
        $this->id_pet = $id_pet;
        $this->id_servico = $id_servico;
        $this->data_consulta = $data_consulta;
        $this->status_consulta = $status_consulta;
        $this->observacoes = $observacoes;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdPet(): int {
        return $this->id_pet;
    }

    public function getIdServico(): int {
        return $this->id_servico;
    }

    public function getDataConsulta(): \DateTime {
        return $this->data_consulta;
    }

    public function getStatusConsulta(): string {
        return $this->status_consulta;
    }

    public function getObservacoes(): string {
        return $this->observacoes;
    }
}