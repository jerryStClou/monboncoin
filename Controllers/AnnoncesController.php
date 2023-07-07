<?php

namespace Controllers;

use Models\AnnoncesModel;
use Models\CategoriesModel;

class AnnoncesController extends MainController
{
    public static function annonces($order = null, $limit = null)
    {
        // Si l'utilisateur veut afficher les annonces d'une categorie
        if (isset($_GET['id_categorie']) && $_GET['id_categorie'] != "") {
            $idCat = $_GET['id_categorie'];
            $annonces = AnnoncesModel::findByIdCat([$idCat]);
            if (isset($_GET['price'])) {
                $order = $_GET['price'];
                $annonces = AnnoncesModel::findByIdCat([$idCat], $order);
            }
        } else if (isset($_GET['price'])) {
            $order = $_GET['price'];
            $annonces = AnnoncesModel::findAll($order);
        } else {
            // Sinon toutes les annonces 
            $annonces = AnnoncesModel::findAll($order, $limit);
        }
        // Récupération des catégories
        $categories = CategoriesModel::findAll();
        // var_dump($annonces);
        // On utlise la méthode render() pour envoyer toutes les annonces
        self::render('annonces/annonces', [
            'title' => $limit ? 'les dernières annonces' : 'Toutes les annonces',
            'annonces' => $annonces,
            'categories' => $categories
        ]);
    }

    public static function detail($id)
    {
        $annonce = AnnoncesModel::findById([$id]);
        self::render('annonces/detail', [
            'title' => 'détail de l\'annonce',
            'annonce' => $annonce
        ]);
    }

    public static function create()
    {
        $errMsg = "";
        var_dump($_POST);
        var_dump($_FILES);
        // Récupération des catégories
        $categories = CategoriesModel::findAll();

        // Traitement du formulaire
        if (
            !empty($_POST) &&
            !empty($_POST['id_categorie']) &&
            !empty($_POST['title']) &&
            !empty($_POST['price']) &&
            !empty($_POST['description']) &&
            !empty($_FILES['image'])
        ) {
            // Test sur l'image
            if (($_FILES['image']['size'] < 300000) &&
                    (($_FILES['image']['type'] == 'image/jpeg') ||
                    ($_FILES['image']['type'] == 'image/jpg') ||
                    ($_FILES['image']['type'] == 'image/png'))
            ) {
                // Traitement tout ok
                // securisation des saisies
                self::security();
                // On doit enregistrer la photo sur le serveur
                // Avant d'enregistrer l'image je doit m'assurer que son nom est unique
                $photoName = uniqid() . $_FILES['image']['name'];
                echo $photoName;
                // Copie de la  photo sur le serveur
                $copy = copy($_FILES['image']['tmp_name'], ROOT . "/public/images/annonces/" . $photoName);
                // Si la copy à fonctionnée
                if($copy){
                    // Création du tableau de données à envoyer en BDD
                    $data = [
                        // id de l'utilisateur qui crée l'annonce
                        $_SESSION['user']['id'],
                        $_POST['id_categorie'],
                        $_POST['title'],
                        $_POST['description'],
                        $_POST['price'],
                        $photoName
                    ];
                //    On envoie en BDD avec la methode create de AnnoncesModel
                AnnoncesModel::create($data);
                header("location: " . SITEBASE);
                }else{
                    $errMsg = 'problème lors de l\'envoie de la photo';
                }
            }else{
                // image trop grande ou mauvais format
                $errMsg = "image trop grande ou mauvais format";
            }
        }elseif(!empty($_POST) || !empty($_FILES)){
            $errMsg = "merci de remplir tous les champs";
        }
        self::render('annonces/add', [
            'title' => 'Crée votre annonce',
            'categories' => $categories,
            'errMsg' => $errMsg
        ]);
    }

    public static function delete(){
        // Je verie que l'annonce appartienne au user connecté
        $idAnnonce = $_GET['id'];
        $idUser = $_SESSION['user']['id'];
        // Je recupère l'annonce
        $annonceASupp = AnnoncesModel::findById([$idAnnonce]);
        if($annonceASupp['id_user'] == $idUser){
            $userIsOwner = true;
        }

        if(isset($_SESSION['user']) && (($_SESSION['user']['role'] == 1) || $userIsOwner)){
            $id = $_GET['id'];
            AnnoncesModel::delete([$id]);

        }else{
            echo "vous n'avez pas le droit de supprimer cette annonce";
        }
    }


    public static function update()
    {

        $errMsg = "";
        // On récupère les catégories
        $categories = CategoriesModel::findAll();
        // On récupérer l'annonce à modifier
        $id = $_GET['id'];
        $annonce = AnnoncesModel::findById([$id]);
        !$annonce ? header('Location: annonces') : null;
        // Vérifier que l'utilisateur est admin ou que l'utilisateur est le propriétaire de l'annonce
        if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['id'] == $annonce['idUser']) {
            // Traitement de mon formulaire
            if(!empty($_POST['title']) &&
                !empty($_POST['idCategorie']) &&
                !empty($_POST['price']) &&
                !empty($_POST['description'])){
                    // Controle sur la photo
                    // var_dump($_FILES);
                    if (!empty($_FILES['image']['name']) && (
                        ($_FILES['image']['size'] < 3000000) &&
                        (($_FILES['image']['type'] == 'image/jpeg') || 
                        ($_FILES['image']['type'] == 'image/jpg') || 
                        ($_FILES['image']['type'] == 'image/png')))
                    ){
                        $photoName = uniqid() . $_FILES['image']['name'];
                        copy($_FILES['image']['tmp_name'], ROOT . "/public/img/annonces/" . $photoName);

                    }elseif(!empty($_FILES['image']['name'])){
                        $errMsg = "photo trop lourde ou mauvais format";
                    }
                    // on securise
                    self::security();
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = (int)$_POST['price'];
                    $categorie = (int)$_POST['idCategorie'];
                    $idAnnonce = $annonce['idAnnonce'];
                    if(isset($photoName)){
                        $data = [$categorie,$title,$description,$price,$photoName,$idAnnonce];
                    }else{
                        $data = [$categorie,$title,$description,$price,$annonce['image'],$idAnnonce];
                    }
                    // Executer la requete update
                    $annonceModif = AnnoncesModel::update($data);
                    header('Location: annonces');

            }elseif(!empty($_POST)){
                $errMsg = "Merci de remplire tous les champs (a part la photo)";
            }
        }else{
            header('Location: annonces'); 
        }

        self::render('annonces/update' , [
            'title' => 'Modification de l\'annonce'
        ]);
    }
}