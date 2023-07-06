<?php

// class Autoload
// {
//     public static function inclusionAuto($className)
//     {
//         require_once __DIR__ . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $className). '.php';
//     }
// }
// spl_autoload_register(array('Autoload','inclusionAuto'));


// echo __DIR__;

// L'autoloader sert a automatiser le require des classes necessaires à l'application

class Autoload {
    public static function inclusionAuto($className) {
        require_once __DIR__ . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $className . '.php');
    }
}
spl_autoload_register(array('Autoload', 'inclusionAuto'));