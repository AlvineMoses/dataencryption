<?php
include_once('header.php');
echo '<div class="well">';
$result = $con->query("SELECT * FROM people") ;
$ct=1;
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
include_once('footer.php');
?>