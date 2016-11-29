<?php
namespace app\controllers\test;

class TestPersistanceEntities extends \app\controllers\AbstractController{


    public function affiche(\Slim\Http\Request $request, \Slim\Http\Response $response){

        //var_dump($this->container);

        // récupérer le container dans une classe controller
        $pdo = $this->container->get('pdo'); //ok

     try{

            $pdo->beginTransaction();

                     //forcer en utf-8
                     $pdo->exec("SET NAMES 'UTF8';");

                     // créer une instance de la classe SchoolDao en lui passant un objet pdo pour la connexion DB
                     $schoolDao = new \app\entitiesDao\SchoolDao($pdo);


                    /* // Etape1
                     // création de 2 écoles
                        //echo "tester insert <br/>";
                         $school1 = new \app\entities\School();
                         $tabSchool1 = array("name"=>"IRAM","codeSchool"=>"54586699656","phone"=>"065123245","address"=>"rue de Binche, 7000 Mons");
                         $school1->hydrate($tabSchool1);
                         $schoolDao->insert($school1);
                         //var_dump($school1); // vérifier objet cf id et typage id 6
                         $school2 = new \app\entities\School();
                         $tabSchool2 = array("name"=>"PROMSOC SUP","codeSchool"=>"545899666","phone"=>"065723245","address"=>"avenue du Tir, 7000 Mons");
                         $school2->hydrate($tabSchool2);
                         $schoolDao->insert($school2);
                         //var_dump($school2);*/




                         // Etape3
                         // tester méthode findAll
                        //echo "tester findAll <br/>";
                         $arrayCollection = $schoolDao->findAll();
                         //var_dump($arrayCollection);


                         // Etape4
                         // tester méthode findAllQuick
                         //echo "tester findAllQuick <br/>";
                         $arrayCollection = $schoolDao->findAllQuick();
                         //var_dump($arrayCollection);

                         // Etape5
                         // tester méthode nbRecords
                         //echo "tester nbRecords <br/>";
                         $nbRecords = $schoolDao->nbRecords();
                         //echo "nombre d'enregistrements : "  . $nbRecords . "<br/>";

                        // Etape6
                        // tester méthode findAllWithLimit
                        //echo "tester findAllWithLimit <br/>";
                        // $arrayCollection = $schoolDao->findWithLimit(0,5);
                        // on récupère les 5 premiers enregistrements de la table school ...
                        $arrayCollection = $schoolDao->findWithLimit(1,1);
                        // on récupère le 2ième enregistrement de la table school ...
                        //var_dump($arrayCollection);

                        // Etape7
                        // tester méthode mergeCourses
                        // il faut enregistrer au moins une course pour une school
                        $school = $schoolDao->find(7);
                        $schoolDao->mergeCourses($school);
                        //var_dump($school);


            $pdo->commit();
            $message = "opération réussie ...";

        }
        catch (\Exception $e){

            //si erreur , rollback pour ne pas enregistrer
            $pdo->rollBack();
            $message = $e->getMessage();
        }

        // $message = "opération réussie ...";
        //$this->container->view->render($response,'test/viewTestEntities.twig',["message"=>$message]);
        $this->render($response,'test/viewTestEntities.twig',["message"=>$message]);

    }


}
?>