<?php

namespace Controllers;

class MainController
{
    // Méthode pour envoyer à la bonne vue
    public static function render($views, $data = [])
    {
        extract($data);
        // On met en memoire tampon
        ob_start();

        // On appel la bonne vue
        require_once ROOT . '/Views/' . $views . '.php';
        // Je vide la memoire dans la varible $content
        $content = ob_get_clean();
        // On appel la vue principale
        require_once ROOT . '/Views/layout.php';
    }


    // pour tester
    // public static function test(){
    //     self::render('annonces/annonces',['titre'=>'toutes les annonces', 'annonces' => 'voici les données']);
    // }
}