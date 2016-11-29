<?php
namespace app\controllers\school;

class SchoolController extends \app\controllers\AbstractController{


    public function homeSchool(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'school/viewHomeSchool.twig',[]);

    }

    public function insertSchool(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'school/viewInsertSchool.twig',[]);

    }

    public function updateSchool(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'school/viewUpdateSchool.twig',[]);

    }

    public function deleteSchool(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'school/viewDeleteSchool.twig',[]);

    }

    public function listSchool(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'school/viewListSchool.twig',[]);

    }

    public function listCoursesSchool(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'school/viewListCoursesSchool.twig',[]);

    }


}
?>