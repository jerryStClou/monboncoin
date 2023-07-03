<?php
namespace Models;

use PDO;
use App\Db;
class CategoriesModel extends Db
{
   //Methode de lecture

   //trouver toutes les categories
   public static function findAll()
   {
    $request = "SELECT * FROM categories";
    $reponse = self::getDb()->prepare($request);
    $reponse->execute();

    return $reponse->fetchAll(PDO::FETCH_ASSOC);
   }

   // Trouver une  categorie par son id
   public static function findById(array $id)
   {
       $request = "SELECT * FROM categories WHERE id_categorie = ?";
       $reponse = self::getDb()->prepare($request);
       $reponse->execute($id);
       return $reponse->fetch(PDO::FETCH_ASSOC);
   }

   //Trouver une categorie par son nom
   public static function findByTitle(array $title)
   {
      $request = "SELECT * FROM categories WHERE title = ?";
      $reponse = self::getDb()->prepare($request);
      $reponse->execute($title);
      return $reponse->fetch(PDO::FETCH_ASSOC);
   }    



   //Méthodes d'écriture

   // Ajouter une categorie
   public static function create(array $data)
   {
      $request = "INSERT INTO categories (title) VALUE (?)";
      $reponse = self::getDb()->prepare($request);
      $reponse->execute($data);

      return self::getDb()->lastInsertId();
   }

   //Modification d'une categorie
   public static function update(array $data)
   {
       $request = "UPDATE categories SET title = ? WHERE id_categorie = ?";
       $reponse = self::getDb()->prepare($request);
       return $reponse->execute($data);
   }

   // Methode de suppression
   public static function delete(array $title)
   {
      $request = "DELETE FROM categories WHERE title = ?";
      $reponse = self::getDb()->prepare($request);
      $reponse->execute($title);

   }
}