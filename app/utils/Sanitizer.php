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

    public static function name(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return \ucwords(self::sanitize($value));
    }

    public static function email(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return strtolower(filter_var(trim($value), FILTER_SANITIZE_EMAIL));
    }

    public static function e(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
}
