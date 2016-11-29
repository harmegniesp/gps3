<?php
declare(strict_types=1);
namespace app\entitiesTools;

class Logger
{

    public static function writeLog ($pathLog,$type,$value){

        $idFile = fopen($pathLog,"a+");
        flock($idFile, LOCK_EX);
        $message = "";
        $message .= "type Erreur : " .$type . "\n";
        $message .= "Date Erreur : " . date("d M Y H:i:s") . "\n";
        $message .= "Message d'erreur : " . $value . "\n";
        fwrite($idFile,$message);
        fflush($idFile);
        flock($idFile, LOCK_UN);
        fclose($idFile);


    }

}
?>