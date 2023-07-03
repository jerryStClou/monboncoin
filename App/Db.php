<?php

namespace App;

class Db
{
    private static $db;

    static function getDb()
    {
        if(!sefl::$db)
        {
            try{
                $config = file_get_contents('../App/config.json');
                $congfig = json_decode($config);
                self::$db = new PDO("mysql:host=".$config->host.";dbname=".$config->dbname, $config->username,$config->password);
            }catch(PDOException $e){
                echo 'le fichier pose problème, erreur : '.$e->getMessage();
            }
        }
        return self::$db;
    }
}

$testBdd = new Db();
var_dump($testBdd);
var_dump(get_class_methods($testBdd));

