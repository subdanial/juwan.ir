<?php
spl_autoload_register(function($class){
    $class = strtolower($class);
    $path = "../classes/{$class}.class.php";
    if(file_exists($path))
    {
        include_once $path;
    }
    else{
        echo "{$path} not found";
    }
});

?>

