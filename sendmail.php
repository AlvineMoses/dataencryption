<?php
require 'vendor/autoload.php';

$to = "ryanmudibo@gmail.com";
$subject = "Encryption test";
$message = "This is a test message";



$headers = "MIME-Version:1.0"."\r\n";
$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

$headers .= 'From: <mryansenpai@gmail.com>'."\r\n";

mail($to,$subject,$message,$headers);
?>