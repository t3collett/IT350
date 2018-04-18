<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

if($db_handle){
	 	
 	$query = $db_handle->prepare('SHOW STATUS' );
 	$query->execute();
 	$query->bind_result($un,$fn);
 	while( $query->fetch()){
		echo "$un: $fn<br>";
	}
	mysqli_close($db_handle);
}


?>