<!-- Encryption File-->

<?php 
include_once('config.php');
$key = '9a5f#DKpL$z3^Wb2cRt@y6fX*mNvGq1sxYgP8ZlE';

function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}

function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function names(){
	global $con;
	global $key;
	$result = $con->query("SELECT * FROM people") ;
while ($row = $result->fetch_assoc()) {
	$id= $row['id'];
	$thename= decryptthis($row['name'], $key);
	$email= decryptthis($row['email'], $key);
	echo '<option value="'.$id.'" data-tokens="'.$thename.'" data-subtext="'.$email.'"">'.$thename.'</option>';
}

}
?>