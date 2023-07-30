<?php
include_once('header.php');
include_once('config.php');
if(isset($_POST['submit'])){
	$q=strtolower($_POST['q']);
  $result = $con->query("SELECT * FROM people") ;
  $array = array();
while ($row = $result->fetch_assoc()) {
  $name= decryptthis($row['name'], $key);
  $email= decryptthis($row['email'], $key);
  $array[]= $row['id'].' '.strtolower($name).' '.strtolower($email);
  }
  echo '<p class="lead">Search results below. If nothing appears there is no result</p>';
 foreach ( $array as $item ) {
	 if (strpos($item, $q) !== false){ 
		$id= strtok($item, " ");
		$display= substr(strstr($item, " "),1);
		echo '<a href="see.php?q='.$id.'" class="btn btn-sm btn-success form-control">'.$display.'</a><br/>';
		}			
    }
}
	echo '<div class="well">
<h2>Search By Name or Email</h2>
<form method="post">
<div class="form-group">
<input type="text" name="q" class="form-control" placeholder="Enter One Word Only" />
</div>
<button type="submit" id="submit" name="submit" class="btn btn-success">Submit</button>
</form>
</div>
</div>
</div>';
include_once('footer.php');
?>
