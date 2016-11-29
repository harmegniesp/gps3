<?php
declare(strict_types=1);
namespace app\middleware;


// middleware pour afficher à l'ouverture de la vue un message flash ...

class FlashMiddleware
{

    /*
     * TwigEnvironment pour pouvoir gérer l'environnement Twig avec les vues ...
     */

    private $twigEnvironment;

    public function __construct(\Twig_Environment $twig_Environment){
        $this->twigEnvironment = $twig_Environment;
    }
    
    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, $next)
    {

        $this->twigEnvironment->addGlobal('flash',isset($_SESSION['flash']) ? $_SESSION['flash'] : []);
        if ( isset($_SESSION['flash']) )
            unset($_SESSION['flash']);
        
        return $next($request,$response);
        
    }


}