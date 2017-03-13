<?php
$file_name = "index.php";
$page_title = "Start";

include_once ("includes/db_connect.php");
//include_once ("includes/delete-duration.php");
include_once ("includes/header.php");
?>

<div class="row center-block">
  <div class="col-sm-offset-4 col-sm-1">
  <a href="signin.php" class="btn btn-info btn-lg" role="button">Sign in</a>
  </div>
  <div class="col-sm-2 text-center"><h4>or</h4></div>
  <div class="col-sm-1">
  <a href="signup.php" class="btn btn-success btn-lg" role="button">Sign up</a>
  </div>
  
</div>

<?php
//include_once ("includes/create-duration.php");
//include_once ("includes/update-duration.php");
//include_once ("includes/read-duration.php");


include_once ('includes/footer.php');
