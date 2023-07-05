<?php
namespace Controllers;

class MainController
{
    // Methode pour envoyer a la bonne vue
    public static function render()
    {
        $data = "mes données";
        require_once ROOT . '/Views/layout.php';
    }


   // pour tester

    public static function test()
    {
        self::render();
    }

}

