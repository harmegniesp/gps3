<?php
declare(strict_types=1);
namespace app\entitiesTools;

class Conversion
{

    // convertir une chaîne datetime SQL en objet DateTime

    public static function convertDatetime_DateTime($chaine)
    {

        // vérifier si format correct
        $pattern = '#^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}\:[0-9]{2}\:[0-9]{2}$#';
        if (!preg_match($pattern, $chaine))
            throw new \Exception("l'argument n'a pas un format datetime sql");
        else {
            $tab = preg_split("/[\s\-\:]+/", $chaine);
           // var_dump($tab);
            // tableau avec 6 cellules
            $dateTime = new \DateTime();
            $dateTime->setDate((int)$tab[0], (int)$tab[1], (int)$tab[2]);
            $dateTime->setTime((int)$tab[3], (int)$tab[4], (int)$tab[5]);
            return $dateTime;
        }
    }

    // convertir une chaîne date SQL en objet DateTime
    public static function convertDate_DateTime($chaine)
    {

        // vérifier si format correct
        $pattern = '#^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$#';
        if (!preg_match($pattern, $chaine))
            throw new \Exception("l'argument n'a pas un format datetime sql");
        else {
            $tab = preg_split("/[\s\-\:]+/", $chaine);
            //var_dump($tab);
            // tableau avec 3 cellules
            $dateTime = new \DateTime();
            $dateTime->setDate((int)$tab[0], (int)$tab[1], (int)$tab[2]);
            return $dateTime;
        }
    }

    // convertir une valeur 0 ou 1 (tinyInt bd mysql) vers une valeur booléenne false ou true ...
    public static function convertTinyIntBoolean (int $val):bool{
        $convert =  ($val == 0)?false:true;
        return $convert;
    }

}