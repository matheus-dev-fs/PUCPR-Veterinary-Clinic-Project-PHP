<?php 

function dd(...$vars): void {
    echo '<pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ddd;">';
    echo "<strong>Debug Output:</strong><br>";

    foreach ($vars as $var) {
        echo "<pre style='background: #fff; padding: 10px; border: 1px solid #ccc; margin: 10px 0;'>";
        var_dump($var);
        echo "</pre>";
    }

    $backtrace = debug_backtrace()[0];
    echo "<br/><strong>Called from:</strong> " . $backtrace['file'] . "<br/>";
    echo "<strong>on line:</strong> " . $backtrace['line'] . "<br/>";

    echo '</pre>';
    die();
}

function config(string $key, $default = null): ?array {
    $config = require __DIR__ . '/../config/Config.php';
    return $config[$key] ?? $default;
}
?>