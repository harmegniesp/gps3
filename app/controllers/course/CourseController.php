<?php
namespace app\controllers\course;

class CourseController extends \app\controllers\AbstractController{


    public function homeCourse(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'course/viewHomeCourse.twig',[]);

    }


}
?>