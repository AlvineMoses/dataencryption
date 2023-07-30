<?php
include_once('header.php');
?>
<div class="well">
<h2>Search By Name or Email</h2>
<form method="post" action="results.php">
<div class="form-group">
<select name="theid" class="selectpicker show-tick" data-live-search="true" data-size="5" data-header="Search" data-width="auto" >
  <option>Search</option>
<?php names(); ?>
 </select>
 </div>
<button type="submit" id="submit" name="submit" class="btn btn-success">Submit</button>
</form>
</div>
</div>
</div>
<?php include_once('footer.php'); ?>