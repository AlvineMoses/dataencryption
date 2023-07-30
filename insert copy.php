<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include_once('header.php');
if(isset($_POST['submit'])){
	
	//GET POST VARIABLES
$firstName=$_POST['firstName'];
$email=$_POST['email'];

//OTP Function
$otp= mt_rand(100000, 999999);	

	//THE ENCRYPTION PROCESS
$nameencrypted=encryptthis($firstName, $key);
$emailencrypted=encryptthis($email, $key);




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
    $mail->addAddress($_POST["email"]);     
                                                          

    
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "<p> Here is the encrypted Message</p><br>
					Encrypted Email: 	$emailencrypted <br>
					<br>
					Encrypted Message:	$nameencrypted <br>
					<br>

					Encryption Key : $key <br>

					OTP Key: $otp 


	
	
	
	";
	
	
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

	//DISPLAY RESULTS
echo '<div class="well">';
echo '<h2>Original Data</h2>';
echo '<p>Name: '.$firstName.'</p>';
echo '<p>Email: '.$email.'</p>';
echo '</div>';

	//INSERT INTO DATABASE
mysqli_query($con,"INSERT INTO people(`name`, `email`)
VALUES ('$nameencrypted','$emailencrypted')");

echo '<p class="lead">The name and email address have been encrypted and stored into the database</p>';
}

echo '<div class="well"><form method="post">
	<div class="form-group">
		<label for="firstName">Enter Name Here</label>
			<input type="text" class="form-control" name="firstName">
	</div>
	<div class="form-group">
		<label for="email">Enter Email Here</label>
			<input type="email" class="form-control" name="email">
	</div>
	<input type="submit" name="submit" class="btn btn-success btn-lg" value="submit">
</form></div>';
echo '</div>
	  </div>
	  <div class="col-sm-3"></div>
	  </div>';
include_once('footer.php');
?>