<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    $user = $_SESSION['logged_in'];
    exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	 if($db_handle){
	 	if(!isset($_POST['item'])||
	 		!isset($_POST['quantity'])){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	$item = filter_var($_POST['item'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	$quantity = filter_var($_POST['quantity'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	if($item > PHP_INT_MAX || $item < 0 ||
	 		$quantity > PHP_INT_MAX || $quantity < 0){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	mysqli_set_charset($db_handle, "utf8");

	 	$query = $db_handle->prepare('INSERT INTO `List` (`cartId`, `itemId`, `quantity`) select cartId, ?, ? from ShoppingCart where ShoppingCart.username = ?') ;
	 	$query->bind_param('iis',$item,$quantity,$user['username']);
	 	$result = $query->execute();
	 	$query->close();
	 	mysqli_close($db_handle);
	 }
}
header("Location: admin.php");
?>