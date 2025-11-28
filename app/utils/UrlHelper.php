<?php

declare(strict_types=1);

namespace app\utils;

class UrlHelper
{
    private static ?string $baseUrl = null;

    public static function getBaseUrl(): string
    {
        if (self::$baseUrl === null) {
            self::$baseUrl = self::detectBaseUrl();
        }

        return self::$baseUrl;
    }

    private static function detectBaseUrl(): string
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);
        
        $basePath = str_replace('/public', '', $basePath);
        
        $basePath = '/' . trim($basePath, '/');
        
        return $basePath === '/' ? '' : $basePath;
    }

    public static function to(string $path = ''): string
    {
        $path = ltrim($path, '/');
        $baseUrl = self::getBaseUrl();
        
        return $baseUrl . ($path ? '/' . $path : '');
    }

    public static function asset(string $path): string
    {
        $path = ltrim($path, '/');
        return self::getBaseUrl() . '/public/assets/' . $path;
    }

    public static function current(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '';
    }
}
