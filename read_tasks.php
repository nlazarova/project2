<?php
$file_name = "read_tasks.php";
$page_title = "Tasks";
session_start();
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		
	
	include_once ("includes/db_connect.php");
//include_once ("includes/delete-duration.php");

include_once ("includes/header.php");

//-------function Date ----------------
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

	date_default_timezone_set("Europe/Sofia");	
	$b=date(" Y-m-d ");

//-----
	function flags_func($a){
	 	if ($a!=0) {
			if ($a<7) {
				$flag_name1="NEXT";
				
			} else {
				$flag_name1="COMING";
				
			}		

		} else {
			$flag_name1="TODAY";
		}
		
		echo "<td>" . "$flag_name1" . "</td>";
 	}

//-------end function Date ------------
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
//---------------- Welcome read tasks ---------

//if(empty($_POST['submit'])){
//$user_email=$_GET['user_email'];
$user_email=$_SESSION['username'];
$read_query = "SELECT * FROM `tasks` JOIN `users` ON `users`.`user_id`=`tasks`.`user_id` WHERE `tasks`.`date_deleted` IS NULL AND `users`.`user_email` = '$user_email'";
$result = mysqli_query($conn, $read_query);

if (mysqli_num_rows($result) >0) {
	echo "<div class='table-responsive'>";
	echo "<table class='table table-hover'>";
	echo "<tr><td>TASK</td><td>Description</td><td>Term</td><td>Flag</td><td>UPDATE</td><td>DELETE</td></tr>";
	while($row = mysqli_fetch_assoc($result)){
			
			echo "<tr class='active'>";	
				//echo "<td>" . $row['task_id'] . "</td>";
				echo "<td>" . $row['task_name'] . "</td>";
				echo "<td>" . $row['task_description'] . "</td>";
				echo "<td>" . $row['task_term'] . "</td>";
				//echo "<td>" . $row['user_id'] . "</td>";
				//echo "<td>" . $row['user_email'] . "</td>";
				//echo "<td>" . $row['flag_id'] . "</td>";
				//echo "<td>" . $row['flag_name'] . "</td>";

				//---------------------------flag ----------//
					$c=$row['task_term'];
					$a=dateDifference("$b" , "$c"); 					
 					$d=flags_func($a); 				

				//--------------------------end flag ----------//
				echo '<td><a class="btn btn-default" href="update_tasks.php?task_id= '.$row['task_id'] . '" role="button">update</a></td>';
				
				
				echo "<td><a class='btn btn-default' href='delete_tasks.php?task_id= ".$row['task_id'] ." ' role='button'>delete</a></td>";
				
						echo "</tr>";
				
			
	}
	echo "</table>";
	echo "</div>";
	

	echo "<a class='btn btn-default' href='create_tasks.php?user_id= ".$row['user_id'] ." ' role='button'>Enter new task</a>";
	
	//echo "<a href='create_tasks-.php'>Enter new task</a>";
} else {
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! during development !!!!!!!!!!!!!!!
	//echo "Error: " . $read_query . " - " . mysqli_error($conn);

	echo "Nothing found!";
	//echo "<a href='create_tasks.php'>Enter new task</a>";
	echo "<a class='btn btn-default' href='create_tasks.php?user_id= ".$row['user_id'] ." ' role='button'>Enter new task</a>";
}



  	






//}
?>



<?php

//----------------  End Welcome read tasks ---------



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



