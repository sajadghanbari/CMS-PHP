<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once "class/DB.php";

//Load Composer's autoloader
    require 'vendor/autoload.php';

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
    $mail->setFrom('as.ghnabri@yahoo.com', 'Mailer');
    $mail->addAddress('sajji672@gmail.com');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "test";
    $mail->Body    = "this is a test for php";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Email sent';
    } 
        catch (Exception $e) 
            {
           echo "Error";
            }

?>