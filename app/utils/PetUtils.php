<?php
namespace app\utils;

class PetUtils
{
    public static function convertTypeToPtBr(string $type): string
    {
        return match ($type) {
            'dog' => 'Cão',
            'cat' => 'Gato',
            'other' => 'Outro',
            default => 'Desconhecido',
        };
    }

    public static function convertGenderToPtBr(string $gender): string
    {
        return match ($gender) {
            'M' => 'Macho',
            'F' => 'Fêmea',
            default => 'Desconhecido',
        };
    }
}