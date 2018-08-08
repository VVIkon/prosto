<?php
namespace framework;
use framework\VI;

require(dirname(__FILE__).'/framework/VI.php');

spl_autoload_register(function ($class_name) {
    $base_dir = __DIR__ . '/';
    $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
    $fileName =  $base_dir . $class_name . '.php';
    if (is_readable($fileName)) {
        require($fileName);
    }
});


$vi = VI::createWebApp();
$vi->run();