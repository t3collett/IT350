<?php
echo "hello";
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	print_r($_POST);
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	 if($db_handle){
	 	if(!isset($_POST['itemId'])||
	 		!isset($_POST['quantity'])) {
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	$cleanitemname = filter_var($_POST['itemId'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	$quantity = filter_var($_POST['quantity'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	 
	 	$query = $db_handle->prepare("CALL increaseQuantity(?,?)");
	 	$query->bind_param('ii',$cleanitemname,$quantity);
	 	$query->execute();
	 	$query->close();
	 	mysqli_close($db_handle);
	 }
}
/*session_start();
if ($_SESSION['logged_in'] == NULL) {
    print_r($_POST);

    //header("Location: login.php");
    //exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	print_r($_POST);
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	 if($db_handle){
	 	if(!isset($_POST['itemId'])||
	 		!isset($_POST['quantity'])) {
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	$cleanitemname = filter_var($_POST['itemId'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	$quantity = filter_var($_POST['quantity'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	 
	 	$query = $db_handle->prepare("CALL increaseQuantity(?,?)");
	 	$query->bind_param('ii',$itemname,$quantity);
	 	$query->execute();
	 	$query->close();
	 	mysqli_close($db_handle);
	 }
}
//header("Location: admin.php");
*/
?>