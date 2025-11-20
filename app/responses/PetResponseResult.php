<?php
declare(strict_types=1);

namespace app\responses;

use app\models\Pet;

class PetResponseResult extends ResponseResult
{
    public function getPet(): ?Pet
    {
        return $this->entity;
    }
}
