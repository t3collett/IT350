<?php
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();
if($_SESSION != NULL){
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);


	if($db_handle){
		mysqli_query($db_handle,"UPDATE `Users` SET `logged_in` = '0' WHERE `Users`.`userId` = ".$_SESSION['logged_in'].";");
	}
	session_destroy();
	session_write_close();
}
// if ('PHPSESSID' != NULL) {
// 	//mysqli_query($db_handle,"UPDATE `Users` SET `logged_in` = '0' WHERE `Users`.`userId` = ".$_SESSION["id"].";");
// 	setcookie('PHPSESSID', '', time() - 42000);
// 	// remove all session variables
// 	session_unset(); 
// 	// destroy the session 

// 	session_destroy();
// }
header("Location: login.php");
//echo "<script type='text/javascript'>alert('Logged out');</script>";

?>
