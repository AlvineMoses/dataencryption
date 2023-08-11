<?php
require_once('header.php');
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Twilio\Rest\Client;

if (isset($_POST['submit'])) {
    // Get POST variables
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];

    // Generate the encryption key
    $key = random_bytes(32);
    $encryptionKey = base64_encode($key);

    // Encrypt the message and the key
    $message = $_POST['message'];
    $encryptedMessage = encryptthis($message, $key);
    $encryptedKey = encryptthis($encryptionKey, $recipientPublicKey);

    // Send the email with the encrypted message
    sendEncryptedEmail($email, $encryptedMessage);

    // Send the SMS with the encryption key
    sendEncryptionKeySMS($recipientNumber, $encryptedKey);

    // Display success message
    echo '<div class="well">';
    echo '<h2>Original Data</h2>';
    echo '<p>Name: ' . $firstName . '</p>';
    echo '<p>Email: ' . $email . '</p>';
    echo '</div>';

    // Insert the encrypted data into the database
    mysqli_query($con, "INSERT INTO people(`name`, `email`, `message`, `encryption_key`) VALUES ('$nameencrypted','$emailencrypted', '$encryptedMessage', '$encryptedKey')");

    echo '<p class="lead">The name, email address, and encrypted message have been stored into the database</p>';
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
    <div class="form-group">
        <label for="message">Enter Message Here</label>
        <textarea class="form-control" name="message" rows="5"></textarea>
    </div>
    <input type="submit" name="submit" class="btn btn-success btn-lg" value="submit">
</form></div>';
echo '</div>
</div>
<div class="col-sm-3"></div>
</div>';
include_once('footer.php');

// Function to send encrypted email
function sendEncryptedEmail($recipientEmail, $encryptedMessage)
{
    // Create a PHPMailer object
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Replace with your email address
        $mail->Password = 'your_email_password'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'Your Name'); // Replace with your email address and name
        $mail->addAddress($recipientEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Encrypted Message';
        $mail->Body = '<p>Here is your encrypted message:</p><p>' . $encryptedMessage . '</p>';
        $mail->send();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

// Function to send encryption key via SMS
function sendEncryptionKeySMS($recipientNumber, $encryptedKey)
{
    $accountSid = 'YOUR_TWILIO_ACCOUNT_SID'; // Replace with your Twilio account SID
    $authToken = 'YOUR_TWILIO_AUTH_TOKEN'; // Replace with your Twilio auth token
    $twilioNumber = 'YOUR_TWILIO_PHONE_NUMBER'; // Replace with your Twilio phone number

    $client = new Client($accountSid, $authToken);

    try {
        $message = $client->messages->create(
            $recipientNumber,
            [
                'from' => $twilioNumber,
                'body' => 'Here is your encryption key: ' . $encryptedKey,
            ]
        );
        echo 'Encryption key sent via SMS! SID: ' . $message->sid;
    } catch (Exception $e) {
        echo 'Error sending SMS: ' . $e->getMessage();
    }
}
?>
