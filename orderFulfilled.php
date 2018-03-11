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
	 	if(!isset($_POST['orderNumber'])||
	 		!isset($_POST['fulfilled'])
	 		){
	 		mysqli_close($db_handle);
	 		print_r($_POST);
			//header("location: admin.php");
	 		exit();
	 	}

	 	$orderNumber = filter_var($_POST['orderNumber'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	$fulfilled = preg_replace("([^0-9/])", "", $_POST['fulfilled']);
	 	echo strlen($fulfilled)." ".$fulfilled;
	 	if($orderNumber > PHP_INT_MAX ||
	 		strlen($fulfilled) > 100){
			mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();	 	
	 	}
	 	$query = $db_handle->prepare('UPDATE CustomerOrder 
	 									SET  fulfilled = ? 
	 									WHERE orderNumber	= ?;' );
	 	$query->bind_param('si',$fulfilled,$orderNumber);
	 	$query->execute();
	 	$query->close();
	 	//$result = mysqli_query($db_handle,$query);
	 	mysqli_close($db_handle);
	 	echo "<br>success";

	 }
} 				

?>