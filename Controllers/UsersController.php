<?php

namespace Controllers;

use Models\UsersModel;

class UsersController extends MainController
{

    // Méthode de connexion
    public static function connexion()
    {
        // Pour gérer les erreurs on untilise une variable $errMsg initialiser à vide
        $errMsg = "";
        var_dump($_POST);
        // traitement du formulaire
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            // On sécurise l saisie
            self::security();
            // etape 1 on verifie que le user est bien en BDD
            $user = UsersModel::findByLogin([$_POST['login']]);
            if (!$user) {
                $errMsg = 'Login ou mot de passse incorrect';
            }else{
                // Si il est present on verifi que le mot de passe est correct
                $pass = $_POST['password'];
                var_dump($user);
                if(password_verify($pass, $user['password'])){
                    // Si tout est ok on enregistre les infos de l'utilisateur connecté
                    // dans $_SESSION
                    $_SESSION['user'] = [
                        'role' => $user['role'],
                        'id' => $user['id_user'],
                        'login' => $user['login'],
                        'firstName' => $user['firstName']
                    ];
                    header('Location: ' . SITEBASE);
                }else{
                    $errMsg = 'Login ou mot de passse incorrect';
                }
                
            }
            // Pour ne pas dire "merci de remplir tous les champs" à l'ouverture de la page coonxion je doit vérifier que le formulaire a été soumis donc je verifie que $_POST ne soit pas vide
        }elseif(!empty($_POST)){
            $errMsg = "Merci de remplir tous les champs";
        }


        self::render('users/connexion', [
            'title' => 'Connexion',
            'errMsg' => $errMsg
        ]);
    }

    // Méthode d'inscription
    public static function inscription()
    {
        $errMsg = "";
        // Regex du mot de passe
        $pattern = '/^.{8,}$/';
        // Traitement du formulaire
        if(
            !empty($_POST) &&
            !empty($_POST['login']) &&
            !empty($_POST['firstname']) &&
            !empty($_POST['lastname']) &&
            !empty($_POST['adress']) &&
            !empty($_POST['cp']) &&
            !empty($_POST['city']) &&
            !empty($_POST['phone']) &&
            !empty($_POST['password'])
             
        ){
            // On vérifie que le mail est bien un email
            if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                $errMsg .= "Merci de saisir un email valide <br>";
            }
            if(!($_POST['password'] == $_POST['confirm']))
            {
                $errMsg .= "les mots de passe ne sont pas identique  <br>";
            }
            // On vérifie que le password correspond bien au format attendue
            if (!preg_match($pattern, $_POST['password'])) {
                $errMsg .= "Merci de saisir un mot de passe qui contient 8  caractères minimum  <br>";
            }

            // Si tout est ok, on enregistre le user en BDD
            if(!$errMsg)
            {
                // On securise les saisies
                self::security();
                // On verifie que le login ne soit pas deja en BDD
                $login = $_POST["login"];
                $testLogin = UsersModel::findByLogin([$login]);
                if($testLogin)
                {
                    $errMsg = "Ce login est déja présent";
                } else{
                    // On n'enregistre en BDD
                    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $data = [
                        $_POST["login"],
                        $pass, 
                        $_POST["firstname"],
                        $_POST["lastname"],
                        $_POST["adress"],
                        $_POST["cp"],
                        $_POST["city"],
                        $_POST["phone"]
                    ];
                    $newUser = UsersModel::create($data);
                    if($newUser)
                    {
                        // J'ajoute un message dans la session pour pouvoir l'afficher ou je veux dans l'application
                        $_SESSION['message'] = "Votre compte est bien crée, vous pouvez vous connecter";
                        header("location: connexion");
                    }                    
                }
            }

        }elseif(!empty($_POST)) {
            $errMsg = "Merci de remplir tous les champs";
        }


        self::render('users/inscription', [
            'title' => 'Inscription',
            'errMsg' => $errMsg
        ]);
    }

    // Methode de gestion du profil
      // Méthode de gestion du profil
      public static function profil(){
        // Teste sur le role de l'utilisateur
        if($_SESSION['user']['role'] == 1)// je suis admin, donc je recupère toutes les annonces
        {
            $annonces = AnnoncesModel::findAll();
        }else{
            // Uniquement les annonces du user connecté
            $userId = $_SESSION['user']['id'];
            $annonces = AnnoncesModel::findByUser([$userId]);
        }


        self::render('users/profil',[
            'title' => "votre profil",
            'annonces' => $annonces
        ]);
    }
}