<?php
declare(strict_types=1);
namespace app\entitiesDao;


class SchoolDao extends Dao
{

    // $object est passé par référence ; pas besoin de faire un return à la fin dans la méthode
    public function insert($object)
    {
        if ($object==null)
        throw new \Exception("objet school null");
    elseif(!($object instanceof \app\entities\School))
        throw new \Exception("l'objet n'est pas de type School");
    elseif ($object->getId()!=0)
        throw new \Exception("objet school déjà enregistré");
    else {
        $this->pdo->exec("SET NAMES 'UTF8';");
        $sql="INSERT INTO school VALUES (null,
                                            :name,
                                            :codeSchool,
                                            :phone,
                                            :address);";
        $pst=$this->pdo->prepare($sql);
        $pst->bindValue('name',$object->getName(),\PDO::PARAM_STR);
        $pst->bindValue('codeSchool',$object->getCodeSchool(),\PDO::PARAM_STR);
        $pst->bindValue('phone',$object->getPhone(),\PDO::PARAM_STR);
        $pst->bindValue('address',$object->getAddress(),\PDO::PARAM_STR);
        $pst->execute();
        $id=$this->pdo->lastInsertId();
        $object->setId((int)$id);
        }
    }

    public function delete($object)
    {
        if ($object==null)
            throw new \Exception("objet school null");
        elseif(!($object instanceof \app\entities\School))
            throw new \Exception("l'objet n'est pas de type School");
        elseif ($object->getId()==0)
            throw new \Exception("objet school déjà enregistré");
        else {

            $sql="DELETE FROM school WHERE id=:id;";
            $pst=$this->pdo->prepare($sql);
            $pst->bindValue('id',$object->getId(),\PDO::PARAM_INT);
            $pst->execute();
        }
    }

    public function update($object)
    {
        if ($object==null)
            throw new \Exception("objet school null");
        elseif(!($object instanceof \app\entities\School))
            throw new \Exception("l'objet n'est pas de type School");
        elseif ($object->getId()==0)
            throw new \Exception("objet school déjà enregistré");
        else {
            $this->pdo->exec("SET NAMES 'UTF8';");
            $sql="UPDATE school SET name=:name,codeSchool=:codeSchool, phone=:phone,address=:address
                  WHERE id=:id;";
            $pst=$this->pdo->prepare($sql);
            $pst->bindValue('name',$object->getName(),\PDO::PARAM_STR);
            $pst->bindValue('codeSchool',$object->getCodeSchool(),\PDO::PARAM_STR);
            $pst->bindValue('phone',$object->getPhone(),\PDO::PARAM_STR);
            $pst->bindValue('address',$object->getAddress(),\PDO::PARAM_STR);
            $pst->bindValue('id',$object->getId(),\PDO::PARAM_INT);
            $pst->execute();
        }
    }

    public function find(int $id):\app\entities\School
    {
        if ($id==0)
            throw new \Exception("argument id incorrect");
        else
        {
            $sql="SELECT * FROM school
                  WHERE id=:id;";
            $pst=$this->pdo->prepare($sql);
            $pst->bindValue('id',$id,\PDO::PARAM_INT);
            $pst->execute();
            $result=$pst->fetch(\PDO::FETCH_ASSOC);
            $pst->closeCursor();
            //var_dump($result);
            // on récupère un tableau 1 dimension donc associatif
            if($result===false)
                throw new \Exception("Id introuvable");
            else{
                // instancier un objet school , lui mettre tous les attributs et retourner l'objet school puis mettre dans un tableau
                $school = new \app\entities\School();
                $result['id']=(int)$result['id'];
                $school->hydrate($result);
                unset($result);
                return $school;
            }
        }
    }

    public function findAll():\app\entitiesTools\ArrayCollection
    {
        $sql="SELECT id FROM school;";
        $st=$this->pdo->query($sql);
        $result = $st->fetchAll(\PDO::FETCH_ASSOC) ;  // on recupère tous les id de tous les records
        //var_dump($result);
        if( empty($result) )
            throw new \Exception("pas d'enregistrements dans la table school");
        else {
            $arrayCollection = new \app\entitiesTools\ArrayCollection();

            foreach ($result as $value) {
                //echo $value;
                //echo $value['id'] ." <br> ";
                $school = $this->find((int)$value['id']);   // à eviter si on a un nombre de records important
                $arrayCollection->addObject($school);
            }
            unset($result);
            return $arrayCollection;
        }
    }

    //methode 2 plus rapide car on ne refait pas une requete à chaque boucle du foreach
    public function findAllQuick():\app\entitiesTools\ArrayCollection
    {
        $sql="SELECT * FROM school;";
        $st=$this->pdo->query($sql);
        $result = $st->fetchAll(\PDO::FETCH_ASSOC) ;
        //var_dump($result); // on recupère un tableau 2 dimension , tableau de tableau
        if( empty($result) )
            throw new \Exception("pas d'enregistrements dans la table school");
        else {
            $arrayCollection = new \app\entitiesTools\ArrayCollection();
            foreach ($result as $value) {
                $school = new \app\entities\School();
                $value['id'] = (int)$value['id'];
                $school->hydrate($value);
                $arrayCollection->addObject($school);
            }
            unset($result);
            return $arrayCollection;
        }
    }

    public function nbRecords():int
    {
        $sql="SELECT COUNT(id) as nb FROM school;";
        $st=$this->pdo->query($sql);
        $result=$st->fetch();
        return (int)$result['nb'];
        //var_dump($result);
    }

    public function findWithLimit(int $position, int $group):\app\entitiesTools\ArrayCollection
    {
        $sql="SELECT * FROM school LIMIT ".$position.",".$group.";";
        $st=$this->pdo->query($sql);
        $result = $st->fetchAll() ;

        //var_dump($result); // on recupère un tableau 2 dimension , tableau de tableau
        if( empty($result) )
            throw new \Exception("pas d'enregistrements dans la table school");
        else {
            $arrayCollection = new \app\entitiesTools\ArrayCollection();
            foreach ($result as $value) {
                $school = new \app\entities\School();
                $value['id'] = (int)$value['id'];
                $school->hydrate($value);
                $arrayCollection->addObject($school);
            }
            unset($result);
            return $arrayCollection;
        }
    }



    public function mergeCourses(\app\entities\School $object)
    {
        //récupérer toutes les formations Course en rapport avec l'objet School
        if ($object==null)
            throw new \Exception("objet school null");
/*        elseif(!($object instanceof \entities\School))
            throw new \Exception("l'objet n'est pas de type School");*/
        // pas nécessaire typage dans la méthode
        elseif ($object->getId()==0 )
            throw new \Exception("objet school pas enregistré");
        else {
            $sql = "SELECT course.id,
                    course.name,
                    course.codeCourse,
                    course.codeUt,
                    course.startDate,
                    course.endDate,
                    course.lessonNumber,
                    course.nbPeriods,
                    course.pathDocument,
                    course.timeslot
                     FROM school,course 
                     WHERE school.id = course.School_id AND  school.id = " . $object->getId() . ";";
            $st=$this->pdo->query($sql);
            $result = $st->fetchAll() ;
            var_dump($result);
                if( empty($result) )
                    throw new \Exception("pas de jointure entre school et course");
                else {
                    foreach ($result as $value) {
                        $course = new \app\entities\Course();
                        /*
                         * conversion id -> int
                         * conversion startDate -> DateTime
                         * conversion endDate -> DateTime
                         * conversion lessonNumber -> int
                         * conversion nbPeriods -> int
                         */
                        $value['id'] = (int)$value['id'];
                        $value['lessonNumber'] = (int)$value['lessonNumber'];
                        $value['nbPeriods'] = (int)$value['nbPeriods'];
                        $value['startDate'] = \app\entitiesTools\Conversion::convertDate_DateTime($value['startDate']);
                        $value['endDate'] = \app\entitiesTools\Conversion::convertDate_DateTime($value['endDate']);
                        $course->hydrate($value);
                        $object->getCourses()->addObject($course);
                    }
                    unset($result);
                }
            }

    }

}