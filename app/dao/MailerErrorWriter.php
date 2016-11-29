<?php
declare(strict_types=1);
namespace app\dao;

class MailerErrorWriter implements Observer {
use \app\entities\Hydrate; // utilisation d'un trait

    // voir paramétrage du compte google ...

    private $userGoogle = null;
    private $passGoogle = null;
    public function __construct(){
    }

    public function getUserGoogle()
    {
        return $this->userGoogle;
    }
    public function setUserGoogle($userGoogle)
    {
        $this->userGoogle = $userGoogle;
    }
    public function getPassGoogle()
    {
        return $this->passGoogle;
    }
    public function setPassGoogle($passGoogle)
    {
        $this->passGoogle = $passGoogle;
    }



    public function update($value)
    {
        // TODO: Implement update() method.
        $mail = new \phpmailer\PHPMailer();  // Cree un nouvel objet PHPMailer
        $mail->IsSMTP(); // active SMTP
        $mail->isHTML(true); // message en mode HTML
        $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
        $mail->SMTPAuth = true;  // Authentification SMTP active
        $mail->SMTPSecure = 'tls'; // Gmail REQUIERT Le transfert securise
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = $this->getUserGoogle();
        $mail->Password = $this->getPassGoogle();

        $mail->SetFrom("patrice.harmegnies@gmail.com", "Patrice Harmegnies");
        $mail->Subject = "problème site Web";
        $mail->Body = "<html><body>" . $value . "</body></html>";
        $mail->AddAddress("patrice.harmegnies@skynet.be");
        // supprimer les echo en production
        if (!$mail->Send()) {
            echo 'Mail error: ' . $mail->ErrorInfo;
        } else {
            echo 'Mail envoyé';
        }
    }
}