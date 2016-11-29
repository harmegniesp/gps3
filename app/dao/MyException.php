<?php
declare(strict_types=1);

namespace app\dao;

class MyException extends \Exception {

    private static $pathFile = null;

    public function __construct($message) {
        parent::__construct($message);
        if ( self::$pathFile != null )
            $this->saveMessage();
    }

    /*
     * pour gérer le fichier log pour sauvegarder les messages d'erreur spécifiques à la gestion de la DB
     */
    public static function setPathFile($pathFile)
    {
        if ( file_exists($pathFile) )
        self::$pathFile = $pathFile;
    }
    public static function getPathFile(){
        return self::$pathFile;
    }


// modifier le contenu du message
// sauvegarder le message dans un fichier
    public function saveMessage() {
        $idFile = fopen(self::$pathFile,"a+");
        flock($idFile, LOCK_EX);
        $message = "";
        $message .= "Date Erreur : " . date("d M Y H:i:s") . "\n";
        $message .= "Message d'erreur : " . $this->message . "\n";
        fwrite($idFile,$message);
        fflush($idFile);
        flock($idFile, LOCK_UN);
        fclose($idFile);
    }

// retourne un texte (date + contenu du message)
    public function returnMessage() {
        $message = "";
        $message .= "Date Erreur : " . date("d M Y H:i:s") . "\n";
        $message .= "Message d'erreur : " . $this->message . "\n";
        return $message;
    }
}