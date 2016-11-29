<?php
namespace app\controllers\test;

class TestPhpMailer extends \app\controllers\AbstractController{


    public function envoyer(\Slim\Http\Request $request, \Slim\Http\Response $response){

        //var_dump($this->container);

        // récupérer le container dans une classe controller
        $mail = $this->container->get('phpmailer'); //ok

        $mail->SetFrom("patrice.harmegnies@gmail.com", "Patrice Harmegnies");
        $mail->Subject = "test phpmailer avec slim";
        $mail->Body = "<html><body>test</body></html>";
        $mail->AddAddress("patrice.harmegnies@skynet.be");
        if (!$mail->Send()) {
            $message = 'Mail error: ' . $mail->ErrorInfo;
        } else {
            $message = 'Mail envoyé';
        }

        $this->render($response,'test/viewTestPhpMailer.twig',["message"=>$message]);

    }


}
?>