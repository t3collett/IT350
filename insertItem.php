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
	 	if(!isset($_POST['itemName'])||
	 		!isset($_POST['description'])||
	 		!isset($_POST['quantity'])||
	 		!isset($_POST['cost'])||
	 		!isset($_POST['category'])){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	$cleanitemname = filter_var($_POST['itemName'],
	 								FILTER_SANITIZE_STRING);
	 	$itemname = htmlentities($cleanitemname);

	 	$cleandescription = filter_var($_POST['description'],
	 								FILTER_SANITIZE_STRING);
	 	$description = htmlentities($cleandescription);
	 	$quantity = filter_var($_POST['quantity'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	$category = filter_var($_POST['category'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	$cost = filter_var($_POST['cost'],
	 								FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION );
	 	if(strlen($itemname) > 255||
	 		strlen($description) > 516||
	 		$category > PHP_INT_MAX||
	 		$cost > 10000||
	 		$quantity > PHP_INT_MAX){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}


 
	 	$query = $db_handle->prepare('INSERT INTO `Item` (`itemName`,`description`,`quantity`,`cost`,`categoryId`) VALUES (?,?,?,?,?);');
	 	$query->bind_param('ssidi',$itemname,$description,$quantity,$cost,$category);
	 	$query->execute();
	 	$query->close();
	 	mysqli_close($db_handle);
	 }
}
header("Location: admin.php");

?>