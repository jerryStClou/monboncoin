<?php

namespace Models;
use PDO;
use App\Db;

class UsersModel extends Db
{
    // -------CRUD-------------------

    //Methode de lecture

    public static function findAll()
    {
        $request = "SELECT * FROM users";
        $response = self::getDb()->prepare($request);
        $response->execute();
        return $response->fetchAll(PDO::FETCH_ASSOC);
    } 



     // Trouver un  user par son id
   public static function findById(array $id)
   {
       $request = "SELECT * FROM users WHERE id_user = ?";
       $reponse = self::getDb()->prepare($request);
       $reponse->execute($id);
       return $reponse->fetch(PDO::FETCH_ASSOC);
   }

   //trouver un user par son login
   /**
    * Attend un login user 
    * @param array $login[string]
    */

    public static function findByLogin($login)
    {
        $request = "SELECT * FROM users WHERE login = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($login);
        return $response->fetch(PDO::FETCH_ASSOC);
    }


    //Methode d'ecriture

    //Creer un user
    public static function create(array $data)
    {
        // data est un tableau qui contient les infos du user à insérer en bdd
        $request = "INSERT INTO users (login, password, firstname, lastname, adress, cp, city, phone) VALUES (?,?,?,?,?,?,?,?) ";
        $response = self::getDb()->prepare($request);
        return $response->execute($data);
    } 

    // Update user
    public static function update(array $data)
    {
        $request = "UPDATE users SET login =?, password = ?, firstname = ?, lastname = ?, adress = ?, cp = ?, city = ?, phone = ? WHERE id_user = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
  
    }

    // Methode de suppression
    public static function delete(array $id)
   {
      $request = "DELETE FROM users WHERE id_user = ?";
      $reponse = self::getDb()->prepare($request);
      return $reponse->execute($id);
   }
}