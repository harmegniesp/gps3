<?php
declare(strict_types=1);
session_start(); //utilisation des variables session dans l'application
require_once ("../vendor/autoload.php");
// récupérer le fichier autoload de composer
// si modification composer.json refaire composer dump-autoload

// instancier la classe App de Slim
$app = new \Slim\App([
        "settings"=>[
            "displayErrorsDetails" => true
        ]
    ]);

// recupérer le fichier container
require_once("../app/container.php");

// utiliser un middleware
// $app->add(new \app\middleware\TimeMiddleware());
// pour tester ...


// associer la classe FlashMiddleware à notre application en lui passant un TwigEnvironment
$container = $app->getContainer();
$twigEnvironment = $container->get('view')->getEnvironment();
$app->add(new \app\middleware\FlashMiddleware($twigEnvironment));


/*
 * // tester Logger ...
 * $pathFile = app\dao\Parameters::PATHFILEDEBUG;
\app\entitiesTools\Logger::writeLog($pathFile,"DEBUG","test Logger index.php");
*/


/*// A revoir
// 465 ssl ou 587 tls
$transport = Swift_SmtpTransport::newInstance()
    ->setHost('smtp.gmail.com')
    ->setPort(587)
    ->setEncryption('tls')
    //->setAuthMode('PLAIN')
    ->setUsername('httpdev@gmail.com')
    ->setPassword('httpdev5233')
;
// https://www.google.com/settings/security/lesssecureapps
$message = \Swift_Message::newInstance()
    ->setSubject("message de contact")
    ->setFrom('patrice.harmegnies@gmail.com')
    ->setTo('hpphdev@gmail.com')
    ->setCharset('UTF-8')
    ->setContentType('text/html')
    ->setBody("message de contact site GPS3.DEV hello");
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);
//code "535", with message "535-5.7.8 Username and Password not accepted*/



// définir les routes
// test Route ...

/*// entrée
$app->get('/',function (\Slim\Http\Request $request, \Slim\Http\Response $response){
    return $response->getBody()->write("hello");
}); //ok
// test
$app->get('/test',function (\Slim\Http\Request $request, \Slim\Http\Response $response){
    return $response->getBody()->write("test");
});//ok
// test class Controller
$app->get("/persistance", \app\controllers\test\TestPersistanceEntities::class .":affiche")->setName('testdao'); //ok
$app->get("/mail", \app\controllers\test\TestPhpMailer::class .":envoyer")->setName('testmail'); //ok*/

// les routes de base
$app->get('/', \app\controllers\HomeController::class .":home")->setName('home');
// le setName est à utiliser dans path_for au niveau template ...
$app->get('/school', \app\controllers\school\SchoolController::class .":homeSchool")->setName('school_home');
$app->get('/course', \app\controllers\course\CourseController::class .":homeCourse")->setName('course_home');
$app->get('/student', \app\controllers\student\StudentController::class .":homeStudent")->setName('student_home');
$app->get('/admin', \app\controllers\admin\AdminController::class .":homeAdmin")->setName('admin_home');


// partie Contact
$app->get('/contact', \app\controllers\contact\ContactController::class .":contactMail")->setName('contact');//lien dans la barre
$app->post('/contact', \app\controllers\contact\ContactController::class .":envoiMail");//gestion des données post formulaire de contact




// partie School
$app->get('/insertschool', \app\controllers\school\SchoolController::class .":insertSchool")->setName('school_insert');
$app->get('/updateschool', \app\controllers\school\SchoolController::class .":updateSchool")->setName('school_update');
$app->get('/deleteschool', \app\controllers\school\SchoolController::class .":deleteSchool")->setName('school_delete');
$app->get('/listingschool', \app\controllers\school\SchoolController::class .":listSchool")->setName('school_list');
$app->get('/listingcourseschool', \app\controllers\school\SchoolController::class .":listCoursesSchool")->setName('school_listcourses');


$app->run();
?>