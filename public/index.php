<?php
use App\Router;
// ce fichier et le point d'entrée de notre site

// on ouvre une session
session_start();
// C'est ici qu'il daut faire appelle a l'autoloader
// Création d'une constante pour l'url de base du site
$config = file_get_contents('../App/config.json');
// var_dump($config);
$config = json_decode($config);
// var_dump($config);
define("SITEBASE",$config->baseSite);
// echo SITEBASE;

// Créer une autre constante pour la racine du projet
define("ROOT", dirname(__DIR__));
// echo ROOT;


require_once(ROOT . DIRECTORY_SEPARATOR . "autoloader.php");

// echo "bienvenu sur le site";

$newRouteur = new Router;
$newRouteur->app();