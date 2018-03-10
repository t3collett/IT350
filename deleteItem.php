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
	 	if(!isset($_POST['item'])){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	$item = filter_var($_POST['item'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	if($item > PHP_INT_MAX){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = $db_handle->prepare('delete from Item where itemId = ?;') ;
	 	$query->bind_param('i',$item);

	 	$result = $query->execute();
	 	$query->close();
	 	mysqli_close($db_handle);
	 }
}
header("Location: admin.php");
?>