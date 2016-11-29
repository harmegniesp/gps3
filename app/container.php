<?php
declare(strict_types=1);
$container = $app->getContainer();


$container['debug']  = function(){
    return true;
};

// pour twig avec slim3
//ok
$container['view'] = function ($container) {

    $dir = dirname(__DIR__); // récupère le path absolu pour la root du site


/*    // tester Logger
    $pathFile = \app\dao\Parameters::PATHFILEDEBUG;
    \app\entitiesTools\Logger::writeLog($pathFile,"DEBUG",$dir);*/

    // localise le dossier avec les templates du site Web
    // gestion d'un cache pour twig
    $view = new \Slim\Views\Twig($dir . '/app/views', [
        'cache' => $container->debug ? false : $dir . "/temp/cache",
        'debug' => $container->debug
    ]);
    
    if ( $container->debug ){
        $view->addExtension(new Twig_Extension_Debug());
    }
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};



// pour PDO
//ok
$container['pdo'] = function ($container) {

    $dsn = \app\dao\Parameters::DSN;
    $user = \app\dao\Parameters::USER;
    $password = \app\dao\Parameters::PASSWORD;

    \app\dao\MyPdo::setParameters($dsn,$user,$password);
    $myPdo = \app\dao\MyPdo::getInstanceSingleton();
    $pdo = $myPdo->getPdo();
    
    return $pdo;
};


// pour PHPMailer
// ok
$container['phpmailer'] = function ($container) {

    $mail = new \phpmailer\PHPMailer();
    $mail->IsSMTP();
    $mail->isHTML(true);
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = false; // pas d'authentification pour l'envoi smtp
    $mail->Host = 'smtp.skynet.be';
    $mail->Port = 25;
    return $mail;

};

// voir avec SwiftMailer
$container['mailer'] = function($container) {

    $transport  = Swift_SmtpTransport::newInstance('relay.proximus.be',25);
    // si spécifier le serveur smtp
    //$transport = Swift_MailTransport::newInstance();
    // voir déclaration php.ini Mail
    $mailer = Swift_Mailer::newInstance($transport);
    return $mailer;
};

$container['mailergmail'] = function($container) {
    
    // ne pas oublier d'activer pour les applications moins sécurisées ... (voir paramètres du compte)

/*    $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
        ->setUsername($this->username)
        ->setPassword($this->password);*/
    /*
     * port 465 pour ssl
     * port 587 pour tls encryption
     */

    // openssl activé au niveau php.ini cf extension ...
    //$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
    $transport = Swift_SmtpTransport::newInstance()
        ->setHost('smtp.gmail.com')
        ->setPort(465)
        ->setEncryption('ssl')
        ->setUsername('httpdev@gmail.com')
        ->setPassword('httpdev5233')
    ;
    // si spécifier le serveur smtp
    //$transport = Swift_MailTransport::newInstance();
    // voir déclaration php.ini Mail
    $mailer = Swift_Mailer::newInstance($transport);
    return $mailer;
};

?>