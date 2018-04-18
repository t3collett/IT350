<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	if(!isset($_POST['username']) || !isset($_POST['feedback'])){
	 		mysqli_close($db_handle);
			header("location: catalog.php");
	 		exit();
	 	}
	echo passthru('curl -X POST "http://localhost:9200/feedback/doc/" -H "Content-Type: application/json" -d\'{"user" : "'.$_POST['username'].'","post_date" : "'.date('Y-m-d').'","feedback" : "'.$_POST['feedback'].'"}\'');
}
?>