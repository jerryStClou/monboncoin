<?php

namespace Controllers;

class MainController
{
    // Méthode pour envoyer à la bonne vue
    public static function render($views, $data = [])
    {
        // $data = ['title' => 'connexion'];
        extract($data);
        // $title = 'connexion';
        // On met en memoire tampon
        ob_start();

        // On appel la bonne vue
        require_once ROOT . '/Views/' . $views . '.php';
        // Je vide la memoire dans la varible $content
        $content = ob_get_clean();
        // On appel la vue principale
        require_once ROOT . '/Views/layout.php';
    }

    // Méthode de sécurisation des saisies de formulaire
    public static function security(){
        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $_POST['key'] = htmlspecialchars(trim($value));
            }
        }
    }


    // pour tester
    // public static function test(){
    //     self::render('annonces/annonces',['titre'=>'toutes les annonces', 'annonces' => 'voici les données']);
    // }
}
