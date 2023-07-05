<?php
namespace App;

use Controllers\MainController;
use Controllers\AnnoncesController;

class Router
{
    public function app()
    {
         // on test le routeur
        // echo "<br> le routeur fonctionne";
       // Récupération de l'url
       $request = $_SERVER["REQUEST_URI"];
    //    echo "<pre>";
    //    var_dump($request); 
    //    echo "</pre>";

      // On supprime tout le debut ("/monboncoin/public") de $request
      $nb = strlen(SITEBASE);
    //   echo $nb;
      $request = substr($request, $nb);
      echo "<br>";
    //   echo $request;    
      $request = explode("?",$request);
      $request = $request[0];
    //   echo $request;

    //   on defini les routes du projet

       switch ($request)
       {
        case '':
            // echo 'page d\'accueil affiche les deux dernières annonces';
            MainController::test();
            break;
        case 'annonces':
            echo 'toutes les annonces';
            AnnoncesController::annonces();
            break;
        case 'annonceDetail':
            echo 'affichage d\'une annonce';
            break;
        case 'annonceAjout':
            echo 'ajout d\'une annonce';
            break;
        case 'annonceModif':
            echo "modification d'une annonce";
            break;
        case 'annonceSupp':
            echo "suppression d'une annonce";
            break;
        case 'annonceConfirm':
            echo 'confirmation de suppression';
            break;
        case 'panier':
            echo 'votre panier';
            break;
        case 'inscription':
            echo 'inscription';
            break;
        case 'connexion':
            echo 'connexion';
            break;
        case 'deconnexion':
            echo 'deconnexion';
            break;
        case 'profil':
            echo 'profil';
            break;
        default:
            echo 'cette page n\'existe pas 404';
            break;
       }
    }
}