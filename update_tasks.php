<?php
$file_name = "welcome.php";
$page_title = "Welcome";
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
//----------------------------------
	if(empty($_POST['submit'])){
		$task_id = $_GET['task_id'];
		$user_email=$_SESSION['username'];

		$q 		= "SELECT * FROM `tasks` 				 
				WHERE `task_id`= $task_id";

		//$q 		= "SELECT * FROM `tasks` 
		//		LEFT JOIN `users` ON `tasks`.`user_id`=`users`.`user_id`	 
		//		WHERE `task_id`= $task_id";

		//$q 		= "SELECT * FROM `tasks` 
		//		LEFT JOIN `users` ON `tasks`.`user_id`=`users`.`user_id`	 
		//		WHERE `task_id`= $task_id  AND `users`.`user_email`=$user_email";

		//$q 		= "SELECT * FROM `tasks` 
		//		LEFT JOIN `users` ON `tasks`.`user_id`=`users`.`user_id`	 
		//		WHERE `tasks`.`task_id`= $task_id  AND `tasks`.`user_email`=$user_email";
		//$q 		= "SELECT * FROM `tasks` 
		//		LEFT JOIN `users` ON `tasks`.`user_id`=`users`.`user_id`	 
		//		WHERE `tasks`.`task_id`= $task_id";
		$res = mysqli_query($conn, $q);
		$row = mysqli_fetch_assoc($res);

	//form is exactly the same as in create.php
	//MIND THE VALUES!!! AND HIDDEN INPUT TYPE
	echo "<div class='container' >";
		echo "<form action='update_tasks.php' method='post'>";
		//RETRIEVING INFO FROM users TABLE IN DB
		echo "<div class='form-group'>";
		echo "<p>Users</p>";
		echo "<select name='user_id'>";
		//!! FOR TEST PURPOSES		
		//SECOND QUERY
		$q_users 		= "SELECT * FROM `users` WHERE `user_email`='$user_email'";
		//$q_users 		= "SELECT * FROM `users` WHERE `date_deleted` IS NULL AND `user_email`=$user_email";
		$res_users 	= mysqli_query($conn, $q_users);

		if (mysqli_num_rows($res_users) > 0) {
			while($row_users = mysqli_fetch_assoc($res_users)){ 			
				echo '<option value="'.$row_users['user_id'].'"';
				if($row_users['user_id']===$row['user_id']){echo 'selected='.$row_users['user_id']."'";}
				echo '>'.$row_users['user_email'].'</option>';
			}
		}
		echo "</select>"; 

		echo "<p></p>";
		echo "</div>";

		echo '<div class="form-group">';
		echo "<p>Edit the tasks info</p>";
		
		//! we need it to transfer the task_id of the updated row
		echo "<input type='hidden' name='task_id' value=".$row['task_id'].">";
		echo "</div>";

		echo '<div class="form-group">';		
		echo "<p>Edit tasks name</p>";
		echo "<input type='text' name='task_name' value=".$row['task_name'].">";
		echo "</div>";

		echo '<div class="form-group">';	

		echo "<p>Change task_description</p>";	
		//!!!!!!!!!!!!!!!!!!!!!! task_description
		echo "<textarea name='task_description' value=".$row['task_description'].">".$row['task_description']."</textarea>";
		echo "</div>";

		echo '<div class="form-group">';
		echo "<p>Change task_term</p>";	
		//!!!!!!!!!!!!!!!!!!!!!! task_term
		//echo "<textarea name='task_term' value=".$row['task_term'].">".$row['task_term']."</textarea>";
		//echo "<textarea name='task_term' value=".$row['task_term'].">".$row['task_term']."</textarea>";
		echo "<input type='date' name='task_term' value=".$row['task_term'].">";
		echo "</div>";

		
		echo "<p><input type='submit' name='submit' value='EDIT'></p>";
		echo "</form>";
		echo "</div>";
	}else {
		//!!!!!!!!!!!
		$task_id			= $_POST['task_id'];
		$task_name 		= $_POST['task_name'];
		$task_description 	= $_POST['task_description'];
		$task_term 	= $_POST['task_term'];
		$user_id 			= $_POST['user_id'];
		
		
		//$rooms_quantity 	= $_POST['rooms_quantity'];
		
		$update_query = "UPDATE `tasks` 
						SET `task_name` = '$task_name',
						`user_id` = $user_id,					
						`task_description` = '$task_description',
						`task_term` = '$task_term'					
						WHERE `task_id` = $task_id";
						
		$update_result= mysqli_query($conn, $update_query);

		if ($update_result) {
	 				//success code can be read db query - 
	 				//you can print the entire info + your newly update db query 
			
	 				//it depends on you and UI you have designed ...
	 				//the same is with unseccess code

	 				//IT IS A GOOD PRACTICE YOU AND USER TO KNOW EXACTLY WHAT THE RESULT IS - SUCCESS OR NOT
			echo "Успешно променихте запис в базата данни!";
			echo "<p><a href='read_tasks.php'>Read DB</a></p>";
		}else{
			echo "Неуспешна промяна на запис в базата данни! Моля опитайте по-късно!";
			echo "<p><a href='#'>link to somewhere ... </a></p>";
		}
}
	
//-----------------------------------
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



