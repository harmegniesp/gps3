<?php
namespace app\controllers;

class HomeController extends \app\controllers\AbstractController{


    public function home(\Slim\Http\Request $request, \Slim\Http\Response $response){

         $this->render($response,'home/viewHome.twig',[]);

    }


}
?>