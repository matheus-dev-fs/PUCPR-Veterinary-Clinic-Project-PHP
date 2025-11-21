<?php

declare(strict_types=1);

namespace app\utils;

class ViewHelper
{
    public static function val(?string $oldValue, ?string $dbValue): string
    {
        return Sanitizer::e($oldValue ?? $dbValue ?? '');
    }

    public static function checked(
        string $valueToCheck, 
        ?string $oldValue, 
        ?string $dbValue
    ): string
    {
        $actualValue = $oldValue ?? $dbValue;
        return (string)$actualValue === $valueToCheck ? 'checked' : '';
    }

    public static function selected(
        string $valueToCheck, 
        ?string $oldValue, 
        ?string $dbValue
    ): string
    {
        $actualValue = $oldValue ?? $dbValue;
        return (string)$actualValue === $valueToCheck ? 'selected' : '';
    }
}