<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
//echo $_POST;
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST) && isset($_POST['item']) && isset($_POST['review'])){
	$itemId = $_POST['item'];
	//print_r($_SESSION);
	$user = $_SESSION['logged_in']['username'];
	$myfile = fopen("review.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $_POST['review']);
	fclose($myfile);
	
	passthru("python storeReview.py ". $itemId ." ".$user." review.txt",$output);
	echo $output;
	echo '<br>review recorded';
}