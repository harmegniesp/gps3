<?php
namespace app\controllers\student;

class StudentController extends \app\controllers\AbstractController{


    public function homeStudent(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'student/viewHomeStudent.twig',[]);

    }


}
?>