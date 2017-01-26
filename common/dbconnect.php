<?php
$con = mysqli_connect(DB_SERVER_URL, DB_USERNAME, DB_PASSWORD);
if(!$con){
	die("Database connection error.");
}
if(!mysqli_select_db($con, DB_NAME)){
  die("Database could not be selected.");
}
?>
