<?php
declare(strict_types=1);

namespace app\entitiesDao;


abstract class Dao
{
    protected $pdo=null;
    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }

    public abstract function insert($object);  //pour encoder un record correspondant à l'entité
    public abstract function delete ($object); //pour supprimer un record correspondant à l'entité
    public abstract function update ($object); //pour modifier un record correspondant à l'entité (id invarié)
    public abstract function find (int $id); //pour récupérer un record correspondant à l'entité (avec id)
    public abstract function findAll(); //pour récupérer l'ensemble des records de la table retourne un ArrayCollection
    public abstract function findAllQuick();
    public abstract function nbRecords(); //pour récupérer le nombre total des records de la table
    public abstract function findWithLimit(int $position, int $group); //pour récupérer un groupe de records

    /*
     * voir si nécessaire de définir des méthodes spécifiques dans les classes dao
     * association multiple côté Many
     */
}

?>