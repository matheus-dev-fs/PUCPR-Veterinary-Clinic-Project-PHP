<?php 

function dd($var): void {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}
?>