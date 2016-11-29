<?php
declare(strict_types=1);
namespace app\dao;


// paramètres pour la database
class Parameters
{

    const DSN = "mysql:host=localhost;dbname=gestiondepresence;port=3306";
    const USER = "root";
    const PASSWORD = "";


    // DEBUG
    const PATHFILEDEBUG = "C:/wamp64/www/GestionDePresenceSlim3/temp/log/debug.log";
}