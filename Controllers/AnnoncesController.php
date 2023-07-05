<?php
namespace Controllers;

use Models\AnnoncesModel;
use Models\CategoriesModel;

class AnnoncesController extends MainController{
    public static function annonces($order = null, $limit = null){
        // Si l'utilisateur veut afficher les annonces d'une categorie
        if(isset($_GET['id_categorie']) && $_GET['id_categorie'] != ""){
            $idCat = $_GET['id_categorie'];
            $annonces = AnnoncesModel::findByIdCat([$idCat]);
            if(isset($_GET['price'])){
                $order = $_GET['price'];
                $annonces = AnnoncesModel::findByIdCat([$idCat],$order);
            }
        }else if(isset($_GET['price'])){
            $order = $_GET['price'];
            $annonces = AnnoncesModel::findAll($order);
        }else {
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

    public static function detail($id){
        $annonce = AnnoncesModel::findById([$id]);

        self::render('annonces/detail', [
            'title' => 'détail de l\'annonce',
            'annonce' => $annonce
        ]);
    }
}