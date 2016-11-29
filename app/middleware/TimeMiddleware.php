<?php
declare(strict_types=1);
namespace app\middleware;


class TimeMiddleware
{
    
    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, $next)
    {
        // TODO: Implement __invoke() method.
        // code avant exécution du template
        /*$response->write("<div
        style='width:100%;height:30px;position:fixed;top:0;background-color:#000;color:#FFF;margin:0px'>
        <h1 style='margin-top:-3px'>DEVELOPPEMENT GESTION DE PRESENCES GPS3</h1>
        </div>");*/
        $time1 = microtime(true);

        $response = $next($request,$response);

        // code après exécution du template
        $time2 = microtime(true);
        $diff = $time2-$time1;

        $response->write("<div  style='position:fixed;bottom:0;width:100%;height:30px;background-color:#000;color:#FFF'>
        <h3 style='margin-top:-3px'>Durée exécution code : " . $diff . "</h3></div>");

        return $response;
        
    }


}