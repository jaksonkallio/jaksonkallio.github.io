<?php
//DB CONNECT
$dbserverurl = "localhost";
$dbusername = "sabreokc_phpbot";
$dbpassword = "sxa9v75jk1si";
$dbname = "sabreokc_main";

$con = mysqli_connect($dbserverurl,$dbusername,$dbpassword);
if(!$con){
	die("Database connection error.");
}
if(!mysqli_select_db($con,$dbname)){
  die("Database could not be selected.");
}
?>
