<?php
include_once('header.php');
echo '<div class="well">';
$result = $con->query("SELECT * FROM people") ;
$ct=1;


echo '<div class="well"><form method="post">
	<div class="form-group">
		<label for="firstName">Enter Decryption Key Here</label>
			<input type="text" class="form-control" name="sKey">
	</div>
	
	<input type="submit" name="submit" class="btn btn-success btn-lg" value="submit">
</form></div>';
echo '</div>
	  </div>
	  <div class="col-sm-3"></div>
	  </div>';


$sKey = $_POST["sKey"];
while($sKey = $_POST["sKey"]){

if($sKey = $key){
	while ($row = $result->fetch_assoc()) {
		echo $ct;
		echo '<p>'.decryptthis($row['name'], $key).'</p>';
		echo '<p>'.decryptthis($row['email'], $key).'</p>';
		$ct++;
	}
	echo '</div>
		  </div>
		  <div class="col-sm-3"></div>
		  </div></div>';

}else{

echo 'Wrong decryption Key input';

}

}







include_once('footer.php');
?>

