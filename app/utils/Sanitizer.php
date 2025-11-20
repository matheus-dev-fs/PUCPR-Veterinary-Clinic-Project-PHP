<?php
declare(strict_types=1);

namespace app\utils;

class Sanitizer
{
    public static function sanitize(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return strip_tags(trim($value));
    }

    public static function e(?string $value): string
    {
        if ($value === null) {
            return '';
        }
        
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}