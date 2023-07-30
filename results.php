<?php
include_once('header.php');
if(isset($_POST['submit'])){
	$id=$_POST['theid'];
}
echo '<div class="well">';
$result = $con->query("SELECT * FROM people WHERE id='$id' LIMIT 1") ;
while ($row = $result->fetch_assoc()) {
	echo '<p>Encrypted name from database: '.$row['name'].'</p>';
	echo '<p>Decrypted Name: '.decryptthis($row['name'], $key).'</p>';
	echo '<p>Encrypted email from database: '.$row['email'].'</p>';
	echo '<p>Decrypted Email: '.decryptthis($row['email'], $key).'</p>';
	echo '<p>ID#: '.$row['id'].'</p>';
}
echo '</div>
	  </div>
	  <div class="col-sm-3"></div>
	  </div></div>';
include_once('footer.php');
?>