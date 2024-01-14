<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
//Load Composer's autoloader


$mail = new PHPMailer(true);    //Create an instance; passing `true` enables exceptions

//Send Email verification code
function sendMail_verify($email, $verify_token)
{
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    // odshtolbjlzqlhom
    global $mail;
    try {

        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'neolearn.pamak@gmail.com';                     //SMTP username
        $mail->Password   = 'odshtolbjlzqlhom';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('neolearn.pamak@gmail.com', 'NeoLearn'); //Recipients
        $mail->addAddress($email);       //Add a recipient

        $mail->isHTML(true);   //Set email format to HTML                              //Set email format to HTML
        $mail->Subject = 'Email verification ';
        $mail->Body    = '<h5><p>Verify email adress to Login with the below given link </h5>
                          <br/><br/>
                          <a href="http://localhost/NEOLEARN/SignUp/email_verify.php?token=' . $verify_token . '">Verification Link</a>';
        $mail->send();
        //echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
