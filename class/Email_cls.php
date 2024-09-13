<?php
include_once("DB.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception ;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';


class Email extends DB
{


    function sendEmail($subject,$text,$receiver)
    {



    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

        try 
        {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = MailConfig::Host;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = MailConfig::Username;                     //SMTP username
        $mail->Password   = MailConfig::Password;                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = MailConfig::Port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sajji672@gamil.com', 'Mailer');
        $mail->addAddress($receiver);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $text;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $mail->send();
        } 
            catch (Exception $e) 
                {
               return false;
                }
    } 
} 
?>