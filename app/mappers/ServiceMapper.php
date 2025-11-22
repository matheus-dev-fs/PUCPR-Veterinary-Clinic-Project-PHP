<?php 
declare(strict_types=1);

namespace app\mappers;
use app\models\Service;

class ServiceMapper
{
    public function toServiceArray(array $data): array
    {
        $array = [];

        foreach ($data as $item) {
            $service = new Service(
                $item['id'],
                $item['name'],
                $item['description']
            );

            $array[] = $service;
        }
        
        return $array;
    }

    public function toService(?array $data): ?Service
    {
        if ($data === null) {
            return null;
        }

        return new Service(
            $data['id'],
            $data['name'],
            $data['description']
        );
    }
}