<?php
namespace Controllers;
use Models\AnnoncesModel;

class AnnoncesController
{
    public static function annonces()
    {
        $annonces = AnnoncesModel::findAll();
        echo "<pre>";
        var_dump($annonces);
        echo "</pre>";
    }
}