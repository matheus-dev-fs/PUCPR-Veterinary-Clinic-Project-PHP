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
}