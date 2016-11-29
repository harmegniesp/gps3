<?php
declare(strict_types=1);
namespace app\dao;
class MyPDOException extends \PDOException implements Observable {

    // tableau pour les observers (observateurs)
    private  $observers = array();

    public function __construct($message) {
        parent::__construct($message);
    }

// retourne le message d'erreur
// possibilité d'utiliser getMessage()
    public function returnMessage()
    {
        $message = "";
        $message .= "Date Erreur : " . date("d M Y H:i:s") . "\n";
        // gérer correctement le fuseau ...
        $message .= "Message d'erreur : " . $this->message . "\n";
        return $message;
    }

    public  function attach($observer)
    {
        // TODO: Implement attach() method.
        $this->observers[] = $observer;
        return $this;
    }

    public function detach($observer)
    {
        // TODO: Implement detach() method.
        if (is_int($key = array_search($observer, $this->observers, true)))
        {
            unset($this->observers[$key]);
            $this->observers = array_values($this->observers); // réaffecter les index ...
        }
        return $this;
    }

    public function notify()
    {
        // TODO: Implement notify() method.
        foreach ($this->observers as $observer)
        {
            $observer->update($this->message);
        }
    }
}