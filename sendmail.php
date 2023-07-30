<?php
require 'vendor/autoload.php'; // Load Composer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$to = "recipient@example.com"; // Replace with the recipient's email address
$subject = "Encryption test";
$message = "This is a test message";

// Gmail SMTP Configuration
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587;
$smtpUsername = 'your_gmail_username@gmail.com'; // Replace with your Gmail email address
$smtpPassword = 'your_gmail_password'; // Replace with your Gmail password

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $smtpPort;

    //Recipients
    $mail->setFrom($smtpUsername, 'Your Name');
    $mail->addAddress($to);

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = strip_tags($message); // Plain-text version of the message

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
