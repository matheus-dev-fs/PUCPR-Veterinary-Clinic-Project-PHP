<?php
declare(strict_types=1);

namespace app\services;

use app\repositories\PetRepository;

class PetService
{
    private PetRepository $petRepository;

    public function __construct()
    {
        $this->petRepository = new PetRepository();
    }
}