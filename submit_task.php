<?php
$file_name = "signup.php";
$page_title = "Signup";

include_once ("includes/db_connect.php");
//include_once ("includes/delete-duration.php");
include_once ("includes/header.php");
?>

<div class="container">
  <h2>Please enter event</h2>
  <form>
    <div class="form-group">
      <label for="task_name">Еvent:</label>
      <input type="text" class="form-control" id="task_name" placeholder="Enter the task">
    </div>
    <div class="form-group" >
      <label for="task_description">Description:</label>
      <input type="text" class="form-control" id="task_description" placeholder="Enter description for task">
    </div>
    <div class="form-group">
      <label for="task_term">Date:</label>
      <input type="date" class="form-control" id="task_term" placeholder="Enter date">
    </div>
	
	
    <button type="submit" class="btn btn-default"> Submit </button>
  </form>
</div>


<?php
//include_once ("includes/create-duration.php");
//include_once ("includes/update-duration.php");
//include_once ("includes/read-duration.php");


include_once ('includes/footer.php');
