<?php 
declare(strict_types=1);

namespace app\core;

class RequestHelper
{
    public static function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
?>