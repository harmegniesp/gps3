<?php
/*
ok attention Host
 */
require_once("PhpMailer.php");
require_once("Smtp.php");
require_once("PhpMailerException.php");
$mail = new phpmailer\PHPMailer();  // Cree un nouvel objet PHPMailer
$mail->IsSMTP(); // active SMTP
$mail->isHTML(true); // message en mode HTML
$mail->SMTPDebug = 1;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
$mail->SMTPAuth = true;  // Authentification SMTP active
$mail->SMTPSecure = 'ssl'; //'tls'; // Gmail REQUIERT Le transfert securise
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; //587;
$mail->Username = "patrice.harmegnies@gmail.com";
$mail->Password = "hpph$&5233"; // à changer
$mail->SetFrom("patrice.harmegnies@gmail.com", "Patrice Harmegnies");
$mail->Subject = "problème site Web";
$mail->Body = "<html><body>test</body></html>";
$mail->AddAddress("patrice.harmegnies@skynet.be");
if (!$mail->Send()) {
    echo 'Mail error: ' . $mail->ErrorInfo;
} else {
    echo 'Mail envoyé';
}

?>