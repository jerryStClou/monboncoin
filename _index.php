<?php
use App\Db;
use Models\CategoriesModel;
use Models\UsersModel;
use Models\AnnoncesModel;
require_once('autoloader.php');
/* 
On ouvre une session pour gerer:
la connexion utitlisateur
le panier
---potentiellement toutes les infos neccessaires
Il ne faut jamais enregistrer le mdp (et toutes les données critiques) dans la session pour des raisons de securité
*/
// test de la methosz findAll()
// $categories = CategoriesModel::findAll();

// echo "<pre>";
// var_dump($categories);
// echo "</pre>";

//test de la methode findById();
// $categorie = CategoriesModel::findById([3]);


// echo "<pre>";
// var_dump($categorie);
// echo "</pre>";

//test de la methode findByTitle();
// $vehicule = CategoriesModel::findByTitle(["vehicule"]);


// echo "<pre>";
// var_dump($vehicule);
// echo "</pre>";


//test de création d'une categorie
//  $newCat = CategoriesModel::create(['aaa']);

// echo "<pre>";
// var_dump($newCat);
// echo "</pre>";


//test de modification de categorie

// $catUpdate = CategoriesModel::update(["materiel informatique",5]);


//test de la suppression categorie

//  $catDelete = CategoriesModel::delete(["aaa"]);

//on test la methode findAll() de UsersModel

// $users = UsersModel::findAll();


// echo "<pre>";
// var_dump($users);
// echo "</pre>";




//test de la methode findById();
// $user = UsersModel::findById([1]);


// echo "<pre>";
// var_dump($user);
// echo "</pre>";




//test de la methode findById();
// $user = UsersModel::findByLogin(["jerry@gmail.com"]);


// echo "<pre>";
// var_dump($user);
// echo "</pre>";




// test de la methode create de UsersModel()
// $password = password_hash(" 1234", PASSWORD_BCRYPT);
// $data = ["test@gmail.com",$password, "prenomTest","nomTest","mon adresse",75011,"Paris","01 47 78 98 52"];

// $newUser = UsersModel::create($data);



// test de la methode update() de UsersModel()
// $password = password_hash("1234", PASSWORD_DEFAULT);
// $password2 = password_hash("1234", PASSWORD_DEFAULT);
//  $data = ["admin@gmail.com",$password, "admin","admin","55 Rue du Lieutenant Thomas",93170,"Bagnolet","06 45 73 94 55",1];

//  $data2 = ["jerry@gmail.com",$password2, "Jerry","admin","55 Rue du Lieutenant Thomas",93170,"Bagnolet","06 45 73 94 55",2];

//  $userUpdate = UsersModel::update($data);
//  $userUpdate2 = UsersModel::update($data2);


// test de la methode delete de UsersModel
// UsersModel::delete([3]);


// test de la methode de findAll() de AnnoncesModel
// $order = null;
// $limit = "LIMIT 1";
// $annonces = AnnoncesModel::findAll($order,$limit);
// echo "<pre>";
// print_r($annonces);
// echo "</pre>";



//  test de la methode de findById() de AnnoncesModel

// $annonce = AnnoncesModel::findById([2]);
// echo "<pre>";
// print_r($annonce);
// echo "</pre>";

// test de la methode de findByUser de AnnoncesModel
// $annonce = AnnoncesModel::findByUser([2]);

// echo "<pre>";
// print_r($annonce);
// echo "</pre>";


// test de la methode de findByIdcat de AnnoncesModel
// $order = "price ASC";
// $annonce = AnnoncesModel::findByIdCat([3],$order);

// echo "<pre>";
// var_dump($annonce);
// echo "</pre>";

// test de la methode de create() de AnnoncesModel
//  $data = [1,5,"iphone x","iphone x",400,"6.png"];
// $annonce = AnnoncesModel::create($data);

// test de la methode de update() de AnnoncesModel
// $data = [1,3,"tesla model 3","tesla model 3",42500,"images/5.png",4];
// $annonce = AnnoncesModel::update($data);

// test de la methode de delete() de AnnoncesModel
// $annonce = AnnoncesModel::delete([5]);
