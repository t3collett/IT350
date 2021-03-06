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
	 	if(!isset($_POST['categoryName'])
	 		){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}

	 	$cleanusername = filter_var($_POST['categoryName'],
	 								FILTER_SANITIZE_STRING);
	 	$categoryName = htmlentities($cleanusername);
	 	if(strlen($categoryName) > 40){
			mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();	 	
	 	}

	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = $db_handle->prepare('INSERT INTO Category (`name`) VALUE (?);' );
	 	$query->bind_param('s',$categoryName);
	 	$query->execute();
	 	//$result = mysqli_query($db_handle,$query);
	 	mysqli_close($db_handle);
	 	echo "success";
	 }
}

?>