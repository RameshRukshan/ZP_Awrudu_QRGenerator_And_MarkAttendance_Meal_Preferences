<?php 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zp_awrudu";
$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if($conn){
	//echo "Connected";
}
else{
	echo "Connection Failed";
}
?>