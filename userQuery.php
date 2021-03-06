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
	 	if(!isset($_POST['username'])){
	 		mysqli_close($db_handle);
			header("location: register.php");
	 		exit();
	 	}
	 	$username = filter_var($_POST['username'],
	 								FILTER_SANITIZE_STRING);
	 	$username = htmlentities($username);
	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = $db_handle->prepare('select username,firstname,lastname,phonenumber,address, email,privilege from User where username = ?;');
	 	$query->bind_param('s',$username);
	 	$query->execute();
	 	$query->store_result();
	 	$query->bind_result($un,$fn,$ln,$pn,$add,$em,$prv);
	 	while( $query->fetch()){
	 		echo "$un,\t$fn,\t$ln,\t$pn,\t$add,\t$em,\t$prv";
	 	}
	 	$query->close();
	 	mysqli_close($db_handle);
	 }
}
?>