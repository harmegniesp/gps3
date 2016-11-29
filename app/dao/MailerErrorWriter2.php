<?php
declare(strict_types=1);
namespace app\dao;

class MailerErrorWriter2 implements Observer {
use \app\entities\Hydrate; // utilisation d'un trait

    public function __construct(){
    }



    public function update($value)
    {
        // TODO: Implement update() method.
        $mail = new \phpmailer\PHPMailer();  // Cree un nouvel objet PHPMailer
        $mail->IsSMTP(); // active SMTP
        $mail->isHTML(true); // message en mode HTML
        $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
        $mail->SMTPAuth = false;  // Authentification SMTP non active
        $mail->Host = 'relay.skynet.be';
        $mail->Port = 25;

        $mail->SetFrom("patrice.harmegnies@skynet.be", "Patrice Harmegnies");
        $mail->Subject = "problème site Web";
        $mail->Body = "<html><body>" . $value . "</body></html>";
        $mail->AddAddress("patrice.harmegnies@gmail.com");
        $mail->AddAddress("patrice.harmegnies@skynet.be");
        // supprimer les echo en production
        if (!$mail->Send()) {
            echo 'Mail error: ' . $mail->ErrorInfo . '<br/>';
        } else {
            echo 'Mail envoyé <br/>';
        }
    }
}