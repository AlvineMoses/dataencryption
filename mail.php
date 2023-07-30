<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);


try {
    //Server settings
                      
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = 'smgvoucher1@gmail.com';                
    $mail->Password   = 'bkxbziwifdpdgpzc';                     
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('smgvoucher1@gmail.com', 'SMGV');
   // $mail->addAddress($_POST["email"]);    
   $mail->addAddress('ryanmudibo@gmail.com');    
                                                          

    
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Mail Test';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}










?>