<?php
declare(strict_types=1);
namespace app\controllers;


abstract class AbstractController
{

    protected $container = null;

    public function __construct($container)
    {
        $this->container = $container;
    }


    // méthode pour appeler une vue avec passage d'un tableau de paramètres ...
    // 3ième argument facultatif retourne un tableau vide
    public function render($response,$file, $params = []){
        $this->container->view->render($response,$file,$params);

    }

    // méthode pour une redirection  vers une autre route avec un nom (setName)
    public function redirect(\Slim\Http\Response $response,$name){
        return $response->withStatus(302)->withHeader('Location',$this->container->router->pathFor($name));
    }


    // méthode pour gérer les messages flash à afficher à l'internaute
    public function flash($message,$type = 'success'){

        // si la variable session n'existe pas on la crée avec un tableau vide
        if ( !(isset($_SESSION['flash'])) )
            $_SESSION['flash'] = [];

        return $_SESSION['flash'][$type] = $message;
        // placer le message dans la variable session

    }



}