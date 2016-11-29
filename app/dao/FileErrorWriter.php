<?php
declare(strict_types=1);
namespace app\dao;
class FileErrorWriter implements Observer {

    private $file = null;
    public function __construct($file){
        $this->file = $file;
    }
    public function update($value)
    {
        // TODO: Implement update() method.
        $idFile = fopen($this->file,"a+");
        flock($idFile, LOCK_EX);
        $message = "";
        $message .= "Date Erreur : " . date("d M Y H:i:s") . "\n";
        $message .= "Message d'erreur : " . $value . "\n";
        fwrite($idFile,$message);
        fflush($idFile);
        flock($idFile, LOCK_UN);
        fclose($idFile);
    }
}