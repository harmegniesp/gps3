<?php
namespace app\controllers\contact;

class ContactController extends \app\controllers\AbstractController{


    public function contactMail(\Slim\Http\Request $request, \Slim\Http\Response $response){

        // si existe variable session la récupérer dans la variable $flash
/*      if ( isset($_SESSION['flash']) )
            $flash = $_SESSION['flash'];
        else
            $flash = [];

        // si reloader la page ne plus afficher le message donc tableau vide []
        $_SESSION['flash'] = [];
        $this->render($response,'contact/viewContact.twig',['flash'=>$flash]);*/

        $this->render($response,'contact/viewContact.twig');
    }

    public function envoiMail(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {

        /*        $_SESSION['flash']=[
            success => "le message a bien été envoyé"
        ];*/


        $errors = [];
        \Respect\Validation\Validator::email()->validate($request->getParam('email')) || $errors['email'] = 'syntaxe email non valide';

        // mettre required au niveau des input ...
        \Respect\Validation\Validator::notEmpty()->validate($request->getParam('nom')) || $errors['nom'] = 'nom obligatoire';
        \Respect\Validation\Validator::notEmpty()->validate($request->getParam('prenom')) || $errors['prenom'] = 'prénom obligatoire';
        \Respect\Validation\Validator::notEmpty()->validate($request->getParam('contenu')) || $errors['contenu'] = 'message obligatoire';

   /*     // tester getParam et Validator
        if ( empty($request->getParam('nom')) )
            $errors['nom'] = "champ nom vide";
        \Respect\Validation\Validator::notEmpty()->validate($request->getParam('prenom')) || $errors['prenom'] = 'prénom obligatoire';
        //$errors['test'] = 'test';*/

//        //var_dump($errors);
//        $pathFile = \app\dao\Parameters::PATHFILEDEBUG;
//        \app\entitiesTools\Logger::writeLog($pathFile,"DEBUG","validation");

        /*        if (false)
                    $this->flash("le message a bien été envoyé");
                else
                    $this->flash("certains champs n'ont pas été remplis correctement","error");*/


       if ( empty($errors) ) {
            // validation ok


            // cf méthode flash dans la classe AbstractController

            // récupérer de tous les paramètres transmis via la requête post
            //$post = $request->getParams();
            //var_dump($post);

                  // envoyer le mail avec SwiftMailer
            // faire une classe pour regrouper le code pour SwiftMailer ...

                   //$expediteur = $request->getParam('nom') . " " . $request->getParam('prenom');
                   // création du message à envoyer
                   $message = \Swift_Message::newInstance()
                       ->setSubject("message de contact")
                       ->setFrom($request->getParam('email'))
                       ->setTo('hpphdev@gmail.com')
                       ->setCharset('UTF-8')
                       ->setContentType('text/html')
                       ->setBody("message de contact site GPS3.DEV {$request->getParam('contenu')}");



                   // envoi mail avec smtp 25
                   // $this->container->get('mailer')->send($message);
                   // méthode get pour récupérer l'objet $mailer dans le container
                   // ok

                   // envoi mail avec gmail et ssl
                   //$this->container->get('mailergmail')->send($message);
                   // à revoir

                   // tester avec phpmailer ...


            $message = \Swift_Message::newInstance()
                ->setSubject("message de contact")
                ->setFrom($request->getParam('email'))
                ->setTo('hpphdev@gmail.com')
                ->setCharset('UTF-8')
                ->setContentType('text/html')
                ->setBody("message de contact site GPS3.DEV {$request->getParam('contenu')}");

            if ( $this->container->get('mailer')->send($message)  ) {
                $this->flash("le message a bien été envoyé");
                 }
            else  {
                $errors['envoiMail'] = "problème avec notre serveur d'envoi SMTP";
                $this->flash("le mail n'a pas été envoyé", 'error');
                $this->flash($errors, 'errors');
            }

        }
        else {
            $this->flash("certains champs n'ont pas été remplis correctement", 'error');
              $this->flash($errors, 'errors');
        }

        // redirection vers la page formulaire contact
        return $this->redirect($response,'contact');
        //méthode redirect voir AbstractController

    }

}
?>