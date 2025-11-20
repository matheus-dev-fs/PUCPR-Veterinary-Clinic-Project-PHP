<?php 
declare(strict_types=1);

namespace app\utils;

class Sanitizer
{
    public static function sanitize($value): string
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }
}