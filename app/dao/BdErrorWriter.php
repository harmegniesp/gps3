<?php
declare(strict_types=1);
namespace app\dao;

/*
 * syntaxe SQL table tb_erreur
 * CREATE TABLE IF NOT EXISTS `tb_erreur` (
`idErreur` int(11) NOT NULL AUTO_INCREMENT,
  `dateErreur` varchar(50) NOT NULL,
  `messageErreur` text NOT NULL,
  PRIMARY KEY (`idErreur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class BdErrorWriter implements Observer {

    private $pdo = null;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function update($value)
    {
        // TODO: Implement update() method.
        $this->pdo->exec("set names 'utf8'");
        $sql = "INSERT INTO tb_erreur VALUES(NULL,:dateErreur,:messageErreur);";
        $pst = $this->pdo->prepare($sql);
        $now = new \DateTime();
        $pst->bindValue('dateErreur',$now->format('Y-m-d H:i:s'),\PDO::PARAM_STR);
        $pst->bindValue('messageErreur',$value,\PDO::PARAM_STR);
        $pst->execute();
        $pst = null;
    }
}