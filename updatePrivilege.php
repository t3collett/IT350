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
			header("location: admin.php");
	 		exit();
	 	}
	 	if($_POST['privilege']== ''){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}
	 	$username = $_POST['username'];
	 	$privilege = $_POST['privilege'];
	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = "update ".$userTable." set privilege = ".$privilege." where User.username = '".$username. "';" ;
	 	$result = mysqli_query($db_handle,$query);
	 	mysqli_close($db_handle);
	 	echo "success";
	 }
}

?>