<?php
$file_name = "welcome_newtask.php";
$page_title = "Welcome new task";
session_start();
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		
	
	include_once ("includes/db_connect.php");
//include_once ("includes/delete-duration.php");

include_once ("includes/header.php");
?>

<div class="container-fluid">
<div class="row pull-right">

<?php

echo "<div class='alert alert-success alert-dismissible' role='alert'>";
echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;
			</span></button>Logged in as,  " . $_SESSION['username'] . "</div>";
echo "<a href='logout.php' class='btn btn-danger btn-sm' role='button'> Log Out</a>";
 
	
	
?>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>
</div>
</div>

<?php
//echo "Welcome";
//----------------------- Welcome new task-----------
$user_email=$_SESSION['username'];
$read_query1 = "SELECT * FROM `flags` WHERE `date_deleted` IS NULL";
$read_query = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
//$read_query = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
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
    <div class="form-group">
      <label for="user_id">user:</label>
      <select name="user_id">
      <option value="">---</option>
        <?php
        $result = mysqli_query($conn, $read_query);
        if (mysqli_num_rows($result) >0) {
          
          while($row = mysqli_fetch_assoc($result)){
                
              echo "<option value='".$row['user_id']."'>". $row['user_email'] ."</option>";       
                      
          }
          
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="flag_id">Flag:</label>
      <select name="flag_id">
      <option value="">---</option>
        <?php
        $result1 = mysqli_query($conn, $read_query1);
        if (mysqli_num_rows($result1) >0) {
          
          while($row = mysqli_fetch_assoc($result1)){
                
              echo "<option value='".$row['flag_id']."'>". $row['flag_name'] ."</option>";                        
          }          
        }
        ?>
      </select>
    </div>	
	
    <button type="submit" class="btn btn-default"> Submit </button>
  </form>
</div>


<?php

if(isset($_POST['submit'])){

  $task_name=$_POST['task_name'];
  $task_description=$_POST['task_description'];
  $task_term=$_POST['task_term']; 
  $user_id=$_POST['user_id'];
  $flag_id=$_POST['flag_id'];
  

  //$insetr_query="INSERT INTO `tasks`(`task_name`) VALUES ('$task_name')";
  $insetr_query="INSERT INTO `tasks`(`task_name`, `task_description`, `task_term`, `user_id`, `flag_id`) VALUES ('$task_name', '$task_description', '$task_term', '$user_id', '$flag_id')";

  if (mysqli_query($conn, $insetr_query)) {
    echo "Success!";
} else {
  //!!!!!!!!!!!!
  echo "Error: ". $insetr_query."-" . mysqli_error($conn);
}

}

//-------------------End Welcome new task ---------


//echo "Welcome";

include_once ('includes/footer.php');
	 } else {
		 include_once ("includes/header.php");
		

		 
    echo " <div class='alert alert-warning' role='alert'>Please " . "<a href='signin.php' class='alert-link'>Sign In</a> first to see this page. </div>";
	include_once ('includes/footer.php');
}

?>



<?php
//include_once ("includes/db_connect.php");
//include_once ("includes/delete-duration.php");

//include_once ("includes/create-duration.php");
//include_once ("includes/update-duration.php");
//include_once ("includes/read-duration.php");



