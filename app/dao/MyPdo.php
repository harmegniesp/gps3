<?php
declare(strict_types=1);
namespace app\dao;

class MyPdo
{
    // classe singleton
    //les attributs
    private static $myPdo=null;
    private static $dsn=null;   //exemple: mysql:host=localhost;dbname=gestiondepresence;port=3306
    private static $user=null;
    private static $password=null;
    private $pdo=null;


    //constructeur , singleton donc le constructeur est en privé
    private function __construct()
    {
        try{
            $this->pdo=new \PDO(self::$dsn,self::$user,self::$password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES,true);
            $this->pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES utf8");
        }
        catch(\PDOException $e){
            throw new \Exception ($e->getMessage());
        }
    }
    /*
     * pour utiliser utf8 avec PDO
     * a) rajouter charset=utf-8 au niveau du constructeur depuis version
     * b) modifier l'attribut avec MYSQL_ATTR_INIT_COMMAND
     * c) avec $this->pdo->exec("SET CHARACTER SET utf8");
     */

    function __destruct()
    {
            $this->pdo = null;
            self::$myPdo = null;
    }

    public static function getInstancePdo()
    {
            if (!isset($myPdo))    {
                self::$myPdo= new MyPdo();
            }
            return self::$myPdo->pdo;

    }
    //retourne un objet Pdo

    public static function getInstanceSingleton()
    {
        if (!isset($myPdo))
        {
            self::$myPdo= new MyPdo();
        }
        return self::$myPdo;


    }
    //retourne une instance de la classe myPdo

    public static function setParameters (string $dsn , string $user , string $password)
    {
        self::$dsn=$dsn;
        self::$user=$user;
        self::$password=$password;

    }


    public function getPdo()
    {
        return $this->pdo;
    }






}
