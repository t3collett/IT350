<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	 if($db_handle){
	 	if($_POST['username']== ''){
	 		mysqli_close($db_handle);
			header("location: register.php");
	 		exit();
	 	}
	 	$username = $_POST['username'];
	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = "select username,firstname,lastname,phonenumber,address, email,privilege from IT350.".$userTable." where username = '".$username. "';" ;
	 	$result = mysqli_query($db_handle,$query);
	 	foreach( $result->fetch_assoc() as $info){
	 		echo ' '.$info;
	 	}
	 	mysqli_close($db_handle);
	 }
}
?>