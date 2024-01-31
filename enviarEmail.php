<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendEmail(){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'balczarekcaio@gmail.com';                     //SMTP username
        $mail->Password   = 'itrp gvku zuct cwug';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('balczarekcaio@gmail.com', 'Caio');
        $mail->addAddress('balczarekcaio@gmail.com', 'Balczarek');     //Add a recipient

        //Attachments
        #$mail->addAttachment('/home/imply/Documentos/GitHub/Desafios2Email/sales.csv');         //Add attachments
        $mail->addAttachment('C:\Users\balcz\Documents\GitHub\Desafios2Email\sales.csv');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Estamos vendendo bem!';
        $mail->Body    = 'Olha só esses <b>resultados!</b>';
        $mail->AltBody = 'Olha só esses resultados!';

        $mail->send();
        echo 'Feito, meu nobre!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}