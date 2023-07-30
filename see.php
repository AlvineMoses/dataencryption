<?php
include_once('header.php');
include_once('config.php');
$q=$_GET['q'];
 $result = $con->query("SELECT * FROM people WHERE id=$q") ;
 echo '<h1>Details</h1>';
 echo '<table class="table table-striped table-dark">';
 echo '<thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>';
while ($row = $result->fetch_assoc()) {
  $name= decryptthis($row['name'], $key);
  $email= decryptthis($row['email'], $key);
  $reg_date=$row['reg_date'];
  echo '<tr>';
  echo '<td>'.$name.'</td>';
  echo '<td>'.$email.'</td>';
  echo '<td>'.$reg_date.'</td>';
  echo '</tr>';

}
echo '</tbody></table>';
echo '</div>';
include_once('footer.php');
    ?>