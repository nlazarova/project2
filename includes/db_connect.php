<?php
$servername = "localhost";
$username	= "wptest";
$password	= "";
$dbname		= "project_2";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die ("Connection failed:" . mysqli_connect_error());
	
} else {
	//echo "Connected successfully!";
}