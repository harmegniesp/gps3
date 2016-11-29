<?php
namespace app\controllers\admin;

class AdminController extends \app\controllers\AbstractController{


    public function homeAdmin(\Slim\Http\Request $request, \Slim\Http\Response $response){

        $this->render($response,'admin/viewHomeAdmin.twig',[]);

    }


}
?>