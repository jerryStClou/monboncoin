<?php
namespace App;

use Controllers\MainController;
use Controllers\AnnoncesController;
use Controllers\UsersController;

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
            // MainController::test();
            AnnoncesController::annonces("date DESC", "LIMIT 2");
            break;
        case 'annonces':
            // echo 'toutes les annonces';
            AnnoncesController::annonces();
            break;
        case 'annonceDetail':
            // echo 'affichage d\'une annonce';
            $id = $_GET["id"];
            AnnoncesController::detail($id);
            break;
        case 'annonceAjout':
            // echo 'ajout d\'une annonce';
            AnnoncesController::create();
            break;
        case 'annonceModif':
            // echo "modification d'une annonce";
            AnnoncesController::update();
            break;
        case 'annonceSupp':
            // echo "suppression d'une annonce";
            AnnoncesController::delete();           
            break;
        case 'annonceConfirm':
            echo 'confirmation de suppression';
            break;
        case 'panier':
            echo 'votre panier';
            break;
        case 'inscription':
            // echo 'inscription';
            UsersController::inscription();
            break;
        case 'connexion':
            // echo 'connexion';
            UsersController::connexion();
            break;
        case 'deconnexion':
            // echo 'deconnexion';
            // supprimer les donnes user de $_SESSION
            unset($_SESSION["user"]);
            header("location: ". SITEBASE);
            break;
        case 'profil':
            // echo 'profil';
            UsersController::profil();
            break;
        default:
            echo 'cette page n\'existe pas 404';
            break;
       }
    }
}